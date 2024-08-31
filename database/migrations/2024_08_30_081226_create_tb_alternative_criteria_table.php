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
        Schema::create('tb_alternative_criteria', function (Blueprint $table) {
            $table->integer('alternative_id');
            $table->integer('criteria_id')->index('fk_tb_alternative_criteria_criteria_id_tb_criteria');
            $table->decimal('alternative_criteria_value', 10)->nullable();

            $table->primary(['alternative_id', 'criteria_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_alternative_criteria');
    }
};
