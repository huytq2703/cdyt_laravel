<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function index ()
    {
        return Inertia::render('Contact/Contact');
    }

    public function createContact (Request $request)
    {
        Validator::make($request->all(), [
            'fullName'      => ['required'],
            'phoneNumber'   => ['required'],
            'email'         => ['required'],
            'department'    => ['required'],
            'content'       => ['required']

        ],
        [
            'fullName'      => 'Vui lòng nhập họ tên',
            'phoneNumber'   => 'Vui lòng nhập số điện thoại',
            'email'         => 'Vui lòng nhập email',
            'department'    => 'Vui lòng chọn đơn vị công tác',
            'content'       => 'Vui lòng nhập nội dung'
        ])->validate();

        return redirect()->route('contact');
    }
}
