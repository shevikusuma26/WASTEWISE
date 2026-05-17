<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('landing'); });
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/register', function () { return view('auth.register'); })->name('register');

Route::get('/dashboard', function () { return view('dashboard.user'); })->name('dashboard.user');
Route::get('/admin', function () { return view('dashboard.admin'); })->name('dashboard.admin');
Route::get('/scanner', function () { return view('scanner.index'); })->name('scanner');
Route::get('/pickups', function () { return view('pickups.index'); })->name('pickups');
Route::get('/waste-banks', function () { return view('banks.index'); })->name('banks');
Route::get('/education', function () { return view('education.index'); })->name('education');
Route::get('/profile', function () { return view('profile.index'); })->name('profile');
