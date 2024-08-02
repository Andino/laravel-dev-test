<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ProcessedData extends DataTransferObject
{
    public bool $spam;
    public bool $virus;
    public bool $dns;
    public string $mes;
    public bool $restrasado;
    public string $emisor;
    public array $receptor;
}
