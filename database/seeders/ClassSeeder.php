<?php

namespace Database\Seeders;

use App\Models\EClass;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<9;$i++){
            $object=new EClass();
            $object->number=($i+1);
            $object->code=($i+1).' A';
            $object->save();
        }
    }
}
