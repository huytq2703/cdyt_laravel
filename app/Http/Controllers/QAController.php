<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class QAController extends Controller
{
    public function index ()
    {
        return Inertia::render('QAForm/QAForm');
    }

    public function createQuestion (Request $request)
    {
        Validator::make($request->all(), [
            'fullName'      => ['required'],
            'phoneNumber'   => ['required'],
            'email'         => ['required'],
            'content'       => ['required']

        ],
        [
            'fullName'      => 'Vui lòng nhập họ tên',
            'phoneNumber'   => 'Vui lòng nhập số điện thoại',
            'email'         => 'Vui lòng nhập email',
            'content'       => 'Vui lòng nhập nội dung'
        ])->validate();

        return redirect()->route('qaform');
    }
}
