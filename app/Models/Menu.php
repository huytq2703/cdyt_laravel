<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Posts;


class Menu extends Model
{
    use HasFactory;

    public function subMenus ()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    public function post ()
    {
        return $this->hasOne(Posts::class, 'id', 'post_id');
    }

    public function category ()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }
}
