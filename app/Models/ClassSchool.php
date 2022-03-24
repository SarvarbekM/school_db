<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchool extends Model
{
    use HasFactory;

    protected $table = 'class_school';
    public $timestamps = false;
    protected $guarded=[];
}
