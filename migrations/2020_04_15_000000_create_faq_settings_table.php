<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('setting_label', 255)->nullable();
            $table->string('setting_name', 255);
            $table->boolean('bool_value')->nullable();
            $table->string('string_value', 400)->nullable();
            $table->text('text_value')->nullable();
            $table->integer('integer_value')->nullable();
            $table->decimal('decimal_value', 9, 2)->nullable();
            $table->string('description', 400)->nullable();
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
        Schema::drop('faq_settings');
    }
}
