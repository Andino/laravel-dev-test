<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class Mail extends DataTransferObject
{
    public string $timestamp;
    public string $source;
    public string $messageId;
    public array $destination;
}
