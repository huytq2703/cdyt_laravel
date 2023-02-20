<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 100);
            $table->date('birthday');
            $table->tinyInteger('gender');
            $table->string('religion', 100)->nullable();
            $table->string('nation', 100)->nullable();
            $table->string('level');
            $table->string('priority_object', 100)->nullable();
            $table->unsignedInteger('majors_id');
            $table->string('email', 100);
            $table->string('phone_number', 15)->nullable();
            $table->string('address', 150)->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('ward_id')->nullable();

            $table->unsignedBigInteger('adviser_id')->nullable();
            $table->string('adviser_name', 100)->nullable();
            $table->string('adviser_email', 100)->nullable();
            $table->string('adviser_phone_number', 100)->nullable();

            $table->unsignedBigInteger('processor_id')->nullable();
            $table->string('processor_name', 100)->nullable();
            $table->string('processor_email', 100)->nullable();
            $table->string('processor_phone_number', 100)->nullable();

            $table->string('fist_send_email', 100)->nullable();

            $table->tinyInteger('status')->default(0);
            $table->string('verify_email_code')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('admissions');
    }
};
