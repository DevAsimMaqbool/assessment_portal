<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserAnswerController;
use App\Http\Controllers\UserCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('admin.dashbord');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/survey_submit', [UserAnswerController::class, 'store'])->name('survey.submit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/permission', PermissionController::class);

    Route::get('/stakeholder', [PermissionController::class, 'stakeholder_data']);
    Route::get('/questions', [PermissionController::class, 'questions'])->name('questions');
    Route::resource('/role', RoleController::class);


    Route::get('/question', [QuestionController::class, 'show'])->name('question.show');
    Route::get('/stakeholder_question/{UserID?}', [QuestionController::class, 'stakeholder'])->name('question.stakeholder');
    Route::get('/self_feedback', [UserCategoryController::class, 'index'])->name('selfFeedback');
    Route::get('/self-feedback/details', [UserCategoryController::class, 'showAttemptDetail'])->name('admin.self_feedback.details');
    Route::get('/dashboard', [PermissionController::class, 'dashboard'])->name('dashboard');
    Route::get('/chart', [PermissionController::class, 'chart']);
    Route::middleware(['role:admin'])->prefix('admin')->as('admin.')->group(function () {
        Route::get('/dashboard', [PermissionController::class, 'dashboard'])->name('dashboard');
        Route::resource('/users', AdminUserController::class);
    });

});

require __DIR__ . '/auth.php';
