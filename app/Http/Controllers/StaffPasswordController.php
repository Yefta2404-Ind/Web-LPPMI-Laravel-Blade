<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffPasswordController extends Controller
{
    public function edit()
    {
        return view('staff.password.edit'); // blade form
    }

    public function update(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = $request->user();
    $user->password = Hash::make($request->password);
    $user->save();

    // Logout user setelah ganti password
    auth()->logout();

    // Redirect ke halaman login dengan session flash
    return redirect()->route('login')->with('status', 'Password berhasil diubah! Silakan login kembali.');
}

}
