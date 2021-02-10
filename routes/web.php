<?php

use App\Models\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/comment/create', function () {
    return view('comment.create');
})->middleware(['auth'])->name('comment.create');

Route::post('/comment/store', function (Request $request) {

    Comment::create(
        $request->validate([
            'title' => 'required',
            'comment' => 'required'
        ])
    );

    return back()->with('success', 'Published');

})->middleware(['auth'])->name('comment.store');

Route::get('/comment/{id}/delete/', function ($id) {

    Comment::findOrFail($id)->delete();

    return back()->with('success', 'Deleted');

})->middleware(['auth'])->name('comment.delete');

Route::get('/dashboard', function () {
    $comments = Comment::all();
    return view('dashboard', compact('comments'));
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
