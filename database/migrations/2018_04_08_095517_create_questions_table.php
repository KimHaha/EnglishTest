<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // table questions 
        // weight diff skill support evaluate exam
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->unique();
            $table->integer('weight');
            $table->integer('difficult');
            $table->string('skill');
            $table->integer('group_id')->unsigned()->nullable();
            $table->text('question');
            $table->text('choice')->nullable();
            $table->text('solution');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('set null');

            $table->foreign('updated_by')
                ->references('id')->on('users')
                ->onDelete('set null');

            $table->timestamps();
        });

        // group many question to one paragraph
        Schema::create('group_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->text('paragraph');
            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onDelete('cascade');
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('group_questions')->onDelete('cascade');
        });

        // many to many relation category and question
        Schema::create('category_question', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('question_id')->unsigned();

            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')->on('categories')
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
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign('questions_group_id_foreign');
        });
        Schema::dropIfExists('group_questions');
        Schema::dropIfExists('category_question');
        Schema::dropIfExists('questions');
    }
}
