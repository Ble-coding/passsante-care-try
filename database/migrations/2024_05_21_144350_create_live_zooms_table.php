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
        Schema::create('live_zooms', function (Blueprint $table) {
            $table->id();
            $table->string('consultation_title');
            $table->dateTime('consultation_date');
            $table->integer('duration_in_minute');
            $table->string('meeting_id')->nullable();
            $table->text('description')->nullable();
            $table->boolean('host_video')->default(false);
            $table->boolean('participant_video')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_zooms');
    }
};
