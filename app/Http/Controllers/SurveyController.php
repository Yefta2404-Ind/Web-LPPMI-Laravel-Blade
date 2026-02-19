<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Survey;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SurveyController extends Controller
{
    /* ===================== STAFF ===================== */

    public function create()
    {
        return view('staff.surveys.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'survey_url'  => 'required|url',
        ]);

        $fileName = 'qr_' . Str::uuid() . '.svg';
        $path = 'surveys/' . $fileName;

        $qrImage = QrCode::format('svg')
            ->size(300)
            ->errorCorrection('H')
            ->generate($request->survey_url);

        Storage::disk('public')->put($path, $qrImage);

        Survey::create([
            'title'       => $request->title,
            'description' => $request->description,
            'survey_url'  => $request->survey_url,
            'qr_code'     => $path,
            'status'      => 'pending',
            'created_by'  => auth()->id(),
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Survey berhasil dibuat & QR otomatis dibuat.');
    }

    /* ===================== ADMIN ===================== */

    public function index()
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $surveys = Survey::latest()->get();
        return view('admin.surveys.index', compact('surveys'));
    }

   public function approve(Survey $survey)
{
    abort_unless(auth()->user()->role === 'admin', 403);

    DB::transaction(function () use ($survey) {

        // Archive survey yang sedang aktif
        Survey::where('status', 'approved')
            ->update(['status' => 'archived']);

        // Approve survey yang dipilih
        $survey->update(['status' => 'approved']);
    });

    return back()->with('success', 'Survey disetujui & ditampilkan ke public.');
}


    public function destroy(Survey $survey)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        if ($survey->status === 'approved') {
            return back()->withErrors('Survey aktif tidak boleh dihapus.');
        }

        $survey->delete();

        return back()->with('success', 'Survey dihapus.');
    }

    /* ===================== PUBLIC ===================== */

    public function publicSurvey()
    {
        $survey = Survey::where('status', 'approved')
            ->latest()
            ->first();

        return view('public.home', compact('survey'));
    }

    public function adminIndex()
{
    $surveys = Survey::latest()->get();

    return view('admin.surveys.index', compact('surveys'));
}

}
