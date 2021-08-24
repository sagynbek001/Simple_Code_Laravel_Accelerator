<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\v1\LocationService;
use App\Http\Requests\LocationIndexRequest; //validation needs to be implemented
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    private $LocationService;

    public function __construct()
    {
        $this->LocationService = new LocationService();
    }

    public function index(Request $request)
    {
        $result = $this->LocationService->index($request->all());
        return $this->resultCollection(LocationCollection::class, $result);
    }

    public function get($id)
    {
        return $this->result(LocationResource::class, $this->LocationService->get($id));
    }

    public function store(LocationRequest $request)
    {
        return $this->result(LocationResource::class, $this->LocationService->store($request->validated()));
    }

    public function update($id, LocationRequest $request)
    {
        return $this->result(LocationResource::class, $this->LocationService->update($id, $request->validated()));
    }

    public function destroy($id)
    {
        return $this->result(LocationResource::class, $this->LocationService->destroy($id));
    }
}
