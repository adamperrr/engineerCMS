<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use \App\User;
use \App\Role;

class UsersAdminController extends Controller
{
    public function __construct()
    {
        Controller::__construct();
        $this->middleware(['auth', 'checkSuperAdmin']);
    }

    public function index()
    {
        $users = User::with('roles')->get();

        return view('users-admin.index', [
            'users' => $users
        ]);
    }

    public function edit(User $user)
    {
        $roles = Role::get();

        return view('users-admin.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $userId =

        $currentEmail = $user->email;
        $currentRole = $user->roles[0]->id;

        $reqEmail = $request->email;
        $reqName = $request->name;
        $reqRole = $request->role;

        // dd([$currentEmail, $currentRole, $reqEmail, $reqName, $reqRole]);

        if($currentEmail != $reqEmail) {
            $userCheck = User::where('email', trim($reqEmail))->first();

            if($userCheck != null) {
                return back()->withErrors('Adres email musi być unikalny. W bazie istnieje już taki adres.');
            }

            $user->email = $reqEmail;
        }

        $role = null;
        if($currentRole != $reqRole) {
            $role = Role::where('id', $reqRole);
            if($role == null) {
                return back()->withErrors('Nieprawidłowy indentyfikator roli.');
            }

            $user->changeRole($reqRole);
        }

        $user->name = $reqName;
        $user->save();

        return redirect('/admin/users');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users-admin.index');
    }
}
