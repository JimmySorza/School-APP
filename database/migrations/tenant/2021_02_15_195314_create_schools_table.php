<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('city')->nullable();
            $table->string('email')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('logo')->nullable();
            $table->integer('trace_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
}
