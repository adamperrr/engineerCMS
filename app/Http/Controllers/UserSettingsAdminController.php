<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeUsersNameRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;


class UserSettingsAdminController extends Controller
{
    public function __construct()
    {
        Controller::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        $user = \Auth::user();

        return view('user-settings-admin.index', [
            'user' => $user,
        ]);
    }

    public function changePassword(ChangePasswordRequest $request) {
        $user = auth()->user();
        $hashedPasswordFromDB = $user->password;
        $newPassword = bcrypt($request->new_password);

        if (!Hash::check($request->old_password, $hashedPasswordFromDB)) {
            return back()->withErrors('Podaj poprawne aktualne hasło', 'password');
        }
        else{
            $user->password = $newPassword;
            $user->save();
            return redirect()->back()->with('messagePassword', 'Hasło zostało poprawnie zmienione.');
        }
    }

    public function changeName(ChangeUsersNameRequest $request) {
        $user = auth()->user();
        $user->name = $request->name;
        $user->save();
        return redirect()->back()->with('messageName', 'Imię zostało poprawnie zmienione.');
    }
}