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
        Schema::create('operator', function (Blueprint $table) {
            $table->increments('operator_id');
            $table->string("full_name", 255);
            $table->string("age", 255);
            $table->string("contact_number", 255);
            $table->string("address", 255);
            $table->string("image_path")->default('example.jpg');
            $table->integer("user_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign("user_id")
                ->references("id")
                ->on("users")
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
        Schema::dropIfExists('operator');
    }
};
