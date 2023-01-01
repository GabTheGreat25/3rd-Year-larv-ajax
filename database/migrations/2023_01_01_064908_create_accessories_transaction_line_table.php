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
        Schema::create('accessories_transaction_line', function (Blueprint $table) {
            $table->integer("transaction_id")->primary();
            $table->integer("accessories_id")->unsigned();
            $table->integer("quantity", false, false);
            $table
                ->foreign("accessories_id")
                ->references("accessories_id")
                ->on("accessories")
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
        Schema::dropIfExists('accessories_transaction_line');
    }
};
