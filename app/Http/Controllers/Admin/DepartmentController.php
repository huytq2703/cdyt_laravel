<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Departments;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    const rl_Department = 'admin.departments';
    const rau_Department = 'admin.departments.update';
    const rac_Department = 'admin.departments.create';
    const rad_Department = 'admin.departments.delete';
    const rar_Department = 'admin.departments.restore';

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $departments = new Departments();

        $departments = $departments->with(['user', 'user_delete']);

        if ($request->deleted) $departments->onlyTrashed();

        return Inertia::render('Admin/Departments/Departments', [
            'rl_Department'     => self::rl_Department,
            'rau_Department'    => self::rau_Department,
            'rac_Department'    => self::rac_Department,
            'rad_Department'    => self::rad_Department,
            'rar_Department'    => self::rar_Department,
            'departments'       => $departments->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request, String $id = null)
    {
        Validator::make($request->all(), [
            'code'          => ['required', 'unique:departments,code,'.$id],
            'name'          => ['required', 'unique:departments,name,'.$id],
        ],
        [
            'code' => [
                'required'  => "Vui lòng nhập mã phòng ban",
                'unique'    => 'Mã phòng ban đã tồn tại'
            ],
            'name'          => [
                'required'  => 'Vui lòng nhập tên phòng ban',
                'unique'    => 'Phòng ban đã tồn tại trong hệ thống'

            ],
        ])->validate();

        $inputs = $request->all();

        if (!$id) {

            $newDepartment = new Departments($inputs);

            $newDepartment->created_by = Auth::id();

            $result = $newDepartment->save();

            if (!$result) return redirect()->back()->with('toast.error', 'Tạo phòng ban thất bại');
                return redirect()->back()->with('toast.success', 'Tạo phòng ban thành công');
        }
        $updateDepartment = Departments::find($id);

        $updateDepartment->code         = $inputs['code'];
        $updateDepartment->name         = $inputs['name'];
        $updateDepartment->phone_number = $inputs['phone_number'];

        $result = $updateDepartment->update();

        if (!$result) return redirect()->back()->with('toast.error', 'Cập nhật phòng ban thất bại');
                return redirect()->back()->with('toast.success', 'Cập nhật phòng ban thành công');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function restore(String $id)
    {
        $result = Departments::withTrashed()->find($id)->restore();

        if (!$result) return redirect()->back()->with('toast.error', 'Xoá phòng ban thất bại');
                return redirect()->back()->with('toast.success', 'Xoá phòng ban thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(String $id)
    {
        $result = Departments::find($id)->delete();

        if (!$result) return redirect()->back()->with('toast.error', 'Xoá phòng ban thất bại');
                return redirect()->back()->with('toast.success', 'Xoá phòng ban thành công');
    }
}
