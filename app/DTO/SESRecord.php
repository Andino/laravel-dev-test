<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class SESRecord extends DataTransferObject
{
    public string $eventSource;
    public string $eventVersion;
    public SES $ses;
}
