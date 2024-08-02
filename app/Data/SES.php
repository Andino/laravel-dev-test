<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class SES extends Data
{
    public function __construct(
        public Mail $mail,
        public Receipt $receipt
    ) {
    }
}
