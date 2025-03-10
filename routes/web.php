<?php

use App\Livewire\JobForm;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\JobList;
use App\Livewire\JobDetails;
use App\Livewire\JobModeration;

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/job/create', JobForm::class)->name('jobs');
    Route::group(['middleware' => ['role:moderator', 'role:admin']], function () {
        Route::get('/job/moderate/{id}', JobModeration::class)->name('job.moderate');
    });
});

Route::get('/', JobList::class)->name('jobs.list');
Route::get('/jobs/{id}', JobDetails::class)->name('jobs.details');

