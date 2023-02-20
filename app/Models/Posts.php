<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Models\CategoryPost;
use App\Models\User;
use Log;

class Posts extends Model
{
    use HasFactory, SoftDeletes;

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
        'type'
    ];

    const status_created = 0;
    const status_published = 1;


    public function categories ()
    {
        return $this->belongsToMany(Categories::class, 'categories_posts', 'post_id', 'category_id');
    }

    public function user ()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getAll(Array $filters, String $type = 'post')
    {
        $pagination = config('constants.pagination');
        $pageSize = $pagination['pageSize'];
        $builder = $this->with(['user', 'categories'])->whereType($type);

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

        // Search by key words
        if (isset($filters['sortField'])) {
            $sortField  = $filters['sortField'];
            $sortOrder  = isset($filters['sortOrder']) && $filters['sortOrder'] == -1 ? 'desc' : 'asc';
            $builder    = $builder->orderBy($sortField, $sortOrder);
        }

        if (isset($filters['categoryIds'])) {
            $ids = $filters['categoryIds'];

            $builder = $builder->whereHas('categories', function ($cat) use($ids) {
                $cat->whereIn('categories.id', $ids);
            });
        }

        if (isset($filters['published'])) $builder->wherePublished($filters['published']);

        // $builder = $builder->whereHas('categories', function ($cat) {
        //     $cat->whereIn('categories.id', [1,2]);
        // });

        return $builder->latest('created_at')->paginate($pageSize);
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

            if (isset($postData['categoryIds']) && count($postData['categoryIds']) > 0)
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

    public function postsByCategory (String $categorySlug)
    {
        return $this->join('categories_posts AS cp', 'cp.post_id', 'posts.id')
            ->join('categories AS c', 'cp.category_id', 'c.id')
            ->where('c.slug', $categorySlug);
    }
}
