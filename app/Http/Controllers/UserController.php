<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search['first_name'] = '';
        $search['last_name'] = '';
        $search['bio'] = '';
        $search['email'] = '';

        if (isset($request['first_name'])) {
            $search['first_name'] = $request['first_name'];
        }
        if (isset($request['last_name'])) {
            $search['last_name'] = $request['last_name'];
        }
        if (isset($request['bio'])) {
            $search['bio'] = $request['bio'];
        }
        if (isset($request['email'])) {
            $search['email'] = $request['email'];
        }
        $objects = User::getBuilder($search['first_name'], $search['last_name'], $search['bio'], $search['email']);
        return view('dashboard.user.index', ['objects' => $objects->get(), 'search' => $search]);
    }

    public function arcade(Request $request)
    {
        if (isset($request['id'])) {
            if ($request['id'] == 0) {
                $user = new User();
                $user->id = 0;
            } else {
                $user = User::find($request['id']);
            }
            if ($user != null) {
                return view('dashboard.user.arcade', ['user' => $user]);
            } else {
                return view('errors.404', ['data' => '']);
            }
        } else {
            return view('errors.404', ['data' => '']);
        }
    }

    public function add_edit(Request $request)
    {
        if (isset($request['id'])) {
            if ($request['id'] == 0) {
                DB::statement('CALL addUser(:first_name, :last_name, :bio, :email, :password)', [
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'bio' => $request['bio'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);
            } else {
                $data = [
                    'user_id' => $request['id'],
                    'user_first_name' => $request['first_name'],
                    'user_last_name' => $request['last_name'],
                    'user_bio' => $request['bio'],
                    'user_email' => $request['email'],
                    'user_password' => $request['password'] != null ? Hash::make($request['password']) : '',
                ];
                DB::statement('CALL editUser(:user_id, :user_first_name, :user_last_name, :user_bio, :user_email, :user_password)', $data);
            }
            return redirect('/dashboard/user/index');
        } else {
            return back()->withErrors('User ID berilmagan');
        }
    }

    public function remove(Request $request)
    {
        if (isset($request['id'])) {
            DB::statement('CALL removeUser(:user_id)', [
                'user_id' => $request['id']
            ]);
            return back();
        } else {
            return back()->withErrors('User ID berilmagan');
        }
    }
}
