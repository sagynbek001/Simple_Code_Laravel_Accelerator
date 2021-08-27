<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\v1\EpisodeService;
use App\Http\Requests\EpisodeIndexRequest; //validation needs to be implemented
use App\Http\Requests\EpisodeRequest;
use App\Http\Resources\EpisodeCollection;
use App\Http\Resources\EpisodeResource;

class EpisodeController extends Controller
{
    private $EpisodeService;

    public function __construct()
    {
        $this->EpisodeService = new EpisodeService();
    }

    public function index(Request $request)
    {
        $result = $this->EpisodeService->index($request->all());
        return $this->resultCollection(EpisodeCollection::class, $result);
    }

    public function get($id)
    {
        return $this->result(EpisodeResource::class, $this->EpisodeService->get($id));
    }

    public function store(EpisodeRequest $request)
    {
        return $this->result(EpisodeResource::class, $this->EpisodeService->store($request->validated()));
    }

    public function update($id, EpisodeRequest $request)
    {
        return $this->result(EpisodeResource::class, $this->EpisodeService->update($id, $request->validated()));
    }

    public function destroy($id)
    {
        return $this->result(EpisodeResource::class, $this->EpisodeService->destroy($id));
    }
}


