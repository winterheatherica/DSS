<?php

use App\Models\Post;

use App\Models\History;
use App\Models\DSS_Method;
use App\Models\Criteria;
use App\Models\Alternative;

use Illuminate\support\Arr;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use App\Http\Controllers\HistoryController;

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
    return view('/data/method', ['title' => 'Method Page', 'total_method' => DSS_Method::all()]);
});


Route::get('/history', function () {
    $history = History::with('method')->get();
    return view('data.history', ['title' => 'History Page', 'history' => $history]);
});

Route::get('/history/{history_id}', [HistoryController::class, 'showDetailedHistory']);

Route::get('/criteria', function () {
    return view('/data/criteria', ['title' => 'Criteria Page', 'total_criteria' => Criteria::all()]);
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
    return view('/data/alternative', ['title' => 'Alternative Page', 'total_alternative' => Alternative::all()]);
});

Route::get('/add_alternative', function () {
    return view('/data/add_alternative', ['title' => 'Add Alternative Page', 'total_alternative' => Alternative::all()]);
});

Route::post('/add_alternative', function (Request $request) {
    $alternative = new Alternative;
    $alternative->alternative_name = $request->input('alternative_name');
    $alternative->save();

    return redirect('/add_alternative')->with('success', 'Alternative added successfully!');
});