<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageService; //validation needs to be implemented
use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;

class ImageController extends Controller
{
    private $ImageService;

    public function __construct()
    {
        $this->CharacterService = new ImageService();
    }

    public function store(Request $request)
    {
        $path = $request->file('file')->store('images');
        return $this->result($this->ImageService->store($path));
    }

    public function destroy($id)
    {
        return $this->result($this->ImageService->destroy($id));
    }
}


