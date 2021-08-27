<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;
use App\Services\v1\locationService;
use App\Http\Requests\LocationIndexRequest; //validation needs to be implemented
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    private $locationService;

    public function __construct(locationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function index(Request $request)
    {
        $result = $this->locationService->index($request->all());
        return $this->resultCollection(LocationCollection::class, $result);
    }

    public function get($id)
    {
        return $this->result(LocationResource::class, $this->locationService->get($id));
    }

    public function store(LocationRequest $request)
    {
        return $this->result(LocationResource::class, $this->locationService->store($request->validated()));
    }

    public function update($id, LocationRequest $request)
    {
        return $this->result(LocationResource::class, $this->locationService->update($id, $request->validated()));
    }

    public function destroy($id)
    {
        return $this->result(LocationResource::class, $this->locationService->destroy($id));
    }

    public function storeImage($id, ImageRequest $request)
    {
        return $this->result(LocationResource::class, $this->locationService->storeImage($id, $request->validated()));
    }

    public function destroyImage($id)
    {
        return $this->result(LocationResource::class, $this->locationService->destroyImage($id));
    }
}
