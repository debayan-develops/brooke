<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomesController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function index(Request $request)
    {
        return view('admin.homes')->with([
            'title' => 'Homes',
            // You can pass additional data here if needed
        ]);
    }
}
