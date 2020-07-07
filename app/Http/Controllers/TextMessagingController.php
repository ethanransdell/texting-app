<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TextMessaging\TextMessagingInterface;

class TextMessagingController extends Controller
{
    public function send(Request $request, TextMessagingInterface $textMessaging)
    {
        $request->validate([
            'to'   => [
                'required',
                'string',
                'max:13',
                'regex:/[0-9]{3}-[0-9]{3}-[0-9]{4}/',
            ],
            'body' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        return $textMessaging->send($request->input('to'), $request->input('body'));
    }
}
