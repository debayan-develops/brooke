<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('frontend.blog.index');
    }

    public function show($id)
    {
        return view('frontend.blog.details');
    }

    public function freshest()
    {
        return view('frontend.blog.freshest');
    }

    public function freshestDetails($id)
    {
        return view('frontend.blog.freshest-details');
    }
}

