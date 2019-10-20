<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiodataCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->integer('issue_number')->unique()->unsigned();
            $table->string('name',240);
            $table->string('mobile_no',35)->unique();
            $table->string('applied_post',240);
            $table->string('speciality',200)->nullable();
            $table->date('submission_date')->default(\Carbon\Carbon::now()->format('Y-m-d'));
            $table->mediumText('reference_name')->nullable();
            $table->mediumText('interview_status')->nullable();
            $table->mediumText('board_decision')->nullable();
            $table->string('file_path',240)->nullable();
            $table->date('joining_date')->nullable();
            $table->mediumText('remarks')->nullable();
            $table->unsignedInteger('previous_id')->default(0);
            $table->boolean('status')->default(1);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('RESTRICT');
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
        Schema::dropIfExists('biodata_collections');
    }
}
