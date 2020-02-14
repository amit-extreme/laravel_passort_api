<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseOfferingStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_offering_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_no');
            $table->bigInteger('course_offering_no');
            $table->bigInteger('student_no');
            $table->bigInteger('grade_no')->nullable();
            $table->bigInteger('status_id')->nullable();
            $table->dateTime('inactive_date')->nullable();
            $table->dateTime('imported_date')->nullable();
            $table->bigInteger('import_info')->nullable();
            $table->string('import_conversion',80);
            $table->bigInteger('student_enrollment_id')->nullable();
            $table->bigInteger('mid_point_grade_no')->nullable();
            $table->string('detail',80);
            $table->bigInteger('program_req_header_course_id')->nullable();
            $table->dateTime('course_begin_date')->nullable();
            $table->dateTime('course_end_date')->nullable();
            $table->string('program_requirement',80)->nullable();
            $table->decimal('grade_numeric',8,2)->nullable();
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
        Schema::dropIfExists('course_offering_students');
    }
}
