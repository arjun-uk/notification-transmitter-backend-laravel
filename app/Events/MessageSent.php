<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MessageSent implements ShouldBroadcastNow
{
    public function __construct(public string $message) {}

    public function broadcastOn(): Channel
    {
        return new Channel('chat-room');
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }
}
