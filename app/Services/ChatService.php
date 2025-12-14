<?php

namespace App\Services;

use App\Events\MessageSent;
use App\Models\Message;
use App\Repositories\MessageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ChatService
{
    public function __construct(protected MessageRepositoryInterface $messageRepository) {}

    public function getChatHistory(): Collection
    {
        return $this->messageRepository->getAllMessages();
    }

    public function sendMessage(array $data): Message
    {
        $message = $this->messageRepository->createMessage($data);

        broadcast(new MessageSent($message));

        return $message;
    }
}
