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
            // $table->integer('office_id');
            $table->integer('service_id'); //this will replace office_id later
            $table->string('comments')->nullable()->comment('transcribed from image'); //admin user will transcribe the image to this
            $table->string('comments_path')->nullable();
            $table->string('signature_path');
            $table->integer('user_id')->comment('author');
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
