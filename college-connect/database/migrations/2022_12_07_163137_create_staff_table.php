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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('staff_id');
            $table->unsignedBigInteger('subject_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('student_email');
            $table->string('student_phone');
            $table->string('student_password');
            $table->string('role')->default('staff');

            $table->foreign('subject_id')
                ->references('id')
                ->on(\App\Models\subject\Subject::getTableName())
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
};
