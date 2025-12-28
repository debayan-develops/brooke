<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function biography()
    {
        return view('frontend.biography');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function publishedWork()
    {
        return view('frontend.published-work');
    }

    public function fiction()
    {
        return view('frontend.fiction');
    }

    public function nonFiction()
    {
        return view('frontend.non-fiction');
    }

    public function vod()
    {
        return view('frontend.vod');
    }
}

