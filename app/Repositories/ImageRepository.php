<?php

namespace App\Repositories;

use App\Models\Image;

class ImageRepository
{
    public function get($id): ?Image
    {
        return Image::find($id);
    }

    public function store($data): Image
    {
        return Image::create($data);
    }

    public function destroy($model)
    {
        return $model->delete();
    }

    /*public function existsName($name, $id)
    {
        return Image::where('', '=', $name)->where('id', '!=', $id)->exists();
    }*/
}
