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
        $table->foreignId('canteen_id')->constrained()->onDelete('cascade');
        $table->string('item_name');
        $table->decimal('price', 8, 2);
        $table->string('category')->nullable();      // e.g. Drinks, Rice, Snacks
        $table->boolean('availability')->default(true);
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
