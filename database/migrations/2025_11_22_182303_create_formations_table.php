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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->integer('duration')->nullable()->comment('Durée en heures');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('level')->nullable()->comment('Niveau: débutant, intermédiaire, avancé');
            $table->integer('max_participants')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
