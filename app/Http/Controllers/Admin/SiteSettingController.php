<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::first();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = SiteSetting::first();

        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_subtitle' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $settings->update($request->all());

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}