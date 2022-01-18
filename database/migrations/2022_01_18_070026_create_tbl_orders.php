<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('tbl_orders', function (Blueprint $table) {
             $table->id();
             $table->integer('product_id')->unsigned()->index()->nullable();
             $table->integer('quantity');
             $table->softDeletes();//deleted_at
             $table->timestamps();
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::dropIfExists('tbl_orders');
     }
}
