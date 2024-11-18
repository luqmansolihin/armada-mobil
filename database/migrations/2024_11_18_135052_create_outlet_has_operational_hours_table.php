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
        Schema::create('outlet_has_operational_hours', function (Blueprint $table) {
            $table->foreignId('outlet_id')->constrained('outlets')->cascadeOnDelete();
            $table->string('day_from');
            $table->string('day_to');
            $table->time('open_time');
            $table->time('close_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outlet_has_operational_hours');
    }
};
