<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Models\CategoryPost;
use App\Models\User;
use Log;

class Posts extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'parent_id',
        'title',
        'meta_title',
        'slug',
        'summary',
        'content',
        'published',
        'cover_image',
        'published_at',
    ];

    // /**
    //  * The attributes that should be mutated to dates.
    //  *
    //  * @var array
    //  */
    // protected $timestamps = [
    //     'created_at',
    //     'updated_at',
    //     'deleted_at'
    // ];

    // protected $timestamp = true;

    public function categories ()
    {
        return $this->belongsToMany(Categories::class, 'categories_posts', 'post_id', 'category_id');
    }

    public function user ()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getAll(Array $filters)
    {
        $builder = $this->with(['user', 'categories']);

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $builder->where(function ($searchQuery) use ($search) {
                $categoryModel = new Categories();
                $catIds = $categoryModel->select('categories_posts.post_id')
                    ->join('categories_posts', 'categories_posts.category_id', 'categories.id')
                    ->where('categories.title', 'like', "%{$search}%")->get();
                $searchQuery->where('posts.title', 'like', "%{$search}%")
                    ->orWhereIn('posts.id', $catIds);
            });
        }
        return $builder->get();
    }

    public function findById(String $postId)
    {
        $builder = new Posts();

        return $builder->with('categories')->find($postId);
    }

    public function insertPost (Array $postData)
    {
        try {
            DB::beginTransaction();
            // Insert posts table
            $this->fill($postData)->save();

            // Insert categories_posts table
            $postId         = $this->id;

            foreach ($postData['categoryIds'] as $key => $value) {
                $categoryPostModel = new CategoryPost();

                $categoryPostModel->category_id = $value;
                $categoryPostModel->post_id     = $postId;
                $categoryPostModel->save();
            }

            DB::commit();
            return $this;
        } catch (\Throwable $th) {
            Log::error("Insert posts: {$th}");
            DB::rollback();
            return null;
        }
    }

    public function updatePost (Array $postData)
    {
        try {
            DB::beginTransaction();
            // Insert posts table
            $postId = $postData['id'];

            unset($postData['id']);
            unset($postData['user_id']);

            $this->find($postId)->fill($postData)->save();

            // Insert categories_posts table
            $categoryPostModel = new CategoryPost();
            $categoryPostModel->where('post_id', $postId)->delete();


            foreach ($postData['categoryIds'] as $key => $categoryId) {
                $categoryPostModel = new CategoryPost();

                $categoryPostModel->category_id = $categoryId;
                $categoryPostModel->post_id     = $postId;
                $categoryPostModel->save();
            }

            DB::commit();
            return $this;
        } catch (\Throwable $th) {
            Log::error("Insert posts: {$th}");
            DB::rollback();
            return null;
        }
    }
}
