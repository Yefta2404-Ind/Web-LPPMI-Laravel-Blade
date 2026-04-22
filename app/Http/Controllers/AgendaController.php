<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\News; // sesuaikan jika nama model berbeda
use App\Models\Setting;
use App\Models\Menu;
use Carbon\Carbon;

class AgendaController extends Controller
{
    // =============================================
    // STAFF / ADMIN
    // =============================================

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $agendas = Agenda::latest()->get();
        } else {
            $agendas = Agenda::where('user_id', $user->id)->latest()->get();
        }

        return view('agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('agenda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:200',
            'date'        => 'required|date',
            'time'        => 'required',
            'location'    => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'status'      => 'required|in:draft,pending',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('agenda', 'public');
        }

        Agenda::create([
            'title'       => $request->title,
            'description' => $request->description,
            'date'        => $request->date,
            'time'        => $request->time,
            'location'    => $request->location,
            'status'      => $request->status,
            'image'       => $imagePath,
            'user_id'     => auth()->id(),
        ]);

        return redirect()->route('staff.agenda.index')
            ->with('success', 'Agenda berhasil disimpan.');
    }

    public function edit(Agenda $agenda)
    {
        if (auth()->user()->role === 'staff' && $agenda->status === 'approved') {
            abort(403, 'Agenda yang sudah diapprove tidak bisa diedit.');
        }

        return view('agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        if (auth()->user()->role === 'staff' && $agenda->status === 'approved') {
            abort(403);
        }

        $request->validate([
            'title'       => 'required',
            'date'        => 'required|date',
            'time'        => 'required',
            'location'    => 'nullable',
            'description' => 'nullable',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('title', 'date', 'time', 'location', 'description');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('agenda', 'public');
        }

        $agenda->update($data);

        return redirect()->route('staff.agenda.index')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('staff.agenda.index')
            ->with('success', 'Agenda berhasil dihapus.');
    }

    // =============================================
    // ADMIN KHUSUS
    // =============================================

    public function adminIndex(Request $request)
    {
        $status = $request->status;
        $query  = Agenda::with('user')->latest();

        if ($status) {
            $query->where('status', $status);
        }

        $agendas = $query->get();

        return view('admin.agenda.index', compact('agendas', 'status'));
    }

    public function approve(Agenda $agenda)
    {
        if ($agenda->status === 'approved') {
            return back()->with('error', 'Agenda sudah di-approve');
        }

        $agenda->update([
            'status'      => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Agenda berhasil di-approve');
    }

    public function reject(Agenda $agenda)
    {
        if ($agenda->status === 'approved') {
            return back()->with('error', 'Agenda sudah di-approve, tidak bisa ditolak');
        }

        $agenda->update(['status' => 'rejected']);

        return back()->with('success', 'Agenda ditolak');
    }

    // =============================================
    // PUBLIC — halaman /agenda dengan kalender
    // =============================================

public function publicIndex(Request $request)
{
    $agendas = Agenda::where('status', 'approved')
        ->where('date', '>=', now()->subMonth())
        ->orderBy('date')
        ->get(['id', 'title', 'date', 'time', 'location', 'description', 'image']);

    $latestNews = News::where('status', 'approved') // ✅ ganti ini
    ->where('created_at', '>=', now()->subMonth())
    ->latest()
    ->take(5)
    ->get(['id', 'title', 'image', 'content', 'created_at']);

    return view('public.agenda', compact('agendas', 'latestNews'));
}


public function publicAgenda()
{
    $agendas = Agenda::visible()->orderBy('date')->get();
    return view('public.home', compact('agendas'));
}
}