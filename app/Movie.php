<?php

namespace App;

use App\Copy;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title'];

    public function copies()
    {
        return $this->hasMany(Copy::class);
    }
}
