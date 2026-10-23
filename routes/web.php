<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\LeaveRequestController;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => auth()->check()
    ? redirect()->route('dashboard')
    : redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

Route::middleware('auth')->group(function () {

    // Main Dashboard
    Route::get('/dashboard', function () {
        
        if (auth()->user()->role === 'employee') {
    return view('employee-dashboard');
}
        $employeeCount = Employee::count();

        $totalActiveEmployees = Employee::where('status', 'Active')
            ->count();

        $presentToday = Attendance::whereDate('date', today())
            ->where('status', 'Present')
            ->count();

        $checkedOutToday = Attendance::whereDate('date', today())
            ->whereNotNull('check_out')
            ->count();

        $absentToday = max(
            $totalActiveEmployees - $presentToday,
            0
        );

        $attendanceRate = $totalActiveEmployees > 0
            ? (int) round(
                ($presentToday / $totalActiveEmployees) * 100
            )
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

  // Employee Management - Admin Only
    Route::middleware('admin')->group(function () {
    Route::resource('employees', EmployeeController::class);
});

    // Helpdesk
    Route::get('/helpdesk', function () {
        return view('helpdesk');
    })->name('helpdesk');

    Route::post('/helpdesk/ask', [HelpdeskController::class, 'ask'])
        ->name('helpdesk.ask');

    // Attendance
    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index');

    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])
        ->name('attendance.checkIn');

    Route::patch('/attendance/{attendance}/check-out', [AttendanceController::class, 'checkOut'])
        ->name('attendance.checkOut');

    Route::get('/attendance/export', [AttendanceController::class, 'export'])
        ->name('attendance.export');

    // Attendance Reports - Admin Only
    Route::middleware('admin')->group(function () {

    Route::get('/reports/attendance', [AttendanceReportController::class, 'index'])
        ->name('reports.attendance');

    Route::get('/reports/attendance/export', [AttendanceReportController::class, 'export'])
        ->name('reports.attendance.export');

});

    // Leave Requests
    Route::get('/leave-requests', [LeaveRequestController::class, 'index'])
        ->name('leave-requests.index');

    Route::get('/leave-requests/create', [LeaveRequestController::class, 'create'])
        ->name('leave-requests.create');

    Route::post('/leave-requests', [LeaveRequestController::class, 'store'])
        ->name('leave-requests.store');

    // Admin Only Routes
    Route::middleware('admin')->group(function () {

        Route::get('/admin/dashboard', function () {
            return redirect()->route('dashboard');
        })->name('admin.dashboard');

    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

