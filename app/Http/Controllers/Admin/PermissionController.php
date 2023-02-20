<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PermissionController extends Controller
{
    public function index()
    {
        // dd(Roles::get()->toArray());
        return Inertia::render('Admin/Permission/Permission', [
            'roles' => Roles::get(),
            'permissions' => config('permissions')
        ]);
    }

    public function saveRole (Request $request)
    {
        $inputs = $request->all();
        $this->validateRole($inputs);

        $roleModel = new Roles();

        $roleModel->code = $inputs['code'];

        $roleModel->name = $inputs['name'];
        $roleModel->description = $inputs['description'];
        $roleModel->permissions = $inputs['permissions'];

        $result = $roleModel->save();


        if (!$result) return redirect()->route('system.permission')
                            ->with('toast.error', 'Thêm mới thất bại');
            return redirect()->route('system.permission')
                ->with('toast.success', "Thêm mới thành công");
    }

    public function validateRole (Array $inputs)
    {
        $id = isset($inputs['code']) ? $inputs['code'] : null;

        Validator::make($inputs, [
            'code'          => ['required','unique:roles,code' ],
            'name'          => ['required'],
        ],
        [
            'code'          => [
                'required'  => 'Vui lòng nhập tên quyền',
                'unique'    => 'Quyền đã tồn tại trong hệ thống',
                'alpha_num' => 'Sai định dạng mã quyền'
            ],
            'name'         => [
                'required'     => 'Vui lòng nhập tên quyền',
            ]
        ])->validate();

    }
}
