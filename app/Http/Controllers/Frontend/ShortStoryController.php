<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShortStoryController extends Controller
{
    public function index()
    {
        return view('frontend.short-stories.index');
    }

    public function show($id)
    {
        return view('frontend.short-stories.details');
    }
}

