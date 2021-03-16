<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Responsible for going from the up state to the down state, and vice versa.
 */
class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     * Responsible for creating the table.
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) { // Create a 'sales' table.
            // Defining the columns in the table.
            $table->id();
            $table->timestamps(); // When the record is created and updated.
            $table->integer('quantity_sold');
            $table->foreignId('bike_id')->references('id')->on('bikes');
        });
    }

    /**
     * Reverse the migrations.
     * Drops the table.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
