<?php

namespace App\Http\Controllers;

use App\Models\ClassLessonTeacher;
use App\Models\ClassSchool;
use App\Models\EClass;
use App\Models\Lesson;
use App\Models\School;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $search['number'] = -1;
        $search['code'] = '';

        if (isset($request['number'])) {
            $search['number'] = $request['number'];
        }
        if (isset($request['code'])) {
            $search['code'] = $request['code'];
        }

        $objects = EClass::getBuilder($search['number'], $search['code']);

        return view('dashboard.class.index', ['objects' => $objects->paginate(10), 'search' => $search]);
    }

    public function arcade(Request $request)
    {
        if (isset($request['id'])) {
            $object = null;
            if ($request['id'] == 0) {
                $object = new EClass();
            }
            if ($request['id'] > 0) {
                $object = EClass::with('schools', 'lessons')->find($request['id']);
            }
            if ($object != null) {
                //dd($object);
                return view('dashboard.class.arcade', ['object' => $object, 'lessons' => Lesson::all(), 'teachers' => Teacher::all()]);
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
            $object = EClass::find($request['id']);
            if ($object != null) {
                EClass::destroy($object->id);
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
        $result = EClass::add_edit($request->all());
        if (is_numeric($result)) {
            return redirect('/dashboard/class/arcade?id=' . $result);
        } else {
            return back()->withErrors($result);
        }
    }

    public function add_lesson(Request $request)
    {
        ClassLessonTeacher::updateOrCreate([
            'class_id' => $request['class_id'],
            'lesson_id' => $request['lesson_id']
        ], [
            'teacher_id' => $request['teacher_id']
        ]);
        return back();
    }

    public function remove_lesson(Request $request)
    {
        $objects = ClassLessonTeacher::where('class_id', $request['class_id'])->where('lesson_id', $request['lesson_id'])->get();
        if ($objects->count() > 0) {
            ClassLessonTeacher::destroy($objects->pluck('id'));
        }
        return back();
    }
}
