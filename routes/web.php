<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login',[
        'title' => 'CBT-LAB | Login'
    ]);
})->name('login');

Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admindashboard');
    Route::get('/admin/teacher', [AdminController::class, 'teacher'])->name('adminteacher');
    Route::get('/admin/student', [AdminController::class, 'student'])->name('adminstudent');
    Route::get('/admin/grade', [AdminController::class, 'grade'])->name('admingrade');
    Route::get('/admin/subject', [AdminController::class, 'subject'])->name('adminsubject');
    Route::get('/admin/createacc/{role}', [AdminController::class, 'createacc'])->name('admincreateacc');
    Route::get('/admin/showacc/{id}/{role}', [AdminController::class, 'showacc'])->name('adminshowacc');
    Route::post('/admin/activateuser', [AdminController::class, 'activateuser'])->name('activateuser');
    Route::delete('/admin/deleteuser', [AdminController::class, 'deleteuser'])->name('deleteuser');
    Route::post('/admin/storeuser', [AdminController::class, 'storeuser'])->name('storeuser');
    Route::post('/admin/updateuser/{id}', [AdminController::class, 'updateuser'])->name('updateuser');
    Route::post('/admin/storegrade', [AdminController::class, 'storegrade'])->name('storegrade');
    Route::post('/admin/storesubject', [AdminController::class, 'storesubject'])->name('storesubject');
    Route::delete('/admin/destroygrade', [AdminController::class, 'destroygrade'])->name('destroygrade');
    Route::delete('/admin/destroysubject', [AdminController::class, 'destroysubject'])->name('destroysubject');

    // Teacher
    Route::get('/question', [QuestionController::class, 'index'])->name('questionlist');
    Route::get('/teacher/result', [QuestionController::class, 'result'])->name('testresult');
    Route::get('/createquestion', [QuestionController::class, 'createqst'])->name('createqst');
    Route::post('/storequestion', [QuestionController::class, 'storeqst'])->name('storeqst');
    Route::post('/activateqst', [QuestionController::class, 'activateqst'])->name('activateqst');
    Route::delete('/deleteqst', [QuestionController::class, 'deleteqst'])->name('deleteqst');




    // Siswa
    Route::get('/homepage', [FrontController::class, 'index'])->name('testlist');
});
