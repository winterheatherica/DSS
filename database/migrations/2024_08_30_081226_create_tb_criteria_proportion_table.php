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
        Schema::create('tb_criteria_proportion', function (Blueprint $table) {
            $table->integer('history_id');
            $table->integer('criteria_id')->index('fk_tb_criteria_proportion_criteria_id_tb_criteria');
            $table->decimal('criteria_value', 10)->nullable();
            $table->char('criteria_priority', 1)->nullable();

            $table->primary(['history_id', 'criteria_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_criteria_proportion');
    }
};
