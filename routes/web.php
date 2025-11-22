<?php

use App\Http\Controllers\FormSubmissionController;
use App\Models\Form;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forms/{form}', function (Form $form) {
    return view('forms.show')
        ->with('form', $form->load('fields.options'));
});


Route::post('/forms/{form}/submit', [FormSubmissionController::class, 'store'])->name('forms.submit');