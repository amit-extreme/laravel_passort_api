<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('course_no')->nullable();
            $table->string('course_code',30)->nullable();
            $table->string('transcript_code',40)->nullable();
            $table->longText('course_description')->nullable();
            $table->float('units',8,2)->nullable();
            $table->float('hours',8,2)->nullable();
            $table->bigInteger('lab_course_no')->nullable();
            $table->string('active_status',10)->nullable();
            $table->smallInteger('class_size')->nullable();
            $table->longText('course_description_full')->nullable();
            $table->bigInteger('course_group_id')->nullable();
            $table->bigInteger('course_type_id')->nullable();
            $table->dateTime('date_updated')->nullable();
            $table->dateTime('imported_date')->nullable();
            $table->bigInteger('import_info')->nullable();
            $table->string('import_conversion',100)->nullable();
            $table->string('default_attendance_code',10)->nullable();
            $table->float('fa_units',8,2)->nullable();
            $table->string('allow_online_enrollment',10)->nullable();
            $table->string('external_id',200)->nullable();
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
        Schema::dropIfExists('courses');
    }
}
