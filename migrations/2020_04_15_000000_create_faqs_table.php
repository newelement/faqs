<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 400);
            $table->string('slug', 400)->unique();
            $table->bigInteger('faq_groups_id')->nullable();
            $table->text('answer')->nullable();
            $table->string('keywords', 400)->nullable();
            $table->integer('helpful')->default(0);
            $table->integer('not_helpful')->default(0);
            $table->integer('sort')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index('slug');
            $table->index('faq_groups_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faqs');
    }
}
