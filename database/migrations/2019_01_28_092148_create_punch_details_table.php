<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePunchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punch_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->default(1);
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->integer('employee_id')->unsigned();
//            $table->foreign('employee_id')->references('employee_id')->on('emp_professionals')->onDelete('RESTRICT');
            $table->string('device_id',50);
            $table->timestamp('attendance_datetime');
            $table->boolean('late_allow')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('punch_details');
    }
}
