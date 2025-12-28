<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    public function index()
    {
        return view('frontend.novel.index');
    }

    public function chapters($id = null)
    {
        return view('frontend.novel.chapters');
    }

    public function chapterDetails($novelId, $chapterId)
    {
        return view('frontend.novel.chapter-details');
    }
}

