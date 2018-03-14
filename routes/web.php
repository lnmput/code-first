<?php

Route::get('/', 'Chapters@index')->name('home');

Route::group(['middleware' => 'web'], function () {

    Auth::routes();

    Route::prefix('user')->group(function () {

        Route::get('{id}', 'Users@index')->name('user.index');

        Route::get('{id}/edit', 'Users@edit')->name('user.edit');

        Route::get('{id}/books', 'Users@booksIndex')->name('user.books');

        Route::get('{id}/chapters', 'Users@chapterIndex')->name('user.chapters');

        Route::get('{id}/buy/books', 'Users@buyBooksIndex')->name('user.books.buy');

        Route::get('{id}/buy/chapters', 'Users@buyChaptersIndex')->name('user.chapters.buy');

        Route::get('{id}/like/books', 'Users@likeBooksIndex')->name('user.books.like');

        Route::get('{id}/like/chapters', 'Users@likeChaptersIndex')->name('user.chapters.like');

        Route::post('update', 'Users@update')->name('user.update');

        Route::post('avatar/upload', 'Users@avatarUpload')->name('user.avatar.upload');

    });

    Route::prefix('book')->group(function () {

        Route::get('/', 'Books@index')->name('book.index');

        Route::get('create', 'Books@create')->name('book.create');

        Route::post('store', 'Books@store')->name('book.store');

        Route::get('{id}', 'Books@show')->name('book.show')->where('id', '[0-9]+');

        Route::get('edit/{id}', 'Books@edit')->name('book.edit');

        Route::post('update', 'Books@update')->name('book.update');

        Route::post('comment/submit', 'Books@submitComment')->name('book.comment.submit');

        Route::post('like', 'Books@likeOrUnlike')->name('book.like.submit');
    });

    Route::prefix('chapter')->group(function () {

        Route::get('/', 'Chapters@index')->name('chapter.index');

        Route::get('create/{id?}', 'Chapters@create')->name('chapter.create');

        Route::post('store', 'Chapters@store')->name('chapter.store');

        Route::get('edit/{id}', 'Chapters@edit')->name('chapter.edit');

        Route::post('update', 'Chapters@update')->name('chapter.update');

        Route::get('{id}', 'Chapters@show')->name('chapter.show')->where('id', '[0-9]+');

        Route::post('comment/submit', 'Chapters@submitComment')->name('chapter.comment.submit');

        Route::post('like', 'Chapters@likeOrUnlike')->name('chapter.like.submit');
    });

});


Route::get('hehe', function () {


    $book = \App\Chapter::query()->where('id', 1)->first()->comments()->create([
        'uid' => 1,
        'body' => '很不错'
    ]);




});






