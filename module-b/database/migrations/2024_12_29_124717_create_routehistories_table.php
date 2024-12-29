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
        Schema::create('routehistories', function (Blueprint $table) {
            $table->id();
            $table->integer('from_place_id');
            $table->integer('to_place_id');
            $table->json('schedule_ids');

            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->foreign('from_place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('to_place_id')->references('id')->on('places')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routehistories');
    }
};
