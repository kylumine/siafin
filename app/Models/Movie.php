<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title','genre','rate_per_day', 'imageUrl'];

    public function RentDetail() {
        return $this->hasMany(RentDetail::class);
    }

    public static function list(){
        $movie = Movie::orderByRaw('title')->get();
        $list = [];
        foreach ($movie as $movie) {
            $list[$movie -> id] = $movie->title;
        }

        return $list;
    }

}
