<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganizationStructure;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationMember;

class OrganizationStructureController extends Controller
{
    /* =================================================
     | ADMIN
     |=================================================*/

    public function index()
    {
        $data = OrganizationStructure::with('members')
            ->orderBy('is_active', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.organization-structure.index', compact('data'));
    }

    public function create()
    {
        return view('admin.organization-structure.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'                  => 'required|string|max:255',
            'members'                => 'required|array|min:1',
            'members.*.name'         => 'required|string',
            'members.*.position'     => 'required|string',
            'members.*.photo'        => 'nullable|image|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $structure = OrganizationStructure::create([
                'name'      => $request->title,
                'status'    => 'approved',
                'user_id'   => auth()->id(),
                'is_active' => false,
            ]);

            foreach ($request->members as $index => $member) {
                $photoPath = null;
                if (isset($member['photo'])) {
                    $photoPath = $member['photo']->store('organization', 'public');
                }

                OrganizationMember::create([
                    'organization_structure_id' => $structure->id,
                    'name'     => $member['name'],
                    'position' => $member['position'],
                    'photo'    => $photoPath,
                    'order'    => $index,
                ]);
            }
        });

        return redirect()
            ->route('admin.organization-structure.index')
            ->with('success', 'Struktur organisasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $structure = OrganizationStructure::with('members')->findOrFail($id);
        return view('admin.organization-structure.edit', compact('structure'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'                  => 'required|string|max:255',
            'members'                => 'required|array|min:1',
            'members.*.name'         => 'required|string',
            'members.*.position'     => 'required|string',
            'members.*.photo'        => 'nullable|image|max:2048',
        ]);

        $structure = OrganizationStructure::findOrFail($id);

        DB::transaction(function () use ($request, $structure) {
            $structure->update(['name' => $request->title]);

            // Hapus anggota lama
            foreach ($structure->members as $member) {
                if ($member->photo) {
                    Storage::disk('public')->delete($member->photo);
                }
                $member->delete();
            }

            // Buat anggota baru
            foreach ($request->members as $index => $member) {
                $photoPath = null;
                if (isset($member['photo'])) {
                    $photoPath = $member['photo']->store('organization', 'public');
                }

                OrganizationMember::create([
                    'organization_structure_id' => $structure->id,
                    'name'     => $member['name'],
                    'position' => $member['position'],
                    'photo'    => $photoPath,
                    'order'    => $index,
                ]);
            }
        });

        return redirect()
            ->route('admin.organization-structure.index')
            ->with('success', 'Struktur organisasi berhasil diperbarui');
    }

    public function toggleActive($id)
    {
        DB::transaction(function () use ($id) {
            $structure = OrganizationStructure::findOrFail($id);

            if (!$structure->is_active) {
                // Nonaktifkan semua dulu
                OrganizationStructure::where('is_active', true)
                    ->update(['is_active' => false]);
                $structure->update(['is_active' => true]);
            } else {
                $structure->update(['is_active' => false]);
            }
        });

        return back()->with('success', 'Status struktur organisasi diperbarui');
    }

    public function destroy($id)
    {
        $structure = OrganizationStructure::with('members')->findOrFail($id);

        foreach ($structure->members as $member) {
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
        }

        $structure->delete();

        return back()->with('success', 'Struktur organisasi berhasil dihapus');
    }

    /* =================================================
     | PUBLIC
     |=================================================*/

    public function public()
    {
        $structure = OrganizationStructure::with('members')
            ->where('is_active', true)
            ->first();

        return view('public.organization-structure.index', compact('structure'));
    }
}