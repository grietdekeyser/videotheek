<?php

namespace App;

use App\Movie;
use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    protected $fillable = ['id', 'movie_id', 'available'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
