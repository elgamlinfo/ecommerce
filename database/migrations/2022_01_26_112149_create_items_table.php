<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('itemnameEn')->nullable();
            $table->text('itemnameAr')->nullable();
            $table->integer('modelnumber')->nullable();
            $table->longtext('descriptionEn')->nullable();
            $table->longtext('descriptionAr')->nullable();
            $table->text('brandnameEn')->nullable();
            $table->text('brandnameAr')->nullable();
            $table->string('countrynameEn')->nullable();
            $table->string('countrynameAr')->nullable();
            $table->integer('outsidetoggle')->nullable();
            $table->float('pricebeforesale')->nullable();
            $table->float('discount')->nullable();
            $table->float('priceaftersale')->nullable();
            $table->float('saveingprice')->nullable();
            $table->float('rate')->nullable();
            $table->text('size')->nullable();
            $table->text('color')->nullable();
            $table->integer('stockquantity')->nullable();
            $table->integer('category_id')->nullable();
            $table->longtext('tags')->nullable();
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('items');
    }
}
