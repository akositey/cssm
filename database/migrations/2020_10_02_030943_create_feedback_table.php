<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('ip_id');
            $table->tinyInteger('question1');
            $table->tinyInteger('question2');
            $table->tinyInteger('question3');
            $table->tinyInteger('positive1')->nullable();
            $table->tinyInteger('positive2')->nullable();
            $table->tinyInteger('positive3')->nullable();
            $table->tinyInteger('positive4')->nullable();
            $table->tinyInteger('positive5')->nullable();
            $table->tinyInteger('positive6')->nullable();
            $table->tinyInteger('negative1')->nullable();
            $table->tinyInteger('negative2')->nullable();
            $table->tinyInteger('negative3')->nullable();
            $table->tinyInteger('negative4')->nullable();
            $table->tinyInteger('negative5')->nullable();
            $table->tinyInteger('negative6')->nullable();
            $table->tinyInteger('negative7')->nullable();
            $table->tinyInteger('negative8')->nullable();
            $table->string('suggestion')->nullable();
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
        Schema::dropIfExists('feedback');
    }
}
