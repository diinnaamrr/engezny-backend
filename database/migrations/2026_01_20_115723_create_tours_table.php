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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean('is_featured')->default(false);
            $table->json('gallery')->nullable();
            $table->float('rating')->nullable();
            $table->string('destination')->nullable();
            $table->string('departure_place')->nullable();
            $table->date('departure_date')->nullable();
            $table->date('return_date')->nullable();
            $table->text('gallery_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
