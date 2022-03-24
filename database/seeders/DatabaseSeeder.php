<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ClassSeeder::class,
            LessonSeeder::class,
            SchoolSeeder::class,
            TeacherSeeder::class,
        ]);
    }
}
