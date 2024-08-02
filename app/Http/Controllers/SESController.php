<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\JsonMapperServiceInterface;
use App\Data\SESRecord;
use App\Data\SESRecordCollection;
use App\Http\Requests\SESRequest;
use App\Http\Resources\SESResponseResource;

class SESController extends Controller
{
    // Service Instance
    protected $service;

    /**
     * Controller constructor.
     *
     * @param JsonMapperInterface $service
     */
    public function __construct(JsonMapperServiceInterface $service)
    {
        $this->service = $service;
    }

    public function __invoke(SESRequest $request)
    {
        $jsonData = $request->validated();
        $sesRecord = $this->service->map($jsonData, SESRecord::class);
        return SESResponseResource::collection($sesRecord);
    }
}
