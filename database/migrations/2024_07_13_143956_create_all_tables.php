<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_alternative', function (Blueprint $table) {
            $table->integer('alternative_id')->primary();
            $table->string('alternative_name', 100)->nullable();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });

        Schema::create('tb_alternative_criteria', function (Blueprint $table) {
            $table->integer('alternative_id');
            $table->integer('criteria_id');
            $table->decimal('alternative_criteria_value', 10, 2)->nullable();
            $table->primary(['alternative_id', 'criteria_id']);
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });

        Schema::create('tb_alternative_proportion', function (Blueprint $table) {
            $table->integer('history_id');
            $table->integer('alternative_id');
            $table->decimal('final_score', 10, 2)->nullable();
            $table->integer('final_rank')->nullable();
            $table->primary(['history_id', 'alternative_id']);
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });

        Schema::create('tb_criteria', function (Blueprint $table) {
            $table->integer('criteria_id')->primary();
            $table->string('criteria_name', 100)->nullable();
            $table->char('criteria_status', 1)->nullable();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });

        Schema::create('tb_criteria_proportion', function (Blueprint $table) {
            $table->integer('history_id');
            $table->integer('criteria_id');
            $table->decimal('criteria_value', 10, 2)->nullable();
            $table->char('criteria_priority', 1)->nullable();
            $table->primary(['history_id', 'criteria_id']);
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });

        Schema::create('tb_history', function (Blueprint $table) {
            $table->integer('history_id')->primary();
            $table->integer('method_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('case_name', 100)->nullable();
            $table->decimal('primary_weight', 10, 2)->nullable();
            $table->decimal('secondary_weight', 10, 2)->nullable();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });

        Schema::create('tb_method', function (Blueprint $table) {
            $table->integer('method_id')->primary();
            $table->string('method_name', 50)->nullable();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });

        Schema::create('tb_user', function (Blueprint $table) {
            $table->integer('user_id')->primary();
            $table->string('username', 50)->nullable();
            $table->string('password', 100)->nullable();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_user');
        Schema::dropIfExists('tb_method');
        Schema::dropIfExists('tb_history');
        Schema::dropIfExists('tb_criteria_proportion');
        Schema::dropIfExists('tb_criteria');
        Schema::dropIfExists('tb_alternative_proportion');
        Schema::dropIfExists('tb_alternative_criteria');
        Schema::dropIfExists('tb_alternative');
    }
}
