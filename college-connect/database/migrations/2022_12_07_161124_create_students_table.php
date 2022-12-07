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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('student_id');
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('combination_id');
            $table->unsignedBigInteger('language_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('student_email');
            $table->string('student_phone');
            $table->string('student_password');
            $table->string('role')->default('student');

            $table->foreign('grade_id')
                ->references('id')
                ->on(\App\Models\grade\Grade::getTableName())
                ->onDelete('cascade');
            $table->foreign('section_id')
                ->references('id')
                ->on(\App\Models\grade\Section::getTableName())
                ->onDelete('cascade');
            $table->foreign('combination_id')
                ->references('id')
                ->on(\App\Models\subject\SubjectCombination::getTableName())
                ->onDelete('cascade');
            $table->foreign('language_id')
                ->references('id')
                ->on(\App\Models\subject\LanguageCombination::getTableName())
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
        Schema::dropIfExists('students');
    }
};
