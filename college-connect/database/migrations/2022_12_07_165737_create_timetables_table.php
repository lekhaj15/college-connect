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
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('section_id');
            $table->string('subject1');
            $table->string('subject2');
            $table->string('subject3');
            $table->string('subject4');
            $table->string('subject5');
            $table->string('subject6');
            $table->foreign('grade_id')
                ->references('id')
                ->on(\App\Models\grade\Grade::getTableName())
                ->onDelete('cascade');
            $table->foreign('section_id')
                ->references('id')
                ->on(\App\Models\grade\Section::getTableName())
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
        Schema::dropIfExists('timetables');
    }
};
