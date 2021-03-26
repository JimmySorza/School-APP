<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('obj_type');
            $table->unsignedBigInteger('obj_id');
            $table->string('obj_name');
            $table->string('trace_risk_level')->nullable();
            $table->unsignedInteger('trace_student_count')->default(0);
            $table->unsignedInteger('trace_teacher_count')->default(0);
            $table->unsignedInteger('trace_administration_count')->default(0);
            $table->timestamps();
        });

        Schema::create('trace_student', function (Blueprint $table) {
            $table->unsignedBigInteger('trace_id');
            $table->unsignedBigInteger('student_id');
            $table->string('trace_risk_level');
        });

        Schema::create('trace_teacher', function (Blueprint $table) {
            $table->unsignedBigInteger('trace_id');
            $table->unsignedBigInteger('teacher_id');
            $table->string('trace_risk_level');
        });

        Schema::create('trace_administration', function (Blueprint $table) {
            $table->unsignedBigInteger('trace_id');
            $table->unsignedBigInteger('administration_id');
            $table->string('trace_risk_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trace_administration');
        Schema::dropIfExists('trace_teacher');
        Schema::dropIfExists('trace_student');
        Schema::dropIfExists('traces');
    }
}
