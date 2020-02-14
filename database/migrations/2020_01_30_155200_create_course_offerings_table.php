<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseOfferingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_offerings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('course_offering_no');
            $table->bigInteger('course_no')->nullable();
            $table->string('session',100)->nullable();
            $table->float('term_hours',8,2)->nullable();
            $table->float('class_hours',8,2)->nullable();
            $table->dateTime('class_start_time')->nullable();
            $table->dateTime('class_end_time')->nullable();
            $table->smallInteger('session_no')->nullable();
            $table->bigInteger('room_no')->nullable();
            $table->bigInteger('instructor_id')->nullable();
            $table->bigInteger('assistant_id')->nullable();
            $table->smallInteger('class_size')->nullable();
            $table->bigInteger('status_id')->nullable();
            $table->string('attendance_type',100)->nullable();
            $table->dateTime('date_updated')->nullable();
            $table->dateTime('imported_date')->nullable();
            $table->bigInteger('import_info')->nullable();
            $table->string('import_conversion',100)->nullable();
            $table->string('default_attendance_code',100)->nullable();
            $table->string('external_id',100)->nullable();
            $table->dateTime('course_offering_begin_date')->nullable();
            $table->dateTime('course_offering_end_date')->nullable();
            $table->bigInteger('campus_id')->nullable();
            $table->bigInteger('lms_active')->nullable();
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
        Schema::dropIfExists('course_offerings');
    }
}
