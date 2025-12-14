<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository implements MessageRepositoryInterface
{
    public function getAllMessages(): Collection
    {
        return Message::oldest()->get(); // Chat usually reads top to bottom, oldest first
    }

    public function createMessage(array $data): Message
    {
        return Message::create($data);
    }
}
