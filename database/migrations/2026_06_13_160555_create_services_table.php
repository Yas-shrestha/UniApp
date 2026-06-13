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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['traditional', 'future']);
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('body');
            $table->json('points')->nullable();
            $table->string('catalog_pdf')->nullable();
            $table->string('catalog_doc')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
