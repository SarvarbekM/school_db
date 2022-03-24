<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';
    public $timestamps = false;

    public static function getBuilder($number = -1, $name = '', $address = '')
    {
        $objects = self::with('classes');
        if ($number > 0) {
            $objects = $objects->where('number', $number);
        }
        if (!empty($name)) {
            $objects = $objects->where('name', 'LIKE', '%' . $name . '%');
        }
        if (!empty($address)) {
            $objects = $objects->where('address', 'LIKE', '%' . $address . '%');
        }
        $objects=$objects->orderBy('number');
        return $objects;
    }

    public static function add_edit($data)
    {
        if ($data['id'] == 0) {
            $object = new School();
            $object->number = $data['number'];
            $object->name = $data['name'];
            $object->address = $data['address'];
            $object->save();
            return $object->id;
        } elseif ($data['id'] > 0) {
            $object = self::find($data['id']);
            if ($object != null) {
                $object->number = $data['number'];
                $object->name = $data['name'];
                $object->address = $data['address'];
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
    public function classes()
    {
        return $this->belongsToMany(EClass::class, 'class_school', 'school_id', 'class_id');
    }
    //</editor-fold desc="Relations">
}
