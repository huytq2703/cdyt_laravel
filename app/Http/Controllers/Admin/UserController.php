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

    public function saveUser(Request $request)
    {
        $this->validateUser($request->all());
        $inputs = $request->all();

        try {
            if (isset($inputs['id']) && $inputs['id']) {
                $userModel = User::find($inputs['id']);
            } else {
                $userModel = new User();

                $userModel->username    = $inputs['username'];
                $userModel->email       = $inputs['email'];
                $userModel->password    = Hash::make($inputs['password']);

            }
            $userModel->role_code = $inputs['roleCode'];

            $result = $userModel->save();

            event(new Registered($userModel));
            if ($result) return redirect()->route('system.user')
            ->with('toast.success', "Cập nhật thành công");

            return redirect()->route('system.user')
                                ->with('toast.error', 'Cập nhât thất bại');
        } catch (\Throwable $th) {
            //throw $th;
            dd( $th);
        }
    }

    public function validateUser (Array $inputs)
    {
        $id = isset($inputs['id']) ? $inputs['id'] : null;
       return  Validator::make($inputs, [
            'username'      => ['required', 'alpha_num:ascii','unique:users,username,'.$id ],
            'email'         => ['nullable', 'email', 'unique:users,email,'.$id],
            'password'      => ['required_without:id', 'confirmed']
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
            'password'      => [
                'required_without'  => 'Vui lòng nhập mật khẩu',
                'confirmed' => 'Mật khẩu và nhập lại mật khẩu không giống nhau']
        ])->validate();
    }
}
