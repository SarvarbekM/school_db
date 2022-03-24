<?php

namespace App\Http\Controllers;

use App\Models\ClassLessonTeacher;
use App\Models\EClass;
use App\Models\Lesson;
use App\Models\Teacher;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\CallableString;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $search['name'] = '';
        if (isset($request['name'])) {
            $search['name'] = $request['name'];
        }
        $objects = Lesson::getBuilder($search['name']);
        return view('dashboard.lesson.index', ['objects' => $objects->paginate(10), 'search' => $search]);
    }

    public function remove(Request $request)
    {
        if (isset($request['id'])) {
            $object = Lesson::find($request['id']);
            if ($object != null) {
                Lesson::destroy($object->id);
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
        //dd($request);
        $result = Lesson::add_edit($request->all());
        if (is_numeric($result)) {
            return back();
        } else {
            return back()->withErrors($result);
        }
    }
}
