<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('grade_no')->nullable();
            $table->string('grade',200)->nullable();
            $table->float('number_grade',8,2)->nullable();
            $table->string('g_p_a',5)->nullable();
            $table->string('units_in_progress',5)->nullable();
            $table->string('units_attempted',5)->nullable();
            $table->string('units_completed',5)->nullable();
            $table->bigInteger('grade_sort_order')->nullable();
            $table->dateTime('date_updated')->nullable();
            $table->dateTime('imported_date')->nullable();
            $table->bigInteger('import_info')->nullable();
            $table->string('import_conversion',100)->nullable();
            $table->smallInteger('grade_weight')->nullable();
            $table->string('active',10)->nullable();
            $table->string('retake_update',10)->nullable();
            $table->string('c_f_grade',10)->nullable();
            $table->string('alternate_grade',100)->nullable();
            $table->string('s_a_p',100)->nullable();
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
        Schema::dropIfExists('grades');
    }
}
