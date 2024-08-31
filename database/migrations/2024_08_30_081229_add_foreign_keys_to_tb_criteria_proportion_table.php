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
        Schema::table('tb_criteria_proportion', function (Blueprint $table) {
            $table->foreign(['criteria_id'], 'fk_tb_criteria_proportion_criteria_id_tb_criteria')->references(['criteria_id'])->on('tb_criteria')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['history_id'], 'fk_tb_criteria_proportion_history_id_tb_history')->references(['history_id'])->on('tb_history')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_criteria_proportion', function (Blueprint $table) {
            $table->dropForeign('fk_tb_criteria_proportion_criteria_id_tb_criteria');
            $table->dropForeign('fk_tb_criteria_proportion_history_id_tb_history');
        });
    }
};
