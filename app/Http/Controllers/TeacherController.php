<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $search['full_name'] = '';
        $search['address'] = '';
        $search['speciality'] = '';
        if (isset($request['full_name'])) {
            $search['full_name'] = $request['full_name'];
        }
        if (isset($request['address'])) {
            $search['address'] = $request['address'];
        }
        if (isset($request['speciality'])) {
            $search['speciality'] = $request['speciality'];
        }

        $objects = Teacher::getBuilder($search['full_name'], $search['address'], $search['speciality']);
        return view('dashboard.teacher.index', ['objects' => $objects->paginate(10), 'search' => $search]);
    }

    public function remove(Request $request)
    {

        if (isset($request['id'])) {
            $object = Teacher::find($request['id']);
            if ($object != null) {
                Teacher::destroy($object->id);
                return back();
            } else {
                return back()->withErrors('Not found class', '404');
            }
        } else {
            return back()->withErrors('Not found class', '404');
        }
    }

    public function add_edit(Request $request)
    {
        $result = Teacher::add_edit($request->all());
        if (is_numeric($result)) {
            return back();
        } else {
            return back()->withErrors($result);
        }
    }
}
