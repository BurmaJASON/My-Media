<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillabel = [
        'post_id',
        'title',
        'description',
        'image',
        'category_id'
    ];

    use HasFactory;
}
