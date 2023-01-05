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
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->string("username", 255);
            $table->string("contact_number", 255);
            $table->string("comments", 255);
            $table->string("ratings", 255);
            $table->string("image_path")->default('example.jpg');
            $table->integer("operator_id")->unsigned();
            $table
                ->foreign("operator_id")
                ->references("operator_id")
                ->on("operator")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
};
