<?php

namespace App\Services;

use App\Contracts\JsonMapperServiceInterface;
use JsonMapper\JsonMapper;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class JsonMapperService implements JsonMapperServiceInterface
{
    /**
     * Polymorphic Mapper, sends the input data to an instance of the specified Data Object.
     *
     * @param array $data
     * @param string $dataClass
     * @return Data
     * @throws \InvalidArgumentException
    */
    public function map(array $data, string $dataClass): Data | array
    {
        if (!is_subclass_of($dataClass, Data::class) && !is_subclass_of($dataClass, DataCollection::class)) {
            throw new \InvalidArgumentException(
                "The class must be a subclass of " . Data::class . " or " . DataCollection::class
            );
        }

        if (is_subclass_of($dataClass, Data::class)) {
            return $dataClass::collect($data['Records']);
        }

        throw new \InvalidArgumentException("The provided class does not support data mapping.");
    }
}
