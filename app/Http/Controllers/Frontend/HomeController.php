<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Fetch Categories (for Navbar)
        $categories = DB::table('content_categories')
                        ->orderBy('name', 'ASC')
                        ->get();

        // 2. Define $sections (Empty collection to prevent error if the view checks for it)
        $sections = collect([]);

        // 3. Return view with both variables
        return view('frontend.index', compact('categories', 'sections'));
    }
}