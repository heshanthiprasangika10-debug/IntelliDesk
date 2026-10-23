<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    

public function index(Request $request)
{
    $date = $request->input('date', today()->toDateString());
    $search = $request->input('search');

    $isAdmin = auth()->user()->role === 'admin';

    // Adminට active employees සියල්ල පෙන්වන්න
    $employees = $isAdmin
        ? Employee::where('status', 'Active')
            ->orderBy('name')
            ->get()
        : collect();

    // Attendance records
    $attendanceQuery = Attendance::with('employee')
        ->whereDate('date', $date);

    // Employee කෙනෙකුට තමන්ගේ attendance විතරයි
    if (!$isAdmin) {
        $attendanceQuery->whereHas('employee', function ($query) {
            $query->where('email', auth()->user()->email);
        });
    }

    // Adminට පමණක් search කිරීම
    if ($isAdmin && $search) {
        $attendanceQuery->whereHas('employee', function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('employee_id', 'like', "%{$search}%");
        });
    }

    $attendances = $attendanceQuery
        ->latest()
        ->paginate(10)
        ->withQueryString();

    // Dashboard statistics
    if ($isAdmin) {
        $totalEmployees = Employee::where('status', 'Active')->count();

        $presentToday = Attendance::whereDate('date', today())
            ->where('status', 'Present')
            ->count();

        $checkedOutToday = Attendance::whereDate('date', today())
            ->whereNotNull('check_out')
            ->count();

        $absentToday = max($totalEmployees - $presentToday, 0);
    } else {
        $totalEmployees = 1;

        $presentToday = Attendance::whereHas('employee', function ($query) {
                $query->where('email', auth()->user()->email);
            })
            ->whereDate('date', today())
            ->where('status', 'Present')
            ->count();

        $checkedOutToday = Attendance::whereHas('employee', function ($query) {
                $query->where('email', auth()->user()->email);
            })
            ->whereDate('date', today())
            ->whereNotNull('check_out')
            ->count();

        $absentToday = $presentToday > 0 ? 0 : 1;
    }

    return view('attendance.index', compact(
        'employees',
        'attendances',
        'totalEmployees',
        'presentToday',
        'absentToday',
        'checkedOutToday',
        'date',
        'search'
    ));
}


    
public function checkIn(Request $request)
{
    $isAdmin = auth()->user()->role === 'admin';

    if ($isAdmin) {
        $validated = $request->validate([
            'employee_id' => [
                'required',
                'exists:employees,id',
            ],
        ]);

        $employee = Employee::where('status', 'Active')
            ->findOrFail($validated['employee_id']);
    } else {
        // Employee account email එකට ගැළපෙන employee record එක සොයන්න
        $employee = Employee::where(
            'email',
            auth()->user()->email
        )
            ->where('status', 'Active')
            ->first();

        if (!$employee) {
            return back()->with(
                'error',
                'Your employee profile was not found. Please contact the administrator.'
            );
        }
    }

    $attendance = Attendance::firstOrCreate(
        [
            'employee_id' => $employee->id,
            'date' => today()->toDateString(),
        ],
        [
            'check_in' => now()->format('H:i:s'),
            'status' => 'Present',
        ]
    );

    if (!$attendance->wasRecentlyCreated) {
        return back()->with(
            'error',
            'Attendance already recorded for today.'
        );
    }

    return back()->with('success', 'Check-in successful!');
}

    
public function checkOut(Attendance $attendance)
{
    $isAdmin = auth()->user()->role === 'admin';

    // Employeeට තමන්ගේ attendance record එකට පමණක් access දෙන්න
    if (!$isAdmin) {
        $isOwnAttendance = Employee::where(
            'email',
            auth()->user()->email
        )
            ->where('id', $attendance->employee_id)
            ->exists();

        if (!$isOwnAttendance) {
            abort(403, 'You are not allowed to check out this attendance.');
        }
    }

    if ($attendance->date->toDateString() !== today()->toDateString()) {
        return back()->with(
            'error',
            'Only today’s attendance can be checked out.'
        );
    }

    if ($attendance->check_out !== null) {
        return back()->with(
            'error',
            'Check-out already recorded.'
        );
    }

    $attendance->update([
        'check_out' => now()->format('H:i:s'),
    ]);

    return back()->with('success', 'Check-out successful!');
}


    public function export()
{
    return Excel::download(
        new AttendanceExport(),
        'intellidesk-attendance-report.xlsx'
    );
}
}
