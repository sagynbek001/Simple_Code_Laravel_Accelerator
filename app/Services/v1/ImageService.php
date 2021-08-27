<?php

namespace App\Services\v1;

use Illuminate\Support\Facades\Storage;
use App\Services\v1\ServiceResult;
use App\Services\v1\BaseService;
use App\Repositories\ImageRepository;

class ImageService extends BaseService
{
    private $repoImage;

    public function __construct(ImageRepository $repoImage)
    {
        $this->repoImage = $repoImage;
    }

    public function get($id): ServiceResult
    {
        $image = $this->repoImage->get($id);
        if (is_null($image)) {
            return $this->errNotFound('Картинка не найденa');
        }
        return $this->result($image);
    }

    public function store($request): ServiceResult
    {
        $path = $request->file('file')->storePublicly('images', 'public');
        $image = $this->repoImage->store(['path'=>$path]);
        return $this->result($image);
    }

    public function destroy($id): ServiceResult
    {
        $image = $this->repoImage->get($id);
        if (is_null($image)) {
            return $this->errNotFound('Картинка не найдена');
        }
        Storage::delete(str_replace("images/", "", $image->path));
        $this->repoImage->destroy($image);
        return $this->ok('Картинка удалена');
    }
}
