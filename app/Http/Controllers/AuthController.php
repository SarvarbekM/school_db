<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function signIn(Request $request)
    {
        //dd($request);
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //dd($credentials);
        $user = User::where('email', $credentials['email'])->first();
        if ($user != null) {

            if (Hash::check($credentials['password'], $user->password)) {
                Auth::login($user, $request['remember_me']);
                return redirect()->intended('dashboard');
            }
        }
//        if (Auth::attempt($credentials,$request['remember_me'])) {
//            dd($request);
//            $request->session()->regenerate();
//
//            return redirect()->intended('dashboard');
//        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile(Request $request)
    {
        return view('dashboard.profile', ['user' => Auth::user()]);
    }

    protected function validatorProfile(array $data)
    {
        $validate = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'old_password' => 'required',
        ];

        if ($data['new_password'] != null) {
            $validate['new_password'] = 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/';

        }
        $validator = Validator::make($data, $validate);

        $validator->after(function ($validator) use ($data) {
            $current_user = Auth::user();

            if (!Hash::check($data['old_password'], $current_user->password)) {
                $validator->errors()->add('old_password_wrong', 'Joriy parol noto\'g\'ri kiritildi');
            }

            $users = User::where([
                ['email', '=', $data['email']],
                ['id', '<>', $current_user->getAuthIdentifier()]
            ])->get();
            if ($users->count() > 0) {
                $validator->errors()->add('email_have', 'Mazkur email oldin ro\'yxatdan o\'tgan');
            }

            if ($data['new_password'] != null || $data['confirm_new_password'] != null) {
                if (strcmp($data['new_password'], $data['confirm_new_password']) != 0) {
                    $validator->errors()->add('confirm_not_equal', 'Yangi parol tasdiqlanmadi');
                }
            }
        });
        return $validator;
    }


    public function edit_profile(Request $request)
    {
        $this->validatorProfile($request->all())->validate();
        $user = Auth::user();
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->bio = $request['bio'];
        $user->email = $request['email'];
        if (isset($request['new_password']) and $request['new_password'] != null) {
            $user->password = Hash::make($request['new_password']);
        }
        $user->save();

        return back();
    }

    public function about(Request $request)
    {
        return view('dashboard.about');
    }
}
