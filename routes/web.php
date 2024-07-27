<?php

use App\Models\Post;
use App\Models\History;
use App\Models\DSS_Method;
use App\Models\Criteria;
use App\Models\Alternative;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AlternativeCriteriaController;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', [AboutController::class, 'index']);

Route::get('/post', [PostController::class, 'index']);
Route::get('/post/{id}', [PostController::class, 'show']);

Route::get('/method', [MethodController::class, 'index']);

Route::get('/calculation', [CalculationController::class, 'showForm'])->name('calculation.form');
Route::post('/calculation/store', [CalculationController::class, 'store'])->name('calculation.store');

Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::get('/history/{history_id}', [HistoryController::class, 'show'])->name('history.show');
Route::get('/history/{history_id}/copy', [HistoryController::class, 'copy'])->name('history.copy');
Route::get('/history/{history_id}/edit', [HistoryController::class, 'editshow'])->name('history.editshow');
Route::put('/history/{history_id}', [HistoryController::class, 'update'])->name('history.update');
Route::delete('/history/{history_id}', [HistoryController::class, 'destroy'])->name('history.destroy');

Route::get('/alternative', [AlternativeController::class, 'index'])->name('alternative.index');
Route::get('/alternative/{id}', [AlternativeController::class, 'show']);
Route::get('/add_alternative', [AlternativeController::class, 'create']);
Route::post('/add_alternative', [AlternativeController::class, 'store']);
Route::post('/update_alternative', [AlternativeController::class, 'update']);
Route::delete('/alternative/{id}', [AlternativeController::class, 'destroy']);

Route::get('/criteria', [CriteriaController::class, 'index'])->name('criteria.index');
Route::get('/add_criteria', [CriteriaController::class, 'create']);
Route::post('/add_criteria', [CriteriaController::class, 'store']);
Route::post('/update_criteria_name', [CriteriaController::class, 'updateName']);
Route::post('/update_criteria_status', [CriteriaController::class, 'updateStatus']);
Route::get('/criteria/{id}', [CriteriaController::class, 'show']);
Route::delete('/criteria/{id}', [CriteriaController::class, 'destroy']);

Route::post('/save_criteria_value', [AlternativeCriteriaController::class, 'saveCriteriaValue']);
Route::post('/save_alternative_value', [AlternativeCriteriaController::class, 'saveAlternativeValue']);
Route::get('/alternative/{alternative_id}/criteria/{criteria_id}', [AlternativeCriteriaController::class, 'show']);