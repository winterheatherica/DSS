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
        Schema::table('tb_history', function (Blueprint $table) {
            $table->foreign(['method_id'], 'fk_tb_history_method_id_tb_method')->references(['method_id'])->on('tb_method')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'], 'fk_tb_history_user_id_tb_user')->references(['user_id'])->on('tb_user')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_history', function (Blueprint $table) {
            $table->dropForeign('fk_tb_history_method_id_tb_method');
            $table->dropForeign('fk_tb_history_user_id_tb_user');
        });
    }
};
