<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function index(Request $request)
    {
        return view('admin.dashboard')->with([
            'title' => 'Dashboard',
            // You can pass additional data here if needed
        ]);
    }
}
