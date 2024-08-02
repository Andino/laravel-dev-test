<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class Verdict extends Data
{
    public function __construct(
        public string $status
    ) {
    }
}
