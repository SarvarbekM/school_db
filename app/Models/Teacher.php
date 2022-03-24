<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    public $timestamps = false;

    public static function getBuilder($full_name = '', $address = '', $speciality = '')
    {
        $objects = self::on();
        if (!empty($full_name)) {
            $objects = $objects->where('full_name', 'LIKE', '%' . $full_name . '%');
        }
        if (!empty($address)) {
            $objects = $objects->where('address', 'LIKE', '%' . $address . '%');
        }
        if (!empty($speciality)) {
            $objects = $objects->where('speciality', 'LIKE', '%' . $speciality . '%');
        }
        $objects = $objects->orderBy('full_name');
        return $objects;
    }

    public static function add_edit($data)
    {
        if ($data['add_edit_id'] == 0) {
            $object = new self();
            $object->full_name = $data['add_edit_full_name'];
            $object->address = $data['add_edit_address'];
            $object->speciality = $data['add_edit_speciality'];
            $object->save();
            return $object->id;
        } elseif ($data['add_edit_id'] > 0) {
            $object = self::find($data['add_edit_id']);
            if ($object != null) {
                $object->full_name = $data['add_edit_full_name'];
                $object->address = $data['add_edit_address'];
                $object->speciality = $data['add_edit_speciality'];
                $object->save();
                return $object->id;
            } else {
                return 'Not found';
            }
        } else {
            return 'Id is wrong';
        }
    }
}
