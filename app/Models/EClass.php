<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EClass extends Model
{
    use HasFactory;

    protected $table = 'classes';
    public $timestamps = false;

    public static function getBuilder($number = -1, $code = '')
    {
        $objects = self::with('schools', 'lessons');
        if ($number > 0) {
            $objects = $objects->where('number', $number);
        }
        if (!empty($code)) {
            $objects = $objects->where('code', 'LIKE', '%' . $code . '%');
        }
        $objects=$objects->orderBy('number');
        return $objects;
    }

    public static function add_edit($data)
    {
        if ($data['id'] == 0) {
            $object = new EClass();
            $object->number = $data['number'];
            $object->code = $data['code'];
            $object->save();
            return $object->id;
        } elseif ($data['id'] > 0) {
            $object = self::find($data['id']);
            if ($object != null) {
                $object->number = $data['number'];
                $object->code = $data['code'];
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
    public function schools()
    {
        return $this->belongsToMany(School::class, 'class_school', 'class_id', 'school_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'class_lesson_teacher', 'class_id', 'lesson_id')->with('teachers');
    }
    //</editor-fold desc="Relations">
}
