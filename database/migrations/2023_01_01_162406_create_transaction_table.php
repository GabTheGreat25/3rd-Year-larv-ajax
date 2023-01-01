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
        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('transaction_id');
            $table->date("date_of_rent");
            $table->string("payment_type", 255);
            $table->string("shipment_type", 255);
            $table->string("status", 255)->default('Not Paid');
            $table->string("image_path")->default('example.jpg');
            $table->integer("client_id")->unsigned();
            $table
                ->foreign("client_id")
                ->references("client_id")
                ->on("client")
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
        Schema::dropIfExists('transaction');
    }
};
