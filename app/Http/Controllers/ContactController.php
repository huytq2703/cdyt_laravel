<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Departments;
use App\Models\ContactInfo;

class ContactController extends Controller
{
    public function index ()
    {
        $departments = Departments::whereStatus(1)->get();

        return Inertia::render('Contact/Contact', [
            'departments' => $departments
        ]);
    }

    public function createContact (Request $request)
    {
        Validator::make($request->all(), [
            'full_name'      => ['required'],
            'phone_number'   => ['required'],
            'email'         => ['required'],
            'department_id'    => ['required'],
            'content'       => ['required']

        ],
        [
            'full_name'      => 'Vui lòng nhập họ tên',
            'phone_number'   => 'Vui lòng nhập số điện thoại',
            'email'         => 'Vui lòng nhập email',
            'department_id'    => 'Vui lòng chọn đơn vị công tác',
            'content'       => 'Vui lòng nhập nội dung'
        ])->validate();

        $inputs = $request->only(['full_name', 'phone_number', 'email', 'department_id', 'content']);

        $contact = new ContactInfo($inputs);

        $result = $contact->save();
        if ($result)
        return redirect()->back()->with('toast.success', 'Đã gửi thông tin liên hệ');
        return redirect()->back()->with('toast.error', 'Chưa thể gửi thông tin. Vui lòng gửi lại sau');
    }
}
