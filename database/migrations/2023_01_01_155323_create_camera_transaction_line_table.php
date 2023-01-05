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
        Schema::create('camera_transaction_line', function (Blueprint $table) {
            $table->integer("transaction_id")->primary();
            $table->integer("camera_id")->unsigned();
            $table->integer("quantity", false, false);
            $table
                ->foreign("camera_id")
                ->references("camera_id")
                ->on("camera")
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
        Schema::dropIfExists('camera_transaction_line');
    }
};
