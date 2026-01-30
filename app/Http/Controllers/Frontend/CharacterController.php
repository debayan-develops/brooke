<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function show($id)
    {
        // Fetch the character and "eager load" their connected stories
        $character = Character::with('stories')->findOrFail($id);
        
        return view('frontend.characters.details', compact('character'));
    }
}