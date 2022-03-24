<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;

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

        $objects = User::on();
        return view('dashboard.user.index', ['objects' => $objects->paginate(10), 'search' => $search]);
    }
}
