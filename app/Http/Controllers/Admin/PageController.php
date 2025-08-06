<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function index(Request $request)
    {
        return view('admin.pages')->with([
            'title' => 'Pages',
            'pages' => [] // Assuming you will fetch pages from a model or service
        ]);
    }
}
