<?php

namespace App\Http\Controllers;

use App\Models\ExternalQuality;

class PublicExternalQualityController extends Controller
{
       public function index()
{
    $sections = [
        'layanan' => 'Layanan',
        'akreditasi' => 'Akreditasi',
        'internasional' => 'Internasional',
        'sertifikasi' => 'Sertifikasi',
        'ipepa' => 'Visualisasi Data IPEPA'
    ];

    $data = \App\Models\ExternalQuality::where('status','approved')
            ->get()
            ->groupBy('section');

    return view('public.mutu-eksternal.index',
        compact('sections','data')
    );
}



}
