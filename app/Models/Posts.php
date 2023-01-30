<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\CategoryPost;

class Posts extends Model
{
    use HasFactory;

    public function categories ()
    {
        return $this->belongsToMany(Categories::class, 'categories_posts', 'post_id', 'category_id');
    }

    public function getAll()
    {
        $builder = new Posts();

        return $builder->with('categories')->get();
    }
}
