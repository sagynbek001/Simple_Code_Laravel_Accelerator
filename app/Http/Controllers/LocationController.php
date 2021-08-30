<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\v1\locationService;
use App\Http\Requests\LocationIndexRequest; //validation needs to be implemented
use App\Http\Requests\LocationRequest;
use App\Http\Requests\ImageRequest;
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
        return new LocationResource($this->locationService->get($id));
    }

    public function store(LocationRequest $request)
    {
        return $this->result($this->locationService->store($request->validated()));
    }

    public function update($id, LocationRequest $request)
    {
        return $this->result($this->locationService->update($id, $request->validated()));
    }

    public function destroy($id)
    {
        return $this->result($this->locationService->destroy($id));
    }

    public function storeImage($id, ImageRequest $request)
    {
        return $this->result($this->locationService->storeImage($id, $request));
    }

    public function destroyImage($id)
    {
        return $this->result($this->locationService->destroyImage($id));
    }
}
