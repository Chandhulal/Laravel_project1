<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('user.user_registration');
});
Route::get('/course_home', function () {
    return view('templates.course_home');
});
Route::post('/user_registration', [UserController::class, 'store']);
Route::post('/login_authentication', [UserController::class, 'login_authentication']);


Route::group(['middleware' => ['userLogin']], function () {
    Route::get('/courses', [CourseController::class, 'show']);
    Route::post('/add_course_data', [CourseController::class, 'store']);
    Route::patch('/edit_course_data/{id}', [CourseController::class, 'edit']);
    Route::delete('/delete_course_data/{id}', [CourseController::class, 'destroy']);
    Route::get('/course_ascending', [CourseController::class, 'name_ascending']);
    Route::get('/course_descending', [CourseController::class, 'name_descending']);
    Route::get('/id_ascending', [CourseController::class, 'id_ascending']);
    Route::get('/id_descending', [CourseController::class, 'id_descending']);
    Route::get('/semester_ascending', [CourseController::class, 'semester_ascending']);
    Route::get('/semester_descending', [CourseController::class, 'semester_descending']);
    Route::get('/search_data', [CourseController::class, 'search_data']);

    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::post('/roles/{id}/add_permission', [RoleController::class, 'add_permission']);
    Route::get('/roles/{id}/give_permission', [RoleController::class, 'give_permission']);
    Route::post('/support_form_submit/{id}', [SupportController::class, 'store']);
    Route::get('/faq_mails', [SupportController::class, 'show']);
    Route::delete('/delete_faq_mail/{id}', [SupportController::class, 'destroy']);
    Route::post('/import_exel', [CourseController::class, 'import_exel']);
    Route::get('/export_exel', [CourseController::class, 'export_exel']);

    Route::get('/logout', [UserController::class, 'logout']);
});
