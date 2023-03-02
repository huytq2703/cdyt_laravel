<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Majors;
use App\Models\Admissions;
use App\Jobs\sendAdmissionsMailJob;
use Illuminate\Support\Facades\Hash;

class AdmissionsController extends Controller
{
    const ra_SubmitFormRegister = "online_enrollment_registration.action";
    public function noticeAdmission (Request $request)
    {

        return Inertia::render("Enrollment/EnrollmentNotice");
    }
    public function registerAdmissions(Request $request)
    {
        if ($request->isMethod('GET')) {
            $admissionNews = Categories::with(['posts' => function ($post) {
                $post->wherePublished(1);
            }])->whereSlug('tin-tuc-tuyen-sinh')->first();


            return Inertia::render("Enrollment/OnlineEnrollmentRegistration", [
                'ra_SubmitFormRegister' => self::ra_SubmitFormRegister,
                'majors'    => Majors::get(),
                'levels'    => ['THCS', 'THPT'],
                'genders'    => [['id' => 1, 'name' => 'Nam'], ['id' => 0, 'name' => 'Nữ']],
                'admissionNews' => $admissionNews
            ]);
        }


        $inputs = $request->only([
            "full_name",
            "birthday",
            "gender",
            "religion",
            "nation",
            "level",
            "priority_object",
            "majors_id",
            "email",
            "phone_number",
            "address",
            "province_id",
            "district_id",
            "ward_id",
        ]);
        Validator::make($inputs , [
            "full_name" => ['required'],
            "birthday" => ['required'],
            "gender" => ['required'],
            "religion",
            "nation" => ['required'],
            "level" => ['required'],
            "priority_object",
            "majors_id" => ['required'],
            "email" => ['required', 'unique:admissions'],
            "phone_number" => ['required', 'unique:admissions'],
            "address" => ['required'],
            "province_id" => ['required'],
            "district_id" => ['required'],
            "ward_id"=> ['required'],
        ],
        [
            "full_name" => ['required' => "Vui lòng nhập họ tên đầy đủ"],
            "birthday" => ['required' => "Vui lòng nhập ngày, tháng, năm sinh"],
            "gender" => ['required' => "Vui lòng chọn giới tính"],
            "religion",
            "nation" => ['required' => "Vui lòng nhập dân tộc"],
            "level" => ['required' => "Vui lòng chọn trình độ"],
            "priority_object",
            "majors_id" => ['required' => "Vui lòng chọn ngành học"],
            "email" => ['required' => "Vui lòng nhập email", 'unique' => 'Email đã đăng ký'],
            "phone_number" => ['required' => "Vui lòng nhập số điện thoại", 'unique' => 'Số điện thoại đã đăng ký'],
            "address" => ['required' => "Vui lòng nhập địa chỉ"],
            "province_id" => ['required' => "Vui lòng chọn tỉnh"],
            "district_id" => ['required' => "Vui lòng chọn quận/huyện/TP"],
            "ward_id"=> ['required' => "Vui lòng chọn phường xã"],
        ])->validate();

        $inputs['birthday'] = date('Y-m-d', strtotime($inputs['birthday']));
        $inputs['verify_email_code'] = Hash::make($inputs['email']);

        $admissionModel = new Admissions($inputs);
        $result = $admissionModel->save();

        $inputs['link'] = route('admin.admissions.show', [$admissionModel->id]);

       try {
        dispatch(new sendAdmissionsMailJob($inputs, 'huytq270397@gmail.com'));
       } catch (\Throwable $th) {
        //throw $th;
       }

        if ($result) return redirect()->back()->with('toast.success', 'Đã gửi thông tin đăng ký');
        return redirect()->back()->with('toast.error', 'Lỗi gửi thông tin đăng ký');

    }
}
