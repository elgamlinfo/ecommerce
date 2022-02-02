<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appsettings', function (Blueprint $table) {
            $table->bigIncrements('id');
            //emailshot
            $table->text('emailshotSubtitle')->nullable();
            $table->text('emailshotTitleEn')->nullable();
            $table->text('emailshotTitleAr')->nullable();
            $table->text('emailshotDescriptionEn')->nullable();
            $table->text('emailshotDescriptionAr')->nullable();
            $table->text('emailshotSupportText')->nullable();
            $table->text('emailshotSupportEmail')->nullable();
            $table->text('emailshotFacebook')->nullable();
            $table->text('emailshotInstagram')->nullable();
            $table->text('emailshotFooter')->nullable();
            $table->text('emailshotImagebg')->nullable();
            $table->string('emailshotLogo')->nullable();
            $table->string('emailshotColor')->nullable();
            $table->string('emailshotAdlink')->nullable();
            //emailshot
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
        Schema::dropIfExists('appsettings');
    }
}
