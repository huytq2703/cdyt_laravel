<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\QA;

class QAController extends Controller
{
    public function index ()
    {
        return Inertia::render('QAForm/QAForm');
    }

    public function submitQuestions (Request $request)
    {
        Validator::make($request->all(), [
            'full_name'      => ['required'],
            'phone_number'   => ['required'],
            'email'         => ['required'],
            'q_content'       => ['required']

        ],
        [
            'full_name'      => 'Vui lòng nhập họ tên',
            'phone_number'   => 'Vui lòng nhập số điện thoại',
            'email'         => 'Vui lòng nhập email',
            'q_content'       => 'Vui lòng nhập nội dung'
        ])->validate();

        $inputs = $request->only(['full_name', 'phone_number', 'email','q_content']);

        $question = new QA($inputs);

        $result = $question->save();

        if ($result)
        return redirect()->back()->with('toast.success', 'Đã gửi gửi câu hỏi');
        return redirect()->back()->with('toast.error', 'Chưa thể gửi câu hỏi. Vui lòng gửi lại sau');
    }
}
