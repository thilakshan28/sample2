<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $this->authorize('index',new User);
        $q = request()->input('q');
        if($q)
        {
            $users = User::where('name','like',"%{$q}%")->orWhere('id','like',"%{$q}%")->with('role')->orderBy('id', 'desc')->paginate(12);
        }else{$users = User::with('role')->orderBy('id','desc')->paginate('12');}

        return view('admin.user.index',compact('users'));
    }

    public function create(){
        $this->authorize('create',new User);
        $roles1 =  Role::where('id','<=',5)->pluck('name','id')->toArray();
        $roles1[''] = '-----------Choose Your Role-----------';
        $roles2 =  Role::where('id','>',5)->pluck('name','id')->toArray();
        $roles2[''] = '-----------Choose Your Role-----------';
        return view('admin.user.create',compact('roles1','roles2'));
    }

    public function store(UserStoreRequest $request){
        $data = $request->validated();
        if($data['department'] == 'Educatin'){
            $role_id = $data['role_id1'];
        }else{
            $role_id = $data['role_id2'];
        }

        User::create([
            'name' => $data['name'],
            'department' => $data['department'],
            'email' => $data['email'],
            'role_id'=>$role_id,
            'password' =>Hash::make($data['password']),
        ]);

        return redirect()->route('user.index')->with('success', 'User has been created successfuly!');
    }

    public function show(User $user){
        return view('admin.user.show',compact('user'));
    }

    public function edit(User $user){
        $this->authorize('edit',new User);
        $roles1 =  Role::where('id','<=',5)->pluck('name','id')->toArray();
        $roles1[''] = '-----------Choose Your Role-----------';
        $roles2 =  Role::where('id','>',5)->pluck('name','id')->toArray();
        $roles2[''] = '-----------Choose Your Role-----------';
        return view('admin.user.edit',compact('roles1','roles2','user'));
    }

    public function update(User $user,UserUpdateRequest $request){
        $data=$request->validated();
        if($request->input('password')){
            $data['password'] = Hash::make($request->input('password'));
        }else{$data['password'] = $user->password;}

        if(Auth::user()->role->name =='Admin'){
        if($data['department'] == 'Education' ){
            $role_id = $data['role_id1'];
            unset($data['role_id1']);
            unset($data['role_id2']);
            $data['role_id'] = $role_id;
        }else{
            $role_id = $data['role_id2'];
            unset($data['role_id1']);
            unset($data['role_id2']);
            $data['role_id'] = $role_id;
        }
        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User  details has been updated successfuly!');
        }else{
            $data['department'] = $user->department;
            $data['email'] = $user->email;
            $data['role_id'] = $user->role_id;

            $user->update($data);
            return redirect()->route('dashboard')->with('success', 'Your Profile Updated!');
        }
    }

    public function delete(User $user){
        $user->load('posts');
        return view('admin.user.delete',compact('user'));
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User details has been deleted successfuly!');
    }
}
