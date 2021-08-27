<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\v1\characterService;
use App\Http\Requests\CharacterIndexRequest; //validation needs to be implemented
use App\Http\Requests\CharacterRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\CharacterCollection;
use App\Http\Resources\CharacterResource;
use App\Http\Resources\EpisodeCollection;

class CharacterController extends Controller
{
    private $characterService;

    public function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
    }

    public function index(Request $request)
    {
        $result = $this->characterService->index($request->all());
        return $this->resultCollection(CharacterCollection::class, $result);
    }

    public function get($id)
    {
        return $this->result(CharacterResource::class, $this->characterService->get($id));
    }

    public function getEpisodes($id, Request $request)
    {
        return $this->result(EpisodeCollection::class, $this->characterService->getEpisodes($id, $request->all()));
    }

    public function store(CharacterRequest $request)
    {
        return $this->result(CharacterResource::class, $this->characterService->store($request->validated()));
    }

    public function update($id, CharacterRequest $request)
    {
        return $this->result(CharacterResource::class, $this->characterService->update($id, $request->validated()));
    }

    public function destroy($id)
    {
        return $this->result(CharacterResource::class, $this->characterService->destroy($id));
    }

    public function storeImage($id, ImageRequest $request)
    {
        return $this->result(CharacterResource::class, $this->characterService->storeImage($id, $request));
    }

    public function destroyImage($id)
    {
        return $this->result(CharacterResource::class, $this->characterService->destroyImage($id));
    }
}


