<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

use App\Models\TimeSlot;
use App\Models\CareerDirectionProfile;

class CareerDirectionController extends Controller
{
    const rac_TimeSlot = 'admin.time_slots.create';
    const rac_CareerDirection = 'admin.career_direction.create';
    const rs_CareerDirection = "admin.time_slots.show";
    const rl_CareerDirection = 'admin.career_direction';
    const rau_CareerDirection = 'admin.time_slots.update';

    public function index (Request $request)
    {
        $status = $request?->status ? $request->status : 0;

        return Inertia::render('Admin/CareerDirection/CareerDirection', [
            'rac_TimeSlot' => self::rac_TimeSlot,
            'rs_CareerDirection' => self::rs_CareerDirection,
            'rl_CareerDirection' => self::rl_CareerDirection,
            'timeSlots' => TimeSlot::get(),
            'careerDirectionRegistered' => CareerDirectionProfile::with('time')->whereStatus($status)->get()
        ]);
    }

    public function createTimeSlots(Request $request)
    {
        $fromTime = Carbon::create($request->from_time)->setTimezone(config('app.timezone'))->toTimeString();
        $toTime = Carbon::create($request->to_time)->setTimezone(config('app.timezone'))->toTimeString();

        $timeModel = new TimeSlot();

        $timeModel->from_time = $fromTime;
        $timeModel->to_time = $toTime;
        $timeModel->save();

        return redirect()->back()->with('toast.success', 'Đã thêm khoảng thời gian');
    }

    public function create(Request $request)
    {
        $inputs = $request->only([
            "full_name",
            "phone_number",
            "address",
            "province_id",
            "district_id",
            "ward_id",
            "free_date",
            "time_slot_id"
        ]);
        Validator::make($inputs , [
            "full_name" => ['required'],
            "phone_number" => ['required', 'unique:career_direction_profiles'],
            "address" => ['required'],
            "province_id" => ['required'],
            "district_id" => ['required'],
            "ward_id"=> ['required'],
            "free_date" => ['required'],
            "time_slot_id" => ['required']
        ],
        [
            "full_name" => ['required' => "Vui lòng nhập họ tên đầy đủ"],
            "phone_number" => ['required' => "Vui lòng nhập số điện thoại", 'unique' => 'Số điện thoại đã đăng ký'],
            "address" => ['required' => "Vui lòng nhập địa chỉ"],
            "province_id" => ['required' => "Vui lòng chọn tỉnh"],
            "district_id" => ['required' => "Vui lòng chọn quận/huyện/TP"],
            "ward_id"=> ['required' => "Vui lòng chọn phường xã"],
            "free_date" => ['required' => "Vui lòng chọn ngày tư vấn"],
            "time_slot_id" => ['required' => "Vui lòng chọn khoảng thời gian tư vấn"]
        ])->validate();

        $profile = new CareerDirectionProfile($inputs);
        $result = $profile->save();

        if (!$result) return redirect()->back()->with('toast.error', 'Đăng ký thất bại');
        return redirect()->back()->with('toast.success', 'Đăng ký thành công');
    }

    public function show (String $id)
    {
        return Inertia::render('Admin/CareerDirection/CareerDirectionDetails', [
            'rl_CareerDirection' => self::rl_CareerDirection,
            'rau_CareerDirection' => self::rau_CareerDirection,
            'details'   => CareerDirectionProfile::with(['time', 'province', 'district', 'ward'])->find($id)
        ]);
    }

    public function update (Request $request, String $id)
    {
        $profile = CareerDirectionProfile::find($id);

        $profile->status = $request->status;

        $profile->save();

        return Inertia::render('Admin/CareerDirection/CareerDirectionDetails', [
            'rl_CareerDirection' => self::rl_CareerDirection,
            'details'   => CareerDirectionProfile::with(['time', 'province', 'district', 'ward'])->find($id),
            'toast.success' => "Đã cập nhật"
        ]);
    }
}
