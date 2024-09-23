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
        Schema::create('portez_assistances', function (Blueprint $table) {
            $table->id('id');

            $table->string('assistance_date');

            $table->unsignedBigInteger('assistant_id');
            $table->unsignedInteger('patient_id');
    
            $table->time('heure_debut');
            $table->time('heure_fin');
    
            $table->unsignedTinyInteger('statut')->default(1);
            $table->json('vulnerabilites')->nullable();
    
            $table->unsignedTinyInteger('type')->nullable();
            $table->unsignedTinyInteger('motif_enquete')->nullable();
            $table->unsignedTinyInteger('decision')->nullable();
            $table->unsignedTinyInteger('etat_enquete')->nullable();
    
            $table->json('motif_service')->nullable();
            $table->text('autre_motif_service')->nullable();
    
            $table->json('activites_menees')->nullable();
            $table->text('autres_activites')->nullable();
            $table->unsignedTinyInteger('delai')->nullable();
            $table->unsignedTinyInteger('resultat_realisation')->nullable();
    
            $table->json('devenir_du_cas')->nullable();
            $table->text('observation')->nullable();
    
            $table->timestamps();
    
    
            $table->foreign('assistant_id')->references('id')->on('assistants')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portez_assistances');
    }
};
