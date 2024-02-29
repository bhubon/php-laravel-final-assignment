<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'category_id',
        'thumbnail',
        'status',
        'user_id',
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
