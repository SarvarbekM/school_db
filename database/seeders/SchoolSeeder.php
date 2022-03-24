<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $object = new School();
            $object->number = $i + 1;
            $object->name = ($i + 1) . '-umumiy o\'rta ta\'lim maktabi';
            $object->address = 'Address ' . ($i + 1);
            $object->save();
        }
    }
}
