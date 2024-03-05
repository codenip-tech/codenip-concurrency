<?php

declare(strict_types=1);

namespace App\Messenger\Message;

readonly class CreateUserMessage
{
    public function __construct(
        public string $id,
        public string $name,
    ) {
    }
}
