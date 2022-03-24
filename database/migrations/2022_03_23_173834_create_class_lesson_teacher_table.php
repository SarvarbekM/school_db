<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassLessonTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_lesson_teacher', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('class_id')->nullable();
            $table->unsignedInteger('lesson_id')->nullable();
            $table->unsignedInteger('teacher_id')->nullable();

            $table->foreign('class_id')
                ->references('id')
                ->on('classes')
                ->onDelete('cascade');

            $table->foreign('lesson_id')
                ->references('id')
                ->on('lessons')
                ->onDelete('cascade');

            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_lesson_teacher');
    }
}
