<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use RegistersUsers;
    public function info()
    {
        $users = User::withTrashed()->paginate(9)->toArray();
        $users['status'] = 0;
        $users['message']   =   'ok';
        return $users;
    }

    /**
     * 添加用户提交
     * @param UserCreateRequest $request
     * @return array
     */
    public function store(UserCreateRequest $request)
    {
//        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

//        $this->guard()->login($user);

        return ['message'=>"添加用户成功"];
//        return $this->registered($request, $user)
//            ?: redirect($this->redirectPath());
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:12', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * 显示用户编辑页面
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $user = $user->only(['id','name','email']);
        return view('admin.editUser', compact('user'));
    }

    /**
     * 用户修改提交
     * @param UserCreateRequest $request
     * @param User $user
     * @return array
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return ['message'=>"修改用户成功"];
    }
    /**
     * 恢复删除
     */
    public function restore($user)
    {
        $user = User::withTrashed()->find($user);
        if ($user->trashed()) {
            $user->restore();
        }
        return [
            'status'    =>  '1',
            'msg'   =>  '恢复成功'
        ];
    }

}
