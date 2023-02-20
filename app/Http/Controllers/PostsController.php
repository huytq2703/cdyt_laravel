<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Posts;
use App\Models\Categories;

class PostsController extends Controller
{
    const highlightSlug = 'tin-tuc-noi-bat';
    public function postsByCategory (Request $request, String $slug)
    {
        $postsByCategory    = Categories::with('posts')->where('slug', $slug)->first();
        $highlightPosts     = Categories::with('posts')->where('slug', self::highlightSlug)->first();

        return Inertia::render("Category/Category", [
            'category' => $postsByCategory,
            'highlightPosts' => $highlightPosts
        ]);
    }

    public function postDetails (Request $request, String $categorySlug, String $postSlug)
    {
        $highlightPosts     = Categories::with('posts')->where('slug', self::highlightSlug)->first();
        $postDetails = Posts::where('slug', $postSlug)->first();
        // dd($categorySlug,$postSlug);

        return Inertia::render("Posts/PostDetails", [
            'post' => $postDetails,
            'highlightPosts' => $highlightPosts
        ]);
    }
}
