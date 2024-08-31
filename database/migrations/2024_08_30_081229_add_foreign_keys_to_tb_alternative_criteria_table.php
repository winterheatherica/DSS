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
        Schema::table('tb_alternative_criteria', function (Blueprint $table) {
            $table->foreign(['alternative_id'], 'fk_tb_alternative_criteria_alternative_id_tb_alternative')->references(['alternative_id'])->on('tb_alternative')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['criteria_id'], 'fk_tb_alternative_criteria_criteria_id_tb_criteria')->references(['criteria_id'])->on('tb_criteria')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_alternative_criteria', function (Blueprint $table) {
            $table->dropForeign('fk_tb_alternative_criteria_alternative_id_tb_alternative');
            $table->dropForeign('fk_tb_alternative_criteria_criteria_id_tb_criteria');
        });
    }
};
