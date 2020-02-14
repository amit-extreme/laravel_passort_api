<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_no')->nullable();
            $table->string('ssn',100)->nullable();
            $table->string('student_id',100)->nullable();
            $table->string('last_name',100)->nullable();
            $table->string('first_name',100)->nullable();
            $table->string('middle_name',100)->nullable();
            $table->string('maiden_name',100)->nullable();
            $table->string('gender',20)->nullable();
            $table->dateTime('address_modification_date')->nullable();
            $table->string('address',100)->nullable();
            $table->string('address2nd_ln',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('zip',100)->nullable();
            $table->string('home_phone',100)->nullable();
            $table->string('work_phone',100)->nullable();
            $table->string('emergency_phone',100)->nullable();
            $table->string('mobile_phone',100)->nullable();
            $table->string('email',100)->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->bigInteger('ethnic_id')->nullable();
            $table->string('marital_status',10)->nullable();
            $table->bigInteger('dependents')->nullable();
              $table->bigInteger('campus_id')->nullable();
            $table->string('language',100)->nullable();
            $table->string('country_old',100)->nullable();
            $table->bigInteger('funding_no')->nullable();
            $table->string('drivers_license',100)->nullable();
            $table->bigInteger('admin_rep_emp_id')->nullable();
            $table->bigInteger('ad_source')->nullable();
            $table->bigInteger('first_term_id')->nullable();
            $table->string('restart',10)->nullable();
            $table->bigInteger('second_term_id')->nullable();
            $table->bigInteger('student_status_id')->nullable();
            $table->dateTime('student_status_date')->nullable();
            $table->bigInteger('previous_status_id')->nullable();
            $table->bigInteger('program_no')->nullable();
            $table->decimal('unit_cost',8,2)->nullable();
            $table->decimal('term_cost',8,2)->nullable();
            $table->bigInteger('student_group_id')->nullable();
            $table->string('student_group_status',40)->nullable();
            $table->string('session',20)->nullable();
            $table->string('full_part_time',20)->nullable();
            $table->dateTime('lda')->nullable();
            $table->dateTime('previous_lda')->nullable();
            $table->bigInteger('drop_no')->nullable();
            $table->string('drop_comment',100)->nullable();
            $table->dateTime('determination_date')->nullable();
            $table->dateTime('externship_starts')->nullable();
            $table->dateTime('expected_grad_date')->nullable();
            $table->dateTime('second_grad_date')->nullable();
            $table->bigInteger('placement_status')->nullable();
            $table->bigInteger('counselor_emp_id')->nullable();
            $table->longText('notes')->nullable();
            $table->dateTime('mid_point')->nullable();
            $table->dateTime('drop_date')->nullable();
            $table->dateTime('grade_date')->nullable();
            $table->dateTime('transfer_date')->nullable();
            $table->decimal('prior_earnings',8,2)->nullable();
            $table->bigInteger('leads_id')->nullable();
            $table->dateTime('default_transfer')->nullable();
            $table->dateTime('creation_date')->nullable();
            $table->dateTime('modified_date')->nullable();
            $table->dateTime('imported_date')->nullable();
            $table->bigInteger('import_info')->nullable();
            $table->string('import_conversion',100)->nullable();
            $table->bigInteger('current_enrollment_id')->nullable();
            $table->string('student_tuition_type',50)->nullable();
            $table->string('ssn_id',60)->nullable();
            $table->string('school_defined01',80)->nullable();
            $table->string('school_defined02',80)->nullable();
            $table->float('school_defined03',8,2)->nullable();
            $table->bigInteger('student_custom_list1')->nullable();
            $table->bigInteger('student_custom_list2')->nullable();
            $table->string('archived',5)->nullable();
            $table->longText('picture_path')->nullable();
            $table->string('address_country',255)->nullable();
            $table->dateTime('projected_grad_date')->nullable();
            $table->dateTime('student_custom_date')->nullable();
            $table->decimal('monthly_earnings',8,2)->nullable();
            $table->bigInteger('school_contact_id')->nullable();
            $table->bigInteger('placement_advisor_emp_id')->nullable();
            $table->string('use_email',10)->nullable();
            $table->longText('resume_path')->nullable();
            $table->bigInteger('ethnicity_id')->nullable();
            $table->string('drivers_license_state',255)->nullable();
            $table->string('1098_t',100)->nullable();
            $table->string('ethnicity_detail',100)->nullable();
            $table->bigInteger('student_custom_list3')->nullable();
            $table->string('email2',100)->nullable();
            $table->string('bad_address',5)->nullable();
            $table->string('bad_home_phone',100)->nullable();
            $table->string('ferpa_dbi',5)->nullable();
            $table->string('ssn_certification',5)->nullable();
            $table->string('use_sms',5)->nullable();
            $table->string('adm_user_id',255)->nullable();
            $table->string('country',255)->nullable();
            $table->string('moodle_id',100)->nullable();
            $table->string('state_of_residency',100)->nullable();
            $table->string('mobile_phone_opt_out',5)->nullable();
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
        Schema::dropIfExists('students');
    }
}
