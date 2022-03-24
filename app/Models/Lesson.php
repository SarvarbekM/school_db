<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';
    public $timestamps = false;

    public static function getBuilder($name = '')
    {
        $objects = self::with('teachers', 'classes');
        if (!empty($name)) {
            $objects = $objects->where('name', 'LIKE', '%' . $name . '%');
        }
        $objects=$objects->orderBy('name');
        return $objects;
    }

    public static function add_edit($data)
    {
        if ($data['add_edit_id'] == 0) {
            $object = new Lesson();
            $object->name = $data['add_edit_name'];
            $object->save();
            return $object->id;
        } elseif ($data['add_edit_id'] > 0) {
            $object = self::find($data['add_edit_id']);
            if ($object != null) {
                $object->name = $data['add_edit_name'];
                $object->save();
                return $object->id;
            } else {
                return 'Not found';
            }
        } else {
            return 'Id is wrong';
        }
    }

    //<editor-fold desc="Relations">
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'class_lesson_teacher', 'lesson_id', 'teacher_id');
    }

    public function classes()
    {
        return $this->belongsToMany(EClass::class,'class_lesson_teacher','lesson_id','class_id');
    }
    //</editor-fold desc="Relations">
}
