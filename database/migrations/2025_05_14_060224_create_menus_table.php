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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');               // Menu name
            $table->string('url')->nullable();    // URL or route
            $table->string('icon_class')->nullable();    // URL or route
            $table->unsignedBigInteger('parent_id')->nullable(); // For submenus
            $table->integer('order')->default(0); // Ordering
            $table->boolean('status')->default(1); // 1 = active, 0 = inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
