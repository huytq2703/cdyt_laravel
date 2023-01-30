<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Posts;

class PostController extends Controller
{
    public function index ()
    {
        $postModel = new Posts();

        return Inertia::render('Admin/Posts/Posts', [
            'posts' => $postModel->getAll()
        ]);
    }
}
