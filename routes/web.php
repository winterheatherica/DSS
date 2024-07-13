<?php

use App\Models\Post;

use App\Models\History;
use Illuminate\support\Arr;
use Illuminate\Support\Facades\Route;

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

// Route::get('/history', function () {
//     return view('/data/history', ['title' => 'History Page', 'history' => History::all()]);
// });

Route::get('/history', function () {
    $history = History::with('method')->get();
    return view('data.history', ['title' => 'History Page', 'history' => $history]);
});

// Route::get('/history/{history_id}', function ($history_id) {
//     $detailed_history = History::find($history_id);
//     return view('/data/detailed_history', ['title' => "History {$detailed_history['case_name']}", 'detailed_history' => $detailed_history]);
// });

// Route::get('/history/{history_id}', function ($history_id) {
//     // Eager load relasi 'method'
//     $detailed_history = History::with('method')->find($history_id);

//     // Pastikan detail history ditemukan
//     if (!$detailed_history) {
//         abort(404, 'History not found');
//     }

//     return view('/data/detailed_history', [
//         'title' => "History {$detailed_history->case_name}", 
//         'detailed_history' => $detailed_history
//     ]);
// });

Route::get('/history/{history_id}', [HistoryController::class, 'showDetailedHistory']);
