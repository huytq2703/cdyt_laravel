<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Majors;
use Inertia\Inertia;

class MajorController extends Controller
{
    const rac_Majors = 'admin.majors.save';
    const rl_Majors = 'admin.majors';
    const rau_Majors = 'admin.majors.update';
    const rad_Majors = 'admin.majors.delete';

    public function index()
    {
        $majors = Majors::with(['user_created'])->get();

        return Inertia::render('Admin/Majors/Majors', [
            'majors'    => $majors,
            'rl_Majors' => self::rl_Majors,
            'rac_Majors'  => self::rac_Majors,
            'rau_Majors'    => self::rau_Majors,
            'rad_Majors'    => self::rad_Majors
        ]);
    }

    public function save(Request $request, String $id = null)
    {
        Validator::make($request->all(), [
            'name'         => ['required', 'unique:majors,name,'.$id],
            'majors_code'  => ['required', 'unique:majors,majors_code,'.$id],
        ],
        [
            'name' => [
                'required'  => "Vui lòng nhập tên ngành",
                'unique'    => 'Ngành học đã tồn tại'
            ],

            'majors_code' => [
                'required'  => "Vui lòng nhập mã ngành",
                'unique'    => 'Mã ngành đã tồn tại'
            ],
        ])->validate();

        $inputs = $request->all();

        if ($id) {
            $majorsModel = Majors::find($id);
            $majorsModel->fill($inputs);

            $result = $majorsModel->save();

            if ($result) return redirect()->back()->with('toast.success', 'Đã cập nhật ngành học mới');
            return redirect()->back()->with('toast.error', 'Cập nhật ngành học thất bại');
        }

        $majorsModel = new Majors($inputs);
        $majorsModel->created_by =  Auth::id();
        $majorsModel->status =  1;

        $result = $majorsModel->save();

        if ($result) return redirect()->back()->with('toast.success', 'Đã tạo ngành học mới');
        return redirect()->back()->with('toast.error', 'Tạo ngành học thất bại');
    }

    public function delete(string $id)
    {
       $result = Majors::find($id)->delete();

        if ($result) return redirect()->back()->with('toast.success', 'Đã xoá ngành học');
        return redirect()->back()->with('toast.error', 'Xoá ngành học thất bại');
    }
}
