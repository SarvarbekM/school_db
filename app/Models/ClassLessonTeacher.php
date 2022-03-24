<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassLessonTeacher extends Model
{
    use HasFactory;

    protected $table = 'class_lesson_teacher';
    public $timestamps = false;
    protected $guarded=[];
}
