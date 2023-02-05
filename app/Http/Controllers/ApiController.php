<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function test ()
    {
        sleep(2);
        $posts = [
            'post_1' => 'Bài viết 1',
            'post_2' => 'Bài viết 2'
        ];

        $user = [
            'username' => "admin@gmail.com",
            'fullName' => "Admin"
        ];

        return response()->json([
            'data' => ['posts' => $posts, 'user' => $user],
            'statusValue' => 'Gọi api thành công!',
            'statusCode' => 200,
            'success'  => true
        ]);
    }
}
