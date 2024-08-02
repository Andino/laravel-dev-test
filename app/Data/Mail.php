<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class Mail extends Data
{
    public function __construct(
        public string $timestamp,
        public string $source,
        public string $messageId,
        public array $destination
    ) {
    }
}
