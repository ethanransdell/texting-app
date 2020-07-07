<?php

namespace App\Http\Controllers;

use TextMessaging\TextMessagingInterface;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
