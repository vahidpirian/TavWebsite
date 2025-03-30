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
        Schema::create('service_menus', function (Blueprint $table) {
            $table->id();
            $table->string('sub_top');
            $table->string('sub_bottom');
            $table->string('url')->nullable();
            $table->enum('url_type',['page','url'])->nullable();
            $table->string('icon')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreignId('parent_id')->nullable()->constrained('service_menus');
            $table->bigInteger('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_menus');
    }
};
