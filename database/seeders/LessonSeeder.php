<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lesson = new Lesson();
        $lesson->name = 'Fizika';
        $lesson->save();

        $lesson = new Lesson();
        $lesson->name = 'Matematika';
        $lesson->save();

        $lesson = new Lesson();
        $lesson->name = 'Adabiyot';
        $lesson->save();

        $lesson = new Lesson();
        $lesson->name = 'Ona tili';
        $lesson->save();

    }
}
