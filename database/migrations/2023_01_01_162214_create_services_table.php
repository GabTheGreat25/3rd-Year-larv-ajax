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
        Schema::create('services', function (Blueprint $table) {
            $table->increments('services_id');
            $table->string("service_type", 255);
            $table->date("date_of_service");
            $table->integer("price", false, false);
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
        Schema::dropIfExists('services');
    }
};
