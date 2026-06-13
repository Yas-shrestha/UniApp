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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image');
            $table->date('date');
            $table->string('time');           // "10:00 AM – 02:00 PM"
            $table->string('location');
            $table->string('seats');          // "40 seats left", "Open to all", etc.
            $table->string('admission')->nullable(); // "Free for Grandview students"
            $table->text('intro');
            $table->json('points');           // "What You'll Learn" bullets
            $table->text('audience');         // "Who Should Attend"
            $table->string('speaker_name');
            $table->string('speaker_role');
            $table->string('speaker_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
