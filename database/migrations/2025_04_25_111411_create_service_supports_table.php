<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_supports', function (Blueprint $table) {
            $table->id();
            $table->string('small_title');
            $table->string('title');
            $table->text('description');
            $table->string('button_text');
            $table->enum('url_type',['page','url'])->nullable();
            $table->string('url')->nullable();
            $table->string('image');
            $table->tinyInteger('status')->default(0);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_supports');
    }
};
