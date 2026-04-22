<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('admin.profile.edit', [
            'user' => $request->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui');
    }

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = $request->user();

    
    $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
    $user->save();

    
    auth()->logout();

    
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    
    return redirect()->route('login')
        ->with('status', 'Password berhasil diubah! Silakan login kembali.');
}
}