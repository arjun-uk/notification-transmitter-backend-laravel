<?php

namespace App\Http\Controllers;

use App\Services\ChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct(protected ChatService $chatService) {}

    public function index()
    {
        return view('chat.index');
    }

    public function fetchMessages()
    {
        return $this->chatService->getChatHistory();
    }

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $data['sender_name'] = $request->user()->name;

        $message = $this->chatService->sendMessage($data);

        return response()->json(['status' => 'Message Sent!', 'message' => $message]);
    }
}
