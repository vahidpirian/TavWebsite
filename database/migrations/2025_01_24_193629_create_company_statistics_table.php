<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyStatisticsTable extends Migration
{
    public function up()
    {
        Schema::create('company_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('number');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_statistics');
    }
} 