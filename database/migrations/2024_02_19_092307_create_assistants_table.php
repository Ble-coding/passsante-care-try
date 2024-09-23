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
        // Table assistant 
        Schema::create('assistants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->double('experience')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });

        // Table holidays 
        Schema::create('assistant_holidays', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('assistant_id');
            $table->string('date');
            $table->timestamps();
            
            $table->foreign('assistant_id')->references('id')->on('assistants')->onDelete('cascade')->onUpdate('cascade');
        });

// Table de session du travailleur social 
        Schema::create('assistant_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assistant_id')->constrained('assistants')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('session_meeting_time');
            $table->string('session_gap')->default(0);
            $table->timestamps();
        });

      
       

        // Table occupation du travailleur social 
        Schema::create('assistant_occupation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assistant_id');
            $table->unsignedBigInteger('occupation_id');
            $table->timestamps();

            $table->foreign('assistant_id')->references('id')->on('assistants')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('occupation_id')->references('id')->on('occupations')->onDelete('cascade')->onUpdate('cascade');
        });

        // les jours de la semaine 
        Schema::create('session_week_days_assistant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assistant_id')->constrained('assistants')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('assistant_session_id')->constrained('assistant_sessions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('day_of_week');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('start_time_type');
            $table->string('end_time_type');
            $table->timestamps();
        });

        // ajout de quelque table 
        Schema::table('assistants', function (Blueprint $table) {
            $table->string('twitter_url')->nullable()->after('experience');
            $table->string('linkedin_url')->nullable()->after('twitter_url');
            $table->string('instagram_url')->nullable()->after('linkedin_url');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistants');
        Schema::dropIfExists('assistant_holidays');
        Schema::drop('assistant_sessions');
        Schema::dropIfExists('assistant_occupation');
        Schema::dropIfExists('session_week_days_assistant');

    }
};
