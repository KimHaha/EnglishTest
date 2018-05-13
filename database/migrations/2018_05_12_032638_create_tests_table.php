<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->string('list_result');
            $table->text('list_choice');
            $table->string('content')->nullable();
            $table->decimal('score', 4, 1)->default(0);
            $table->integer('num_try')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('exam_id')
                ->references('id')->on('exams');
            $table->foreign('owner_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
