<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpdeskController;

Route::get('/', fn () => auth()->check()
    ? redirect()->route('dashboard')
    : redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $employeeCount = Employee::count();
        $totalActiveEmployees = Employee::where('status', 'Active')->count();

        $presentToday = Attendance::whereDate('date', today())
            ->where('status', 'Present')
            ->count();

        $checkedOutToday = Attendance::whereDate('date', today())
            ->whereNotNull('check_out')
            ->count();

        $absentToday = max($totalActiveEmployees - $presentToday, 0);
        $attendanceRate = $totalActiveEmployees > 0
            ? (int) round(($presentToday / $totalActiveEmployees) * 100)
            : 0;

        $attendanceRecordCount = Attendance::count();

        $recentAttendances = Attendance::with('employee')
            ->orderByDesc('date')
            ->orderByDesc('check_in')
            ->limit(6)
            ->get();

        return view('dashboard', compact(
            'employeeCount',
            'totalActiveEmployees',
            'presentToday',
            'absentToday',
            'checkedOutToday',
            'attendanceRate',
            'attendanceRecordCount',
            'recentAttendances'
        ));
    })->name('dashboard');

    Route::resource('employees', EmployeeController::class);

    Route::get('/helpdesk', function () {
    return view('helpdesk');
    })->name('helpdesk');

    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index');

    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])
        ->name('attendance.checkIn');

    Route::patch('/attendance/{attendance}/check-out', [AttendanceController::class, 'checkOut'])
        ->name('attendance.checkOut');

    Route::get('/attendance/export', [AttendanceController::class, 'export'])
        ->name('attendance.export');

    Route::get('/reports/attendance', [AttendanceReportController::class, 'index'])
        ->name('reports.attendance');

    Route::get('/reports/attendance/export', [AttendanceReportController::class, 'export'])
        ->name('reports.attendance.export');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/helpdesk/ask', [HelpdeskController::class, 'ask'])
    ->name('helpdesk.ask');
});
