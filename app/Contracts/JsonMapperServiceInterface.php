<?php

namespace App\Contracts;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

interface JsonMapperServiceInterface
{
    public function map(array $data, string $dataClass): Data | array;
}
