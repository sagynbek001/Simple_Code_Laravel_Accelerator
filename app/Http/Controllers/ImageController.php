<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Services\ImageService; //validation needs to be implemented
use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;

class ImageController extends Controller
{
    private $ImageService;

    public function __construct()
    {
        $this->ImageService = new ImageService();
    }

    public function store(ImageRequest $request)
    {
        return new ImageResource($this->ImageService->store($request));
    }

    public function destroy($id)
    {
        return $this->result(ImageResource::class, $this->ImageService->destroy($id));
    }
}


