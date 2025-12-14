<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

interface MessageRepositoryInterface
{
    public function getAllMessages(): Collection;
    public function createMessage(array $data): Message;
}
