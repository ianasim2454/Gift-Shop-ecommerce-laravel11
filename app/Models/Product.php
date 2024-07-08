<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//laravel slug:
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory;

    //laravel slug:
    use Sluggable;

    public function Sluggable():array
    {
        return
        [
            'slug'=>
            [
                'source' => 'title'
            ]
        ];
    }
}
