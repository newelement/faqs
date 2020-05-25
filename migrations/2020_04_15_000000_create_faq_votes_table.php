<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_votes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip_address', 100);
            $table->bigInteger('faq_id');
            $table->tinyInteger('helpful')->default(0);
            $table->tinyInteger('not_helpful')->default(0);
            $table->timestamps();
            $table->index('faq_id');
            $table->index('helpful');
            $table->index('not_helpful');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faq_votes');
    }
}
