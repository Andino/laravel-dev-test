<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class SESRecord extends Data
{
    public function __construct(
        public string $eventSource,
        public string $eventVersion,
        public SES $ses
    ) {
    }
}
