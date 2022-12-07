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
        Schema::create('subject_combinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('subject1_id');
            $table->unsignedBigInteger('subject2_id');
            $table->unsignedBigInteger('subject3_id');
            $table->unsignedBigInteger('subject4_id');
            $table->timestamps();

            $table->foreign('subject1_id')
                ->references('id')
                ->on(\App\Models\subject\Subject::getTableName())
                ->onDelete('cascade');
            $table->foreign('subject2_id')
                ->references('id')
                ->on(\App\Models\subject\Subject::getTableName())
                ->onDelete('cascade');
            $table->foreign('subject3_id')
                ->references('id')
                ->on(\App\Models\subject\Subject::getTableName())
                ->onDelete('cascade');
            $table->foreign('subject4_id')
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
        Schema::dropIfExists('subject_combinations');
    }
};
