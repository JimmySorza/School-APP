<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('room');
            $table->string('day');
            $table->string('time');
            $table->unsignedInteger('sitting_rows')->default(0);
            $table->unsignedInteger('sitting_cols')->default(0);
            $table->unsignedInteger('no_of_students')->default(0);
            $table->unsignedInteger('no_of_teachers')->default(0);
            $table->unsignedInteger('no_of_administration')->default(0);
            $table->timestamps();
        });

        Schema::create('period_student', function (Blueprint $table) {
            $table->unsignedBigInteger('period_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedInteger('matrix_place_row')->nullable();
            $table->unsignedInteger('matrix_place_col')->nullable();
        });

        Schema::create('period_teacher', function (Blueprint $table) {
            $table->unsignedBigInteger('period_id');
            $table->unsignedBigInteger('teacher_id');
        });

        Schema::create('period_administration', function (Blueprint $table) {
            $table->unsignedBigInteger('period_id');
            $table->unsignedBigInteger('administration_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('period_teacher');
        Schema::dropIfExists('period_student');
        Schema::dropIfExists('periods');
    }
}
