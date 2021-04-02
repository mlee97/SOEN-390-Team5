<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikeSaleTable extends Migration
{
    /**
     * Run the migrations.
     * Responsible for creating the table.
     * @return void
     */
    public function up()
    {
        // Create a 'bike_sale' table.
        Schema::create('bike_sale', function (Blueprint $table) {

            // Defining the columns in the table.
            $table->foreignId('sale_id')->references('id')->on('sales');
            $table->foreignId('bike_id')->nullable()->references('id')->on('bikes')->nullOnDelete();
            $table->integer('quantity_sold');

        });
    }

    /**
     * Reverse the migrations.
     * Drops the table.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bike_sale');
    }
}
