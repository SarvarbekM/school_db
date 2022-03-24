<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $object = new Teacher();
            $object->full_name = 'Teacher ' . ($i + 1);
            $object->address = 'Address ' . ($i + 1);
            $object->speciality = 'Speciality ' . ($i + 1);
            $object->save();
        }
    }
}
