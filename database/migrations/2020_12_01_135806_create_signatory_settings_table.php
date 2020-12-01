<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignatorySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signatory_settings', function (Blueprint $table) {
            $table->id();
            $table->string('reviewer_name')->nullable();
            $table->string('reviewer_position')->nullable();
            $table->string('noter_name')->nullable();
            $table->string('noter_position')->nullable();
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
        Schema::dropIfExists('signatory_settings');
    }
}
