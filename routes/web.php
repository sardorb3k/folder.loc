<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\AuthProfileController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\StaffController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


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
Route::get('/', ['as' => 'dashboard', 'uses' => 'App\Http\Controllers\HomeController@index'])->middleware(['auth', 'roles:superadmin,admin,teacher,student']);
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'App\Http\Controllers\HomeController@index'])->middleware(['auth', 'roles:superadmin,admin,teacher,student']);

// Group routes
Route::group(['prefix' => 'groups'], function () {
    Route::get('/', [GroupsController::class, 'index'])->name('groups.index')->middleware(['auth', 'roles:superadmin,admin,teacher']);
    Route::get('/create', [GroupsController::class, 'create'])->name('groups.create')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/{id}/edit', [GroupsController::class, 'edit'])->name('groups.edit')->middleware(['auth', 'roles:superadmin,admin']);
    Route::post('/', [GroupsController::class, 'store'])->name('groups.store')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/{id}', [GroupsController::class, 'show'])->name('groups.show')->middleware(['auth', 'roles:superadmin,admin,teacher']);
    Route::put('/{id}', [GroupsController::class, 'update'])->name('groups.update')->middleware(['auth', 'roles:superadmin,admin']);
    Route::delete('/{id}', [GroupsController::class, 'delete'])->name('groups.delete')->middleware(['auth', 'roles:superadmin,admin']);

    Route::get('/archives/view', [GroupsController::class, 'archives'])->name('groups.archives')->middleware(['auth', 'roles:superadmin,admin']);
    Route::put('/{id}/archive', [GroupsController::class, 'archive'])->name('groups.archive')->middleware(['auth', 'roles:superadmin,admin']);
    Route::put('/{id}/unarchive', [GroupsController::class, 'unarchive'])->name('groups.unarchive')->middleware(['auth', 'roles:superadmin,admin']);
});

// Student routes
// Route::resource('students', GroupsController::class)->middleware(['auth', 'roles:superadmin,admin,teacher']);

// Group subscription student routes
Route::post('groups/subscription', [GroupsController::class, 'subscription'])->name('groups.subscription')->middleware(['auth', 'roles:superadmin,admin']);
Route::post('groups/unsubscribe', [GroupsController::class, 'unsubscribe'])->name('groups.unsubscribe')->middleware(['auth', 'roles:superadmin,admin']);

// Teacher routes
// Route::resource('teachers', 'App\Http\Controllers\TeachersController')->middleware(['auth', 'roles:superadmin,admin']);

Route::group(['prefix' => 'teachers'], function () {
    Route::get('/', [TeachersController::class, 'index'])->name('teachers.index')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/create', [TeachersController::class, 'create'])->name('teachers.create')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/{id}/edit', [TeachersController::class, 'edit'])->name('teachers.edit')->middleware(['auth', 'roles:superadmin,admin']);
    Route::post('/', [TeachersController::class, 'store'])->name('teachers.store')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/{id}', [TeachersController::class, 'show'])->name('teachers.show')->middleware(['auth', 'roles:superadmin,admin']);
    Route::put('/{id}', [TeachersController::class, 'update'])->name('teachers.update')->middleware(['auth', 'roles:superadmin,admin']);
    Route::delete('/{id}', [TeachersController::class, 'delete'])->name('teachers.delete')->middleware(['auth', 'roles:superadmin,admin']);

    Route::get('/archives/view', [TeachersController::class, 'archives'])->name('teachers.archives')->middleware(['auth', 'roles:superadmin,admin']);
    Route::put('/{id}/archive', [TeachersController::class, 'archive'])->name('teachers.archive')->middleware(['auth', 'roles:superadmin,admin']);
    Route::put('/{id}/unarchive', [TeachersController::class, 'unarchive'])->name('teachers.unarchive')->middleware(['auth', 'roles:superadmin,admin']);
});

// Student routes
// Route::resource('students', 'App\Http\Controllers\StudentsController')->middleware(['auth', 'roles:superadmin,admin,teacher']);
Route::group(['prefix' => 'students'], function () {
    Route::get('/', [StudentsController::class, 'index'])->name('students.index')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/create', [StudentsController::class, 'create'])->name('students.create')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/{id}/edit', [StudentsController::class, 'edit'])->name('students.edit')->middleware(['auth', 'roles:superadmin,admin']);
    Route::post('/', [StudentsController::class, 'store'])->name('students.store')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/{id}', [StudentsController::class, 'show'])->name('students.show')->middleware(['auth', 'roles:superadmin,admin']);
    Route::put('/{id}', [StudentsController::class, 'update'])->name('students.update')->middleware(['auth', 'roles:superadmin,admin']);
    Route::delete('/{id}', [StudentsController::class, 'delete'])->name('students.delete')->middleware(['auth', 'roles:superadmin,admin']);

    Route::get('/{id}/exam', [StudentsController::class, 'exam'])->name('students.exam')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/{id}/group', [StudentsController::class, 'group'])->name('students.group')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/{id}/payments', [StudentsController::class, 'payments'])->name('students.payments')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/{id}/attendance', [StudentsController::class, 'attendance'])->name('students.attendance')->middleware(['auth', 'roles:superadmin,admin']);

    Route::get('/archives/view', [StudentsController::class, 'archives'])->name('students.archives')->middleware(['auth', 'roles:superadmin,admin']);
    Route::put('/{id}/archive', [StudentsController::class, 'archive'])->name('students.archive')->middleware(['auth', 'roles:superadmin,admin']);
    Route::put('/{id}/unarchive', [StudentsController::class, 'unarchive'])->name('students.unarchive')->middleware(['auth', 'roles:superadmin,admin']);
});


