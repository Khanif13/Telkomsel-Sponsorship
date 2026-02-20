<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    public function index()
    {
        $cms = \App\Models\Setting::pluck('value', 'key')->all();

        return view('welcome', compact('cms'));
    }
}
