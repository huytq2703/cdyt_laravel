<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function index()
    {
        $userModel = new User();

        return Inertia::render('Admin/Users/User', [
            'users' => $userModel->getAll(),
            'roles' => Roles::get()
        ]);
    }

    public function saveUser(Request $request, String $userId = null)
    {
        $this->validateUser($request->all());
        $inputs = $request->all();

        try {
            if ($userId) {
                $userModel = User::find($inputs['id']);
                $userModel->username    = $inputs['username'];
                $userModel->email       = $inputs['email'];
                $userModel->role_code = $inputs['role_code'];
                $result = $userModel->save();
            } else {
                $userModel = new User();

                $userModel->username    = $inputs['username'];
                $userModel->email       = $inputs['email'];
                $userModel->role_code = $inputs['role_code'];
                $userModel->password    = Hash::make($inputs['password']);
                $result = $userModel->save();
                // event(new Registered($userModel));
            }

            $errorMess = $userId ? "Cập nhật tài khoản thất bại" : "Tạo tài khoản thất bại";
            $successMess = $userId ? "Cập nhật tài khoản thành công" : "Tạo tài khoản thất bại";


            if ($result) return redirect()->back()
            ->with('toast.success',  $successMess);

            return redirect()->back()
                                ->with('toast.error', $errorMess);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }

    public function restoreUser (String $id)
    {
        $user = User::onlyTrashed()->find($id);

        $result = $user->restore();

        if ($result) return redirect()->back()->with('toast.success', "Đã khôi phục tài khoản");
        return redirect()->back()->with('toast.error', "khôi phục tài khoản thất bại");
    }

    public function changePassword(Request $request, String $userId = null)
    {
        $user = User::find($userId);

        if (!$user)return redirect()->back()->with('toast.error', 'Không tìm thấy tài khoản');

        Validator::make($request->all(), [
            'password'      => ['required_without:id', 'confirmed']
        ],
        [
            'password'      => [
                'required_without'  => 'Vui lòng nhập mật khẩu',
                'confirmed' => 'Mật khẩu và nhập lại mật khẩu không giống nhau']
        ])->validate();

        $user->password    = Hash::make($request->password);

        $result = $user->save();

        if ($result) return redirect()->back()->with('toast.success', "Cập nhật thành công");
        return redirect()->back()->with('toast.error', "Cập nhật thất bại");
    }

    public function deleteUser (String $id)
    {
        $user = User::find($id);

        if (!$user) return redirect()->back()->with('toast.error', "Không tìm thấy tài khoản");

        $result = $user->delete();

        if ($result) return redirect()->back()->with('toast.success', "Đã xoá tài khoản");
        return redirect()->back()->with('toast.error', "Xoá tài khoản thất bại");
    }

    public function validateUser (Array $inputs)
    {
        $id = isset($inputs['id']) ? $inputs['id'] : null;
       return  Validator::make($inputs, [
            'username'      => ['required', 'alpha_num:ascii','unique:users,username,'.$id ],
            'email'         => ['nullable', 'email', 'unique:users,email,'.$id],
            'password'      => ['required_without:id', 'confirmed'],
            'role_code'     => ['required']
        ],
        [
            'username'      => [
                'required'  => 'Vui lòng nhập tài khoản',
                'unique'    => 'Email/Tài khoản đã được sử dụng',
                'alpha_num' => 'Sai định dạng tài khoản'
            ],
            'email'         => [
                'email'     => 'Email không đúng',
                'unique'    => "Email đã được sử dụng"
            ],
            'role_code'     => ['required' => "Vui lòng chọn nhóm quyền"],
            'password'      => [
                'required_without'  => 'Vui lòng nhập mật khẩu',
                'confirmed' => 'Mật khẩu và nhập lại mật khẩu không giống nhau'],

        ])->validate();
    }
}