// Payments routes
Route::group(['prefix' => 'payments'], function () {
    Route::get('/', 'App\Http\Controllers\PaymentsController@index')->name('payments.index')->middleware(['auth', 'roles:superadmin,admin']);
    Route::post('/', 'App\Http\Controllers\PaymentsController@store')->name('payments.store')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/export','App\Http\Controllers\PaymentsController@exportPayments')->name('payments.export')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/{id}', 'App\Http\Controllers\PaymentsController@show_red')->name('payments.show_red')->middleware(['auth', 'roles:superadmin,admin']);
    Route::get('/{id}/{date}', 'App\Http\Controllers\PaymentsController@show')->name('payments.show')->middleware(['auth', 'roles:superadmin,admin']);
    Route::put('/{id}', 'App\Http\Controllers\PaymentsController@update')->name('payments.update')->middleware(['auth', 'roles:superadmin,admin']);
});


// Attendance routes
// Route::resource('attendance', 'App\Http\Controllers\AttendanceController');
Route::group(['prefix' => 'attendance'], function () {
    Route::get('/', 'App\Http\Controllers\AttendanceController@index')->name('attendance.index')->middleware(['auth', 'roles:superadmin,admin,teacher']);
    Route::post('/', 'App\Http\Controllers\AttendanceController@store')->name('attendance.store')->middleware(['auth', 'roles:superadmin,admin,teacher']);
    Route::get('/{id}', 'App\Http\Controllers\AttendanceController@show_red')->name('attendance.show_red')->middleware(['auth', 'roles:superadmin,admin,teacher']);
    Route::get('/{id}/{date}', 'App\Http\Controllers\AttendanceController@show')->name('attendance.show')->middleware(['auth', 'roles:superadmin,admin,teacher']);
    Route::put('/{id}', 'App\Http\Controllers\AttendanceController@update')->name('attendance.update')->middleware(['auth', 'roles:superadmin,admin,teacher']);
});

// Salary routes
// Route::resource('salary', 'App\Http\Controllers\SalaryController');
Route::group(['prefix' => 'salary', 'middleware' => ['auth']], function () {
    Route::get('/', 'App\Http\Controllers\SalaryController@index_red')->name('salary.index_red')->middleware(['roles:superadmin,admin,teacher']);
    Route::get('/{date}', 'App\Http\Controllers\SalaryController@index')->name('salary.index')->middleware(['roles:superadmin,admin,teacher']);
    // Teacher groups list
    Route::get('/{date}/{id}', 'App\Http\Controllers\SalaryController@show')->name('salary.show')->middleware(['roles:superadmin,admin,teacher']);
    // Group students list
    Route::get('/{date}/{id}/{group_id}', 'App\Http\Controllers\SalaryController@show_students')->name('salary.show_student')->middleware(['roles:superadmin,admin,teacher']);
    // Store salary list
    Route::post('/list/{date}', 'App\Http\Controllers\SalaryController@storeSalaryList')->name('salary.storeSalaryList')->middleware(['roles:superadmin']);
    // Update salary list
    Route::put('/list/{date}', 'App\Http\Controllers\SalaryController@updateSalaryList')->name('salary.updateSalaryList')->middleware(['roles:superadmin']);
    // Create | Update
    Route::post('/{group_id}', 'App\Http\Controllers\SalaryController@store')->name('salary.store')->middleware(['roles:superadmin']);
    Route::put('/{group_id}', 'App\Http\Controllers\SalaryController@update')->name('salary.update')->middleware(['roles:superadmin']);
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
    Route::get('/', ['as' => 'exams.index', 'uses' => 'App\Http\Controllers\ExamsController@index'])->middleware(['auth', 'roles:superadmin,admin,teacher']);
    // -- Exam Get show
    Route::get('/{id}', ['as' => 'exams.show', 'uses' => 'App\Http\Controllers\ExamsController@show'])->middleware(['auth', 'roles:superadmin,admin,teacher']);
    // -- Exam by id
    Route::get('/{id}/{examid}/getExamId', ['as' => 'exams.getByID', 'uses' => 'App\Http\Controllers\ExamsController@getExamId'])->middleware(['auth', 'roles:superadmin,admin,teacher,student']);
    Route::post('/{id}/{examid}/getExamId', ['as' => 'exams.updateExam', 'uses' => 'App\Http\Controllers\ExamsController@updateExam'])->middleware(['auth', 'roles:superadmin,admin']);
    // -- Exam Get create | i update -> POST
    Route::post('/create', ['as' => 'exams.create', 'uses' => 'App\Http\Controllers\ExamsController@create'])->middleware(['auth', 'roles:superadmin,admin']);
    // -- Exam Post store
    Route::post('/', ['as' => 'exams.store', 'uses' => 'App\Http\Controllers\ExamsController@store'])->middleware(['auth', 'roles:superadmin,admin']);
    // -- Exam Get edit
    Route::get('/{id}/edit', ['as' => 'exams.edit', 'uses' => 'App\Http\Controllers\ExamsController@edit'])->middleware(['auth', 'roles:superadmin,admin']);
    // -- Exam Put update
    Route::put('/{id}', ['as' => 'exams.update', 'uses' => 'App\Http\Controllers\ExamsController@update'])->middleware(['auth', 'roles:superadmin,admin']);
    // -- Exam Delete destroy
    Route::delete('/{id}', ['as' => 'exams.destroy', 'uses' => 'App\Http\Controllers\ExamsController@destroy'])->middleware(['auth', 'roles:superadmin']);
});

