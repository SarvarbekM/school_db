<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_school', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('class_id')->nullable();
            $table->unsignedInteger('school_id')->nullable();

            $table->foreign('class_id')
                ->references('id')
                ->on('classes')
                ->onDelete('cascade');

            $table->foreign('school_id')
                ->references('id')
                ->on('schools')
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
        Schema::dropIfExists('class_school');
    }
}
