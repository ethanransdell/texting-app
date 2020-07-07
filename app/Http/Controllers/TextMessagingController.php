<?php

namespace App\Http\Controllers;

use App\TextMessage;
use Illuminate\Http\Request;
use TextMessaging\TextMessagingInterface;

class TextMessagingController extends Controller
{
    public function all()
    {
        return TextMessage::query()
            ->orderBy('created_at', 'desc')
            ->get();
    }

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

        $message = $textMessaging->send($request->input('to'), $request->input('body'));

        return TextMessage::create([
            'message_id' => $message->messageId,
            'to'         => $message->to,
            'from'       => $message->from,
            'body'       => $message->body,
        ]);
    }
}
