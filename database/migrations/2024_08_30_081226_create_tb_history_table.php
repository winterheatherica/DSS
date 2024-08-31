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
        Schema::create('tb_history', function (Blueprint $table) {
            $table->integer('history_id', true);
            $table->integer('method_id')->nullable()->index('fk_tb_history_method_id_tb_method');
            $table->integer('user_id')->nullable()->index('fk_tb_history_user_id_tb_user');
            $table->string('case_name', 100)->nullable();
            $table->decimal('primary_weight', 10)->nullable();
            $table->decimal('secondary_weight', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_history');
    }
};
