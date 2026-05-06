<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class MaintenanceController extends Controller
{
public function down()
{
    $secret = 'admin-bypass';

    Artisan::call('down', [
        '--secret' => $secret,
        '--retry' => 60,
    ]);

    return redirect('/' . $secret);
}

    public function up()
    {
        Artisan::call('up');

        return back()->with('success', 'Maintenance mode dimatikan');
    }
}