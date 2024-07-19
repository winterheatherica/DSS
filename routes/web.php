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

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['name' => 'Keqing', 'title' => 'About Page']);
});

Route::get('/post', function () {
    return view('posts', ['title' => 'Posts Page', 'posts' => Post::all()]);
});

Route::get('/post/{id}', function ($id) {
    $post = Post::find($id);
    return view('post', ['title' => "Post {$post['title']} By {$post['author']}", 'post' => $post]);
});

Route::get('/method', function () {
    return view('/data/method', ['title' => 'Method List', 'total_method' => DSS_Method::all()]);
});

Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::get('/history/{history_id}', [HistoryController::class, 'show'])->name('history.show');
Route::get('/history/{history_id}/copy', [HistoryController::class, 'copy'])->name('history.copy');

Route::get('/alternative/{alternative_id}/criteria/{criteria_id}', [AlternativeCriteriaController::class, 'show'])->name('alternative.criteria.show');

Route::get('/criteria', function () {
    return view('/data/criteria', ['title' => 'Criteria List', 'total_criteria' => Criteria::all()]);
});

Route::get('/criteria', function () {
    $title = 'Criteria List';
    $total_criteria = Criteria::paginate(4);
    return view('/data/criteria', compact('title', 'total_criteria'));
});

Route::get('/add_criteria', function () {
    return view('/data/add_criteria', ['title' => 'Add Criteria Page', 'total_criteria' => Criteria::all()]);
});

Route::post('/add_criteria', function (Request $request) {
    $criteria = new Criteria;
    $criteria->criteria_name = $request->input('criteria_name');
    $criteria->criteria_status = $request->input('criteria_status');
    $criteria->save();

    return redirect('/add_criteria')->with('success', 'Criteria added successfully!');
});

Route::get('/alternative', function () {
    $title = 'Alternative List';
    $total_alternative = Alternative::paginate(4);
    return view('/data/alternative', compact('title', 'total_alternative'));
});

Route::post('/update_alternative', function (Request $request) {
    $alternative_id = $request->input('alternative_id');
    $alternative_name = $request->input('alternative_name');

    DB::table('tb_alternative')
        ->where('alternative_id', $alternative_id)
        ->update(['alternative_name' => $alternative_name]);

    return redirect('/alternative')->with('success', 'Alternative updated successfully!');
});

Route::get('/add_alternative', function () {
    return view('/data/add_alternative', ['title' => 'Add Alternative Page', 'total_alternative' => Alternative::all()]);
});

Route::post('/update_criteria', function (Request $request) {
    $criteria_id = $request->input('criteria_id');
    $criteria_name = $request->input('criteria_name');
    $criteria_status = $request->input('criteria_status');

    DB::table('tb_criteria')
        ->where('criteria_id', $criteria_id)
        ->update([
            'criteria_name' => $criteria_name,
            'criteria_status' => $criteria_status,
        ]);

    return redirect('/criteria')->with('success', 'Criteria updated successfully!');
});

Route::post('/update_criteria_name', function (Request $request) {
    $criteria_id = $request->input('criteria_id');
    $criteria_name = $request->input('criteria_name');

    DB::table('tb_criteria')
        ->where('criteria_id', $criteria_id)
        ->update(['criteria_name' => $criteria_name]);

    return redirect('/criteria')->with('success', 'Criteria name updated successfully!');
});

Route::post('/update_criteria_status', function (Request $request) {
    $criteria_id = $request->input('criteria_id');
    $criteria_status = $request->input('criteria_status');

    DB::table('tb_criteria')
        ->where('criteria_id', $criteria_id)
        ->update(['criteria_status' => $criteria_status]);

    return redirect('/criteria')->with('success', 'Criteria status updated successfully!');
});

Route::post('/add_alternative', function (Request $request) {
    $alternative = new Alternative;
    $alternative->alternative_name = $request->input('alternative_name');
    $alternative->save();

    return redirect('/add_alternative')->with('success', 'Alternative added successfully!');
});

Route::get('/alternative/{id}', function ($id) {
    $alternativeDetail = DB::table('tb_alternative')
        ->where('alternative_id', $id)
        ->first();

    $alternative = DB::table('tb_criteria')
        ->leftJoin('tb_alternative_criteria', function($join) use ($id) {
            $join->on('tb_criteria.criteria_id', '=', 'tb_alternative_criteria.criteria_id')
                 ->where('tb_alternative_criteria.alternative_id', '=', $id);
        })
        ->select('tb_criteria.criteria_id', 'tb_criteria.criteria_name', 'tb_alternative_criteria.alternative_criteria_value')
        ->get();

    $title = "Alternative {$alternativeDetail->alternative_id} -> {$alternativeDetail->alternative_name}";

    return view('data.detailed_alternative', [
        'title' => $title, 
        'alternative' => $alternative,
        'alternative_id' => $id
    ]);
});

Route::get('/criteria/{id}', function ($id) {
    $criteriaDetail = DB::table('tb_criteria')
        ->where('criteria_id', $id)
        ->first();
    
    $criteria = DB::table('tb_alternative')
        ->leftJoin('tb_alternative_criteria', function($join) use ($id) {
            $join->on('tb_alternative.alternative_id', '=', 'tb_alternative_criteria.alternative_id')
                 ->where('tb_alternative_criteria.criteria_id', '=', $id);
        })
        ->select('tb_alternative.alternative_id', 'tb_alternative.alternative_name', 'tb_alternative_criteria.alternative_criteria_value')
        ->get();

    $title = "Criteria {$criteriaDetail->criteria_name} (" . ($criteriaDetail->criteria_status == 'b' ? 'Benefit)' : 'Cost)');

    return view('data.detailed_criteria', [
        'title' => $title,
        'criteria' => $criteria,
        'criteria_id' => $id
    ]);
});

Route::post('/save_criteria_value', function (Request $request) {
    $alternative_id = $request->input('alternative_id');
    $criteria_values = $request->input('criteria_values', []);

    foreach ($criteria_values as $criteria_id => $criteria_value) {
        if ($criteria_id) { // Pastikan criteria_id tidak null
            $existing = DB::table('tb_alternative_criteria')
                ->where('alternative_id', $alternative_id)
                ->where('criteria_id', $criteria_id)
                ->first();

            if ($existing) {
                DB::table('tb_alternative_criteria')
                    ->where('alternative_id', $alternative_id)
                    ->where('criteria_id', $criteria_id)
                    ->update(['alternative_criteria_value' => $criteria_value]);
            } else {
                DB::table('tb_alternative_criteria')
                    ->insert([
                        'alternative_id' => $alternative_id,
                        'criteria_id' => $criteria_id,
                        'alternative_criteria_value' => $criteria_value,
                    ]);
            }
        }
    }

    return redirect()->back()->with('success', 'Data berhasil disimpan');
});

Route::get('/calculation', [CalculationController::class, 'showForm'])->name('calculation.form');
// Route::post('/calculation', [CalculationController::class, 'store'])->name('calculation.store');
Route::post('/calculation/store', [CalculationController::class, 'store'])->name('calculation.store');

Route::get('/history/{history_id}/edit', [HistoryController::class, 'editshow'])->name('history.editshow');
Route::put('/history/{history_id}', 'HistoryController@update')->name('history.update');

