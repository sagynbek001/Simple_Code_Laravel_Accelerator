<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\v1\episodeService;
use App\Http\Requests\EpisodeIndexRequest; //validation needs to be implemented
use App\Http\Requests\EpisodeRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\CharacterCollection;
use App\Http\Resources\EpisodeCollection;
use App\Http\Resources\EpisodeResource;
use GrahamCampbell\ResultType\Result;

class EpisodeController extends Controller
{
    private $episodeService;

    public function __construct(EpisodeService $episodeService)
    {
        $this->episodeService = $episodeService;
    }

    public function index(Request $request)
    {
        $result = $this->episodeService->index($request->all());
        return $this->resultCollection(EpisodeCollection::class, $result);
    }

    public function get($id)
    {
        return new EpisodeResource($this->episodeService->get($id));
    }

    public function getCharacters($id, Request $request)
    {
        return $this->resultCollection(CharacterCollection::class, $this->episodeService->getCharacters($id, $request->all()));
    }

    public function store(EpisodeRequest $request)
    {
        return $this->result($this->episodeService->store($request->validated()));
    }

    public function update($id, EpisodeRequest $request)
    {
        return $this->result($this->episodeService->update($id, $request->validated()));
    }

    public function destroy($id)
    {
        return $this->result($this->episodeService->destroy($id));
    }

    public function storeImage($id, ImageRequest $request)
    {
        return $this->result($this->episodeService->storeImage($id, $request));
    }

    public function destroyImage($id)
    {
        return $this->result($this->episodeService->destroyImage($id));
    }

    public function attachCharacter($episode_id, Request $request)
    {
        return $this->result($this->episodeService->attachCharacter($episode_id, $request['character_id']));
    }

    public function dettachCharacter($episode_id, $character_id)
    {
        return $this->result($this->episodeService->dettachCharacter($episode_id, $character_id));
    }
}


