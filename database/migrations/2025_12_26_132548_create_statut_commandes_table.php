<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('statut_commandes', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique(); // ex: pending, paid, shipped, cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statut_commandes');
    }
};
