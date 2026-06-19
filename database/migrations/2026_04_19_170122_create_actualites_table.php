<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('actualites', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->string('image')->nullable();
            $table->date('date'); 
            $table->timestamps(); 
        });
    }
        
        //             Schema::create('tasks', function (Blueprint $table) {
        //     $table->id();
        //     $table->text('desc');
        //     $table->enum('status',['en cours','terminer'])->default('en cours');
        //     $table->foreignId('user_id')->constrained()->onDelete('cascade');
        //     $table->timestamps();
        // });
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actualites');
    }
};







            // $table->id();
            // $table->string('Numero_serie')->unique();
            // $table->integer('capacite')->default(100);
            // $table->string('sante_batterie');
            // $table->integer('nombre_cycles');
            // $table->string('statut');
            // $table->timestamps();




            // $table->id();
            // $table->string('numero_serie');
            // $table->foreignId('id_batteries')->constrained('batteries')->onDelete('cascade');
            // $table->date('date_derniere_m');
            // $table->date('date_prochaine_m');
            // $table->timestamps();



            // $table->id();
            // $table->string('nom');
            // $table->string('tele');
            // $table->string('email');
            // $table->string('specialite');
            // $table->timestamps();



            // $table->id();
            // $table->foreingId('id_trottinette')->constrained()->onDelete('cascade');
            // $table->foreingId('id_ancienne_batterie')->constrained()->onDelete('cascade');
            // $table->foreingId('id_nouvelle_batterie')->constrained()->onDelete('cascade');
            // $table->date('date_remplacement');
            // $table->foreingId('id_reparateur')->constrained()->onDelete('cascade');
            // $table->string('raison');
            // $table->timestamps();