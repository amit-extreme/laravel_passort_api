<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('term_id');
            $table->dateTime('term_begin_date')->nullable();
            $table->dateTime('term_end_date')->nullable();
            $table->string('term_description',100)->nullable();
            $table->dateTime('date_update')->nullable();
            $table->dateTime('imported_date')->nullable();
            $table->bigInteger('import_info')->nullable();
            $table->string('import_conversion',100)->nullable();
            $table->string('term_group',100)->nullable();
            $table->bigInteger('earning_days')->nullable();
            $table->string('allow_online_enrollment',10)->nullable();
            $table->string('lms_active_term',10)->nullable();
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
        Schema::dropIfExists('terms');
    }
}
