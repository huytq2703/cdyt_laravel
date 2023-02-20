<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;

class Categories extends Model
{
    use HasFactory, SoftDeletes;
    const menuType = 1;
    const postType = 0;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'metaTitle',
        'slug',
        'content',
        'type',
        'menu_type',
        'order_number'
    ];

    public function posts ()
    {
        return $this->belongsToMany(Posts::class, 'categories_posts', 'category_id', 'post_id');
    }

    public function childs ()
    {
        return $this->hasMany(Categories::class, 'parent_id', 'id');
    }

    public function menu()
    {
        return $this->with(['childs', 'posts'])->where('type', 'menu')->get();
    }

}
