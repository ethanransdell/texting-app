<?php

namespace App\Http\Controllers;

use App\TextMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TextMessaging\TextMessageCollection;
use TextMessaging\TextMessageResource;
use TextMessaging\TextMessagingInterface;

class TextMessagingController extends Controller
{
    public function all()
    {
        $textMessages = Auth::user()
            ->textMessages()
            ->orderBy('created_at', 'desc')
            ->get();

        return new TextMessageCollection($textMessages);
    }

    public function send(Request $request, TextMessagingInterface $textMessaging)
    {
        $request->validate([
            'to'   => [
                'required',
                'string',
                'size:10',
                'regex:/[0-9]{10}/',
            ],
            'body' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $messageDto = $textMessaging->send($request->input('to'), $request->input('body'));

        $textMessage = TextMessage::make([
            'message_id'   => $messageDto->messageId,
            'to'           => $messageDto->to,
            'from'         => $messageDto->from,
            'body'         => $messageDto->body,
            'service_name' => $textMessaging->getServiceName(),
        ]);

        Auth::user()
            ->textMessages()
            ->save($textMessage);

        return new TextMessageResource($textMessage);
    }
}
