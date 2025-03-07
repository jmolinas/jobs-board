<?php

use App\Livewire\JobForm;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\JobList;
use App\Livewire\JobDetails;

Auth::routes();
Route::get('/jobs/{id}', JobDetails::class)->name('jobs.details');
Route::get('/jobs/create', JobForm::class)->name('jobs');
Route::get('/jobs', JobList::class)->name('jobs.list');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
