<?php

namespace App\Http\Controllers;

use App\Models\ClassSchool;
use App\Models\EClass;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $search['number'] = -1;
        $search['name'] = '';
        $search['address'] = '';

        if (isset($request['number'])) {
            $search['number'] = $request['number'];
        }
        if (isset($request['name'])) {
            $search['name'] = $request['name'];
        }
        if (isset($request['address'])) {
            $search['address'] = $request['address'];
        }
        $objects = School::getBuilder($search['number'], $search['name'], $search['address']);

        return view('dashboard.school.index', ['objects' => $objects->paginate(10), 'search' => $search]);
    }

    public function arcade(Request $request)
    {
        if (isset($request['id'])) {
            $object = null;
            if ($request['id'] == 0) {
                $object = new School();
                $object->id = 0;
            }
            if ($request['id'] > 0) {
                $object = School::with('classes')->find($request['id']);
            }
            if ($object != null) {
                return view('dashboard.school.arcade', ['object' => $object, 'classes' => EClass::all()]);
            } else {
                return view('errors.404', ['data' => '']);
            }
        } else {
            return view('errors.404', ['data' => '']);
        }
    }

    public function remove(Request $request)
    {
        if (isset($request['id'])) {
            $object = School::find($request['id']);
            if ($object != null) {
                School::destroy($object->id);
                return back();
            } else {
                return back()->withErrors(['message' => $request['id'].' IDli maktab topilmaod ']);
            }
        } else {
            return back()->withErrors(['message' => 'maktab IDsi berilmagan']);
        }
    }

    public function add_edit(Request $request)
    {
        $result = School::add_edit($request->all());
        if (is_numeric($result)) {
            return redirect('/dashboard/school/arcade?id=' . $result);
        } else {
            return back()->withErrors($result);
        }
    }

    public function add_class(Request $request)
    {
        ClassSchool::updateOrCreate([
            'school_id' => $request['school_id'],
            'class_id' => $request['sinf']
        ]);
        return back();
    }

    public function remove_class(Request $request)
    {
        $objects = ClassSchool::where('school_id', $request['school_id'])->where('class_id', $request['class_id'])->get();
        if ($objects->count() > 0) {
            ClassSchool::destroy($objects->pluck('id'));
        }
        return back();
    }
}
