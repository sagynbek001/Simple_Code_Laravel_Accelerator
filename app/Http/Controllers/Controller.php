<?php

namespace App\Http\Controllers;

use App\Services\v1\ServiceResult;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function result($resourceClass, ServiceResult $result)
    {
        if (!$result->isSuccess()) {
            return response()->json($result->data)->setStatusCode($result->code);
        }
        return new $resourceClass($result->data);
    }

    protected function resultCollection($collectionClass, ServiceResult $result)
    {
        if (!$result->isSuccess()) {
            return response()->json($result->data)->setStatusCode($result->code);
        }
        return new $collectionClass($result->data);
    }
}
