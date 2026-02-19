<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganizationStructure;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationMember;
use Illuminate\Support\Facades\Log;



class OrganizationStructureController extends Controller
{

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',   // Judul struktur
        'members' => 'required|array|min:1',   // minimal 1 anggota
        'members.*.name' => 'required|string',
        'members.*.position' => 'required|string',
        'members.*.photo' => 'nullable|image|max:2048',
    ]);

    DB::transaction(function () use ($request) {

        // 1️⃣ Buat header struktur
        $structure = OrganizationStructure::create([
    'name'      => $request->title,
    'status'    => 'pending',
    'user_id'   => auth()->id(),
    'is_active' => false,
]);


        // 2️⃣ Buat anggota
        foreach ($request->members as $index => $member) {

            $photoPath = null;
            if (isset($member['photo'])) {
                $photoPath = $member['photo']->store('organization', 'public');
            }

            OrganizationMember::create([
                'organization_structure_id' => $structure->id,
                'name'  => $member['name'],
                'position' => $member['position'],
                'photo' => $photoPath,
                'order' => $index,
            ]);
        }
    });

    return redirect()
        ->route('staff.organization-structure.index')
        ->with('success', 'Struktur dikirim, menunggu persetujuan admin');
}



    /* =================================================
     | ADMIN
     |=================================================*/

    // List data pending
    public function pending()
    {
        return response()->json(
            OrganizationStructure::where('status', 'pending')
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }


public function adminPending()
{
    $data = OrganizationStructure::with('members')
        ->where('status', 'pending')
        ->latest()
        ->paginate(10);

    return view('admin.organization-structure.pending', compact('data'));
}


    public function index()
{
    $data = OrganizationStructure::where('user_id', auth()->id())
    ->latest()
    ->get();

        

    return view('staff.organization-structure.index', compact('data'));
}

public function create()
{
    return view('staff.organization-structure.create');
}

public function edit($id)
{
    $structure = OrganizationStructure::with('members')
        ->where('id', $id)
        ->where('created_by', auth()->id())
        ->firstOrFail();

    return view('staff.organization-structure.edit', compact('structure'));
}

public function approve($id)
{
    try {
        DB::transaction(function () use ($id) {
            // Nonaktifkan semua yang aktif
            OrganizationStructure::where('is_active', true)
                ->update(['is_active' => false]);

            // Aktifkan struktur yang dipilih
            $structure = OrganizationStructure::findOrFail($id);
            $structure->update([
                'status' => 'approved',
                'is_active' => true
            ]);

            \Log::info('Struktur diaktifkan:', [
                'id' => $structure->id,
                'name' => $structure->name,
                'is_active_set_to' => true
            ]);
        });

        return redirect()
            ->route('admin.organization-structure.choose-active')
            ->with('success', 'Struktur organisasi berhasil diaktifkan');

    } catch (\Exception $e) {
        \Log::error('Error mengaktifkan struktur:', [
            'id' => $id,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()
            ->route('admin.organization-structure.choose-active')
            ->with('error', 'Gagal mengaktifkan struktur. Silakan coba lagi.');
    }
}

public function destroy($id)
{
    $structure = OrganizationStructure::where('id', $id)
        ->where('created_by', auth()->id())
        ->where('status', 'pending')
        ->firstOrFail();

    $structure->delete();

    return back()->with('success', 'Struktur dihapus');
}


public function approved()
{
    // Ambil hanya struktur aktif
    $structure = OrganizationStructure::with('members')
        ->where('is_active', true)
        ->first();

    // Pastikan selalu collection
    $members = $structure ? $structure->members : collect();

    return view('admin.organization-structure.index', compact('members'));
}



public function chooseActive()
{
    $data = OrganizationStructure::with(['members', 'user'])
        ->where('status', 'approved')
        ->orderBy('is_active', 'desc') // Aktif di atas
        ->orderBy('updated_at', 'desc')
        ->get();

    // Debug: cek data di log
    \Log::info('Struktur yang disetujui:', [
        'total' => $data->count(),
        'data' => $data->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'is_active' => $item->is_active,
                'is_active_raw' => $item->getRawOriginal('is_active'), // nilai asli dari DB
            ];
        })->toArray()
    ]);

    return view('admin.organization-structure.choose-active', compact('data'));
}


public function pendingView()
{
    $data = OrganizationStructure::where('status', 'pending')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.organization-structure.pending', compact('data'));
}

    // Reject data
    public function reject($id)
    {
        $data = OrganizationStructure::findOrFail($id);
        $data->update(['status' => 'rejected']);

        return response()->json([
            'message' => 'Data ditolak'
        ]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'members' => 'required|array',
        'members.*.name' => 'required|string',
        'members.*.position' => 'required|string',
        'members.*.photo' => 'nullable|image'
    ]);

    DB::transaction(function () use ($request) {

        $newStructure = OrganizationStructure::create([
            'name' => $request->title,
            'status' => 'pending',
            'is_active' => false,
            'created_by' => auth()->id(),
        ]);

        foreach ($request->members as $index => $member) {

            $photoPath = null;

            if (isset($member['photo'])) {
                $photoPath = $member['photo']->store('organization', 'public');
            }

            OrganizationMember::create([
                'organization_structure_id' => $newStructure->id,
                'name' => $member['name'],
                'position' => $member['position'],
                'photo' => $photoPath,
                'order' => $index
            ]);
        }
    });

    return redirect()
        ->route('staff.organization-structure.index')
        ->with('success', 'Perubahan dikirim, menunggu approval admin');
}

    /* =================================================
     | PUBLIC
     |=================================================*/

    // Data publik (approved saja)
public function public()
{
    $structure = OrganizationStructure::with('members')
        ->where('is_active', true)
        ->first();

    return view('public.organization-structure.index', compact('structure'));
}




}
