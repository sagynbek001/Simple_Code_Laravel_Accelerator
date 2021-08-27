<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }
}
