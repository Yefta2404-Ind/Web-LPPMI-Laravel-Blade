<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    // index untuk staff/admin
    public function index()
    {
        $user = auth()->user();

        if($user->role === 'admin') {
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
        'title' => 'required|string|max:200',
        'date' => 'required|date',
        'time' => 'required',
        'location' => 'nullable|string|max:100',
        'description' => 'nullable|string|max:1000',
        'status' => 'required|in:draft,pending',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('agenda', 'public');
    }

    Agenda::create([
        'title' => $request->title,
        'description' => $request->description,
        'date' => $request->date,
        'time' => $request->time,
        'location' => $request->location,
        'status' => $request->status,
        'image' => $imagePath,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('staff.agenda.index')
        ->with('success', 'Agenda berhasil disimpan.');
}


    public function edit(Agenda $agenda)
{
    // STAFF tidak boleh edit agenda yang sudah approved
    if (
        auth()->user()->role === 'staff' &&
        $agenda->status === 'approved'
    ) {
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
        'title' => 'required',
        'date' => 'required|date',
        'time' => 'required',
        'location' => 'nullable',
        'description' => 'nullable',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $data = $request->only(
        'title',
        'date',
        'time',
        'location',
        'description'
    );

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
        return redirect()->route('staff.agenda.index')->with('success','Agenda berhasil dihapus.');
    }

    // Custom methods for admin
   public function approve(\App\Models\Agenda $agenda)
{
    if ($agenda->status === 'approved') {
        return back()->with('error', 'Agenda sudah di-approve');
    }

    $agenda->update([
        'status' => 'approved',
        'approved_by' => auth()->id(),
        'approved_at' => now(),
    ]);

    return back()->with('success', 'Agenda berhasil di-approve');
}


   public function reject(\App\Models\Agenda $agenda)
{
    if ($agenda->status === 'approved') {
        return back()->with('error', 'Agenda sudah di-approve, tidak bisa ditolak');
    }

    $agenda->update([
        'status' => 'rejected',
    ]);

    return back()->with('success', 'Agenda ditolak');
}


    // Optional: method untuk public/home
    public function publicAgenda()
    {
        $agendas = Agenda::where('status','approved')->orderBy('date')->get();
        return view('public.home', compact('agendas'));
    }

    public function adminIndex(Request $request)
{
    $status = $request->status;

    $query = Agenda::with('user')->latest();

    if ($status) {
        $query->where('status', $status);
    }

    $agendas = $query->get();

    return view('admin.agenda.index', compact('agendas', 'status'));
}


}
