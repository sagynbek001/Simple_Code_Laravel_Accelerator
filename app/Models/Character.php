<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function birth_location()
    {
        return $this->belongsTo(Birth_Location::class);
    }

    public function current_location()
    {
        return $this->belongsTo(Current_Location::class);
    }
}
