<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class);
});