// Settings
Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'App\Http\Controllers\SettingsController@index')->name('settings.index')->middleware(['auth', 'roles:superadmin']);
    Route::post('/', 'App\Http\Controllers\SettingsController@store')->name('settings.store')->middleware(['auth', 'roles:superadmin']);
    // Level
    Route::post('/groupLevel', 'App\Http\Controllers\SettingsController@groupLevel')->name('settings.groupLevel')->middleware(['auth', 'roles:superadmin']);
    // Level delete
    Route::post('/groupLevel/{id}', 'App\Http\Controllers\SettingsController@groupLevelDelete')->name('settings.groupLevelDelete')->middleware(['auth', 'roles:superadmin']);
    // Group level get by id
    Route::get('/groupLevel/{id}', 'App\Http\Controllers\SettingsController@groupLevelGetById')->name('settings.groupLevelGetById')->middleware(['auth', 'roles:superadmin']);
    // Group level update
    Route::put('/groupLevel/{id}', 'App\Http\Controllers\SettingsController@groupLevelUpdate')->name('settings.groupLevelUpdate')->middleware(['auth', 'roles:superadmin']);
});

// Course
Route::group(['prefix' => 'course'], function () {
    Route::get('/', 'App\Http\Controllers\CourseController@index')->name('course.index')->middleware(['auth', 'roles:superadmin']);
    Route::get('/{id}/create', 'App\Http\Controllers\CourseController@create')->name('course.create')->middleware(['auth', 'roles:superadmin']);
    Route::post('/', 'App\Http\Controllers\CourseController@store')->name('course.store')->middleware(['auth', 'roles:superadmin']);
    Route::get('/{id}', ['as' => 'course.show', 'uses' => 'App\Http\Controllers\CourseController@show'])->middleware(['auth', 'roles:superadmin,admin,teacher']);
    Route::get('/{id}/{courseid}', ['as' => 'course.course', 'uses' => 'App\Http\Controllers\CourseController@course'])->middleware(['auth', 'roles:superadmin,admin,teacher']);
});


Route::group(['prefix' => 'tasks', 'middleware' => ['auth']], function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index')->middleware(['roles:superadmin,admin,teacher']);
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store')->middleware(['roles:superadmin,admin,teacher']);
    Route::put('/sync', [TaskController::class, 'sync'])->name('tasks.sync')->middleware(['roles:superadmin,admin,teacher']);
    Route::put('/', [TaskController::class, 'update'])->name('tasks.update')->middleware(['roles:superadmin,admin,teacher']);
    Route::put('/updateBoard', [TaskController::class, 'updateBoard'])->name('tasks.updateBoard')->middleware(['roles:superadmin,admin,teacher']);
    Route::delete('/', [TaskController::class, 'destroy'])->name('tasks.destroy')->middleware(['roles:superadmin,admin,teacher']);
});

Route::group(['prefix' => 'boards', 'middleware' => ['auth']], function () {
    Route::get('/', [BoardController::class, 'index'])->name('boards.index')->middleware(['roles:superadmin,admin,teacher']);
    Route::post('/', [BoardController::class, 'store'])->name('boards.store')->middleware(['roles:superadmin,admin,teacher']);
    Route::put('/', [BoardController::class, 'update'])->name('boards.update')->middleware(['roles:superadmin,admin,teacher']);
    Route::put('/reorder', [BoardController::class, 'reorder'])->name('boards.reorder')->middleware(['roles:superadmin,admin,teacher']);
    Route::delete('/', [BoardController::class, 'delete'])->name('boards.delete')->middleware(['roles:superadmin,admin,teacher']);
});

Route::group(['prefix' => 'staff', 'middleware' => ['auth']], function () {
    // Route::get('/', 'livewire.sta')
    Route::get('/', [StaffController::class, 'index'])->name('staff.index')->middleware(['roles:superadmin']);
    Route::post('/', [StaffController::class, 'store'])->name('staff.store')->middleware(['roles:superadmin']);
    Route::put('/', [StaffController::class, 'update'])->name('staff.update')->middleware(['roles:superadmin']);
    Route::delete('/', [StaffController::class, 'delete'])->name('staff.delete')->middleware(['roles:superadmin']);
});




// Language routes
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
