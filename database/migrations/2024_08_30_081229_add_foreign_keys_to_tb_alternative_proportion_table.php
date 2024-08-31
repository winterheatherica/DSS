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
        Schema::table('tb_alternative_proportion', function (Blueprint $table) {
            $table->foreign(['alternative_id'], 'fk_tb_alternative_proportion_alternative_id_tb_alternative')->references(['alternative_id'])->on('tb_alternative')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['history_id'], 'fk_tb_alternative_proportion_history_id_tb_history')->references(['history_id'])->on('tb_history')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_alternative_proportion', function (Blueprint $table) {
            $table->dropForeign('fk_tb_alternative_proportion_alternative_id_tb_alternative');
            $table->dropForeign('fk_tb_alternative_proportion_history_id_tb_history');
        });
    }
};
