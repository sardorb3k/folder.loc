<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\AuthProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Authentication routes
Route::group(['middleware' => ['web']], function () {
    // Login Routes...
    Route::get('login', ['as' => 'login', 'uses' => 'App\Http\Controllers\Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'App\Http\Controllers\Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'App\Http\Controllers\Auth\LoginController@logout']);

    // Registration Routes...
    Route::get('register', ['as' => 'register', 'uses' => 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'register.post', 'uses' => 'App\Http\Controllers\Auth\RegisterController@register']);

    // Password Reset Routes...
    // Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    // Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    // Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    // Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);
});

// Home page route for logged in users only (middleware auth)
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'App\Http\Controllers\HomeController@index']);

// Group routes
Route::resource('groups', GroupsController::class);
// Student routes
Route::resource('students', GroupsController::class);
// Group subscription student routes
Route::post('groups/subscription', [GroupsController::class, 'subscription'])->name('groups.subscription')->middleware(['auth']);
Route::post('groups/unsubscribe', [GroupsController::class, 'unsubscribe'])->name('groups.unsubscribe')->middleware(['auth']);

// Teacher routes
Route::resource('teachers', 'App\Http\Controllers\TeachersController');

// Student routes
Route::resource('students', 'App\Http\Controllers\StudentsController');
Route::get('students/{id}/exam', 'App\Http\Controllers\StudentsController@exam')->name('students.exam');
Route::get('students/{id}/group', 'App\Http\Controllers\StudentsController@group')->name('students.group');
Route::get('students/{id}/payments', 'App\Http\Controllers\StudentsController@payments')->name('students.payments');
Route::get('students/{id}/attendance', 'App\Http\Controllers\StudentsController@attendance')->name('students.attendance');

// Payments routes
Route::group(['prefix' => 'payments'], function () {
    Route::get('/', 'App\Http\Controllers\PaymentsController@index')->name('payments.index');
    Route::post('/', 'App\Http\Controllers\PaymentsController@store')->name('payments.store');
    Route::get('/{id}', 'App\Http\Controllers\PaymentsController@show_red')->name('payments.show_red');
    Route::get('/{id}/{date}', 'App\Http\Controllers\PaymentsController@show')->name('payments.show');
    Route::put('/{id}', 'App\Http\Controllers\PaymentsController@update')->name('payments.update');
});


// Attendance routes
// Route::resource('attendance', 'App\Http\Controllers\AttendanceController');
Route::group(['prefix' => 'attendance'], function () {
    Route::get('/', 'App\Http\Controllers\AttendanceController@index')->name('attendance.index');
    Route::post('/', 'App\Http\Controllers\AttendanceController@store')->name('attendance.store');
    Route::get('/{id}', 'App\Http\Controllers\AttendanceController@show_red')->name('attendance.show_red');
    Route::get('/{id}/{date}', 'App\Http\Controllers\AttendanceController@show')->name('attendance.show');
    Route::put('/{id}', 'App\Http\Controllers\AttendanceController@update')->name('attendance.update');
});
// Salary routes
// Route::resource('salary', 'App\Http\Controllers\SalaryController');
Route::group(['prefix' => 'salary', 'middleware' => ['auth']], function () {
    Route::get('/', 'App\Http\Controllers\SalaryController@index_red')->name('salary.index_red');
    Route::get('/{date}', 'App\Http\Controllers\SalaryController@index')->name('salary.index');
    // Teacher groups list
    Route::get('/{date}/{id}', 'App\Http\Controllers\SalaryController@show')->name('salary.show');
    // Group students list
    Route::get('/{date}/{id}/{group_id}', 'App\Http\Controllers\SalaryController@show_students')->name('salary.show_student');
    // Store salary list
    Route::post('/list/{date}', 'App\Http\Controllers\SalaryController@storeSalaryList')->name('salary.storeSalaryList');
    // Update salary list
    Route::put('/list/{date}', 'App\Http\Controllers\SalaryController@updateSalaryList')->name('salary.updateSalaryList');
    // Create | Update
    Route::post('/{group_id}', 'App\Http\Controllers\SalaryController@store')->name('salary.store');
    Route::put('/{group_id}', 'App\Http\Controllers\SalaryController@update')->name('salary.update');
});

// Auth Profile update
Route::post('/user/profile/information', [AuthProfileController::class, 'information'])->name('profile.information')->middleware(['auth']);

Route::get('/user/account', [AuthProfileController::class, 'account_activity'])
    ->name('profile.show');

// Exams routes
// Route::resource('exams', 'App\Http\Controllers\ExamsController');
// Exam group
Route::group(['prefix' => 'exams'], function () {
    // -- Exam Get index
    Route::get('/', ['as' => 'exams.index', 'uses' => 'App\Http\Controllers\ExamsController@index']);
    // -- Exam Get show
    Route::get('/{id}', ['as' => 'exams.show', 'uses' => 'App\Http\Controllers\ExamsController@show']);
    // -- Exam by id
    Route::get('/{id}/{examid}/getExamId', ['as' => 'exams.getByID', 'uses' => 'App\Http\Controllers\ExamsController@getExamId']);
    Route::post('/{id}/{examid}/getExamId', ['as' => 'exams.updateExam', 'uses' => 'App\Http\Controllers\ExamsController@updateExam']);
    // -- Exam Get create | i update -> POST
    Route::post('/create', ['as' => 'exams.create', 'uses' => 'App\Http\Controllers\ExamsController@create']);
    // -- Exam Post store
    Route::post('/', ['as' => 'exams.store', 'uses' => 'App\Http\Controllers\ExamsController@store']);
    // -- Exam Get edit
    Route::get('/{id}/edit', ['as' => 'exams.edit', 'uses' => 'App\Http\Controllers\ExamsController@edit']);
    // -- Exam Put update
    Route::put('/{id}', ['as' => 'exams.update', 'uses' => 'App\Http\Controllers\ExamsController@update']);
    // -- Exam Delete destroy
    Route::delete('/{id}', ['as' => 'exams.destroy', 'uses' => 'App\Http\Controllers\ExamsController@destroy']);
});

// Settings
Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'App\Http\Controllers\SettingsController@index')->name('settings.index');
    Route::post('/', 'App\Http\Controllers\SettingsController@store')->name('settings.store');
});


// Language routes
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
