<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);
        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy("name")->get();
        return view("user.create")->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->name = $request->input('name');
        $user->password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        if($user->password == $confirm_password) {
            $user->password = bcrypt($user->password);
            $user->save();
            return redirect('/users')->with('success', 'User is added successfuly!');
        } else {
            return redirect('/users/create')->with('error', 'Password and confirm password have to be the same!');
        }
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
        $user = User::find($id);
        $roles = Role::orderBy("name")->get();
        $data = [
            'user' => $user,
            'roles' => $roles
        ];
        return view("user.edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, $id)
    {
        $validated = $request->validated();

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        if($user->password == $confirm_password) {
            $user->save();
            return redirect('/users')->with('success', 'User is updated successfully');
        } else {
            return redirect('/users/' . $user->id . '/edit')->with('error', 'Password and confirmed password have to be the same!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('success', 'User is deleted successfuly');
    }
}
