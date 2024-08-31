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
        Schema::create('tb_alternative_proportion', function (Blueprint $table) {
            $table->integer('history_id');
            $table->integer('alternative_id')->index('fk_tb_alternative_proportion_alternative_id_tb_alternative');
            $table->decimal('final_score', 10)->nullable();
            $table->integer('final_rank')->nullable();

            $table->primary(['history_id', 'alternative_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_alternative_proportion');
    }
};
