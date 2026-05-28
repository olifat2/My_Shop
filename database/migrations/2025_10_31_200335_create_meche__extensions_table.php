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
        Schema::create('meche_extensions', function (Blueprint $table) {
            $table->id();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->string('nature');
            $table->string('marque');
            $table->string('style');
            $table->unsignedBigInteger('technique_pose_id');
            $table->string('pcs');
            $table->decimal('height', 5, 12);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meche__extensions');
    }
};
