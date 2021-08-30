<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Services\v1\imageService; //validation needs to be implemented
use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;

class ImageController extends Controller
{
    private $imageService;

    public function __construct(imageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function store(ImageRequest $request)
    {
        return $this->result($this->imageService->store($request->validated()));
    }

    public function destroy($id)
    {
        return $this->result($this->imageService->destroy($id));
    }
}


