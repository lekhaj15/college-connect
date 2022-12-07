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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('student_id');
            $table->string('attendance');

            $table->foreign('grade_id')
                ->references('id')
                ->on(\App\Models\grade\Grade::getTableName())
                ->onDelete('cascade');
            $table->foreign('section_id')
                ->references('id')
                ->on(\App\Models\grade\Section::getTableName())
                ->onDelete('cascade');
            $table->foreign('subject_id')
                ->references('id')
                ->on(\App\Models\subject\Subject::getTableName())
                ->onDelete('cascade');
            $table->foreign('staff_id')
                ->references('id')
                ->on(\App\Models\staff\Staff::getTableName())
                ->onDelete('cascade');
            $table->foreign('student_id')
                ->references('id')
                ->on(\App\Models\student\Student::getTableName())
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
        Schema::dropIfExists('attendances');
    }
};
