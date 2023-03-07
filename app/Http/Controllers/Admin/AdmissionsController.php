<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Majors;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Admissions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdmissionsController extends Controller
{

    const ru_Admissions = 'admin.admissions.show';
    const rc_Admissions = 'admin.admissions.create';
    const rl_Admissions = 'admin.admissions';
    const rac_Admissions = 'admin.admissions.create_action';
    const rau_Admissions = 'admin.admissions.update_action';
    const rau_HandleAdmissions = 'admin.admissions.handle';
    const rad_Admissions = 'admin.admissions.delete';
    const rar_Admissions = 'admin.admissions.restore';
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $status = $request?->status ?? 0;
        switch ($status) {
            case 1:
                $admissions = Admissions::with('majors')->whereStatus(1)->get();
                break;

            case 2:
                $admissions = Admissions::with('majors')->onlyTrashed()->get();
                break;
            default:
                $admissions = Admissions::with('majors')->whereStatus(0)->get();
                break;
        }
        return Inertia::render('Admin/Admissions/Admissions', [
            'admissions'    => $admissions,
            'ru_Admissions' => self::ru_Admissions,
            'rc_Admissions' => self::rc_Admissions,
            'rl_Admissions' => self::rl_Admissions,
            'status'    => $status,
            'rad_Admissions' => self::rad_Admissions,
            'rar_Admissions' => self::rar_Admissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
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
            "notes"
        ]);

        $this->admissionValidate($inputs);

        $inputs['birthday'] = date('Y-m-d', strtotime($inputs['birthday']));
        $inputs['verify_email_code'] = Hash::make($inputs['email']);

        $admissionModel = new Admissions($inputs);

        $result = $admissionModel->save();

        if ($result) return redirect()->back()->with('toast.success', 'Đã tạo đăng ký tuyển sinh');
        return redirect()->back()->with('toast.error', 'Tạo đăng ký tuyển sinh thất bại');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id = null)
    {
        $settingModel = new Setting();
        $commons = $settingModel->valueByKey('commons');
        $commons = json_decode($commons);
        $majors = Majors::get();

        // dd($commons->);

        return Inertia::render('Admin/Admissions/AdmissionsDetails', [
            'details' => Admissions::with('majors')->find($id),
            'genderOptions' => $commons->gender,
            'levelOptions'  => $commons->levels,
            'priorityOptions' => $commons->priority_objects,
            'majorOptions'   => $majors,
            'rac_Admissions' => self::rac_Admissions,
            'rl_Admissions' => self::rl_Admissions,
            'rau_Admissions' => self::rau_Admissions,
            'rau_HandleAdmissions' => self::rau_HandleAdmissions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // dd($id);
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
            "notes"
        ]);
        $inputs = [ ...$inputs, 'id' => $id];

        $this->admissionValidate($inputs);

        $admission = Admissions::find($id);

        $admission->fill($inputs);

        $result = $admission->save();

        if ($result) return redirect()->back()->with('toast.success', 'Đã cập nhập thông tin tuyển sinh');
        return redirect()->back()->with('toast.error', 'Cập nhật thông tin tuyển sinh thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function handleAdmissionRequest(String $id)
    {
        $admission = Admissions::find($id);

        $admission->status = Admissions::processed;
        $result = $admission->save();

        if ($result) return redirect()->back()->with('toast.success', 'Đã cập nhập thông tin tuyển sinh');
        return redirect()->back()->with('toast.error', 'Cập nhật thông tin tuyển sinh thất bại');
    }

    public function delete(String $id)
    {
        $admission = Admissions::find($id);

        if ($admission) {
            $result = $admission->delete();

            if ($result) return redirect()->back()->with('toast.success', 'Đã xoá thông tin tuyển sinh');
            return redirect()->back()->with('toast.error', 'Xoá thông tin tuyển sinh thất bại');
        }
        return redirect()->back()->with('toast.error', 'Không tìm thấy thông tin tuyển sinh');
    }


    public function restore(String $id)
    {
        $admission = Admissions::withTrashed()->find($id);

        if ($admission) {
            $result = $admission->restore();

            if ($result) return redirect()->back()->with('toast.success', 'Đã khôi phục thông tin tuyển sinh');
            return redirect()->back()->with('toast.error', 'Khôi phục thông tin tuyển sinh thất bại');
        }
        return redirect()->back()->with('toast.error', 'Không tìm thấy thông tin tuyển sinh');
    }

    public function admissionValidate (Array $inputs)
    {
        $id = $inputs['id'] ?? null;
        Validator::make($inputs , [
            "full_name" => ['required'],
            "birthday" => ['required'],
            "gender" => ['required'],
            "religion",
            "nation" => ['required'],
            "level" => ['required'],
            "priority_object" => ['required'],
            "majors_id" => ['required'],
            "email" => ['required', 'unique:admissions,email,'.$id],
            "phone_number" => ['required', 'unique:admissions,phone_number,'.$id],
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
            "priority_object" => ["required" => "Vui lòng chọn đối tượng ưu tiên"],
            "majors_id" => ['required' => "Vui lòng chọn ngành học"],
            "email" => ['required' => "Vui lòng nhập email", 'unique' => 'Email đã đăng ký'],
            "phone_number" => ['required' => "Vui lòng nhập số điện thoại", 'unique' => 'Số điện thoại đã đăng ký'],
            "address" => ['required' => "Vui lòng nhập địa chỉ"],
            "province_id" => ['required' => "Vui lòng chọn tỉnh"],
            "district_id" => ['required' => "Vui lòng chọn quận/huyện/TP"],
            "ward_id"=> ['required' => "Vui lòng chọn phường xã"],
        ])->validate();
    }
}
