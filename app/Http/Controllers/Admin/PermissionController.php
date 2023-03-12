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
    const rad_Role = "system.permission.delete";
    public function index(Request $request)
    {
        $isUserDeleted = $request?->isUserDeleted;
        $isRoleDeleted = $request?->isRoleDeleted;

        if ($isUserDeleted) $user = User::with(['role'])->onlyTrashed()->get();
        else $user = User::with(['role'])->where('username', "<>", "superadmin")->whereStatus(User::active)->get();

        if ($isRoleDeleted) $roles = Roles::onlyTrashed()->get();
        else $roles = Roles::where('code', '<>', 'SUPER_ADMIN')->get();

        return Inertia::render('Admin/Permission/Permission', [
            'roles' =>  $roles,
            'permissions' => config('permissions'),
            'rad_Role'  => self::rad_Role,
            'users'     => $user,
            'isDeletedUserTab' => $isUserDeleted ?? 0,
            '$isRoleDeleted'    => $$isRoleDeleted ?? 0
        ]);
    }

    public function saveRole (Request $request)
    {
        $inputs = $request->all();
        $this->validateRole($inputs);

        $roleModel = Roles::find($inputs['id']) ?? new Roles();

        $roleModel->code = $inputs['code'];

        $roleModel->name = $inputs['name'];
        $roleModel->description = $inputs['description'];
        $roleModel->permissions = $inputs['permissions'];

        $result = $roleModel->save();

        $successMess = $inputs['id'] ? "Cập nhật thành công" : "Thêm mới thành công";
        $errorMess = $inputs['id'] ? "Cập nhật thất bại" : "Thêm mới thất bại";

        if (!$result) return redirect()->route('system.permission')
                            ->with('toast.error', $errorMess);
            return redirect()->route('system.permission')
                ->with('toast.success', $successMess);
    }

    public function deleteRole(String $id)
    {
        $role = Roles::find($id);

        if ($role->users()->exists()) return redirect()->route('system.permission')
        ->with('toast.warn', 'Có tài khoản đang sử dụng nhóm quyền. Không thể xoá');

        $result = $role->delete();

        if (!$result) return redirect()->route('system.permission')
                            ->with('toast.error', 'Xoá nhóm quyền thất bại');
            return redirect()->route('system.permission')
                ->with('toast.success', 'Đã xoá nhóm quyền');
    }

    public function restoreRole (String $id)
    {
        $role = Roles::onlyTrashed()->find($id);

        $result = $role->restore();

        if ($result) return redirect()->back()->with('toast.success', "Đã khôi phục quyền");
        return redirect()->back()->with('toast.error', "khôi phục quyền thất bại");
    }

    public function validateRole (Array $inputs)
    {
        $id = isset($inputs['id']) ? $inputs['id'] : null;

        Validator::make($inputs, [
            'code'          => ['required', 'unique:roles,code,'.$id],
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
