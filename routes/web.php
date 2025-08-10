<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\HandleStudentController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AttendanceController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/profile-log', [App\Http\Controllers\StudentProfileController::class, 'store']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', function () {
        return view('student_login');
    });


Route::middleware('auth')->group(function () {




    Route::get('/dashboard', function () {
        return view('main.dashboard.index');
    });

    // Student Routes
    Route::get('/students-manage', [StudentController::class, 'index'])->name('students-manage');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit']);
    Route::post('/students/update', [StudentController::class, 'update']);

    // Student Handle Controller
    Route::get('/students-handle', [HandleStudentController::class, 'index'])->name('students-handle');
    Route::post('/assign-students', [HandleStudentController::class, 'assign']);

    // API route for student list
    Route::get('/api/students', [StudentController::class, 'student_list']);

    // Assessment Controller
    Route::get('/assessments', [AssessmentController::class, 'index'])->name('assessments.index');
    Route::post('/get_student_enroll', [AssessmentController::class, 'get_student_enroll'])->name('get_student_enroll');
    Route::post('/set-score', [AssessmentController::class, 'setScore'])->name('set-score');

    // Attendance Controller
    Route::get('/student-attendance', [AttendanceController::class,'index'])->name('student-attendance');
    Route::post('/get-attendance', [AttendanceController::class,'get_attendance'])->name('get-attendance');
    Route::get('/attendances', [AttendanceController::class, 'generateAttendance']);
    Route::post('/update-attendance-status', [AttendanceController::class, 'updateAttendanceStatus']);

});
