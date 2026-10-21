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
    $employees = Employee::where('status', 'Active')
        ->orderBy('name')
        ->get();

    $date = $request->input('date', today()->toDateString());
    $search = $request->input('search');

    $attendances = Attendance::with('employee')
        ->whereDate('date', $date)
        ->when($search, function ($query, $search) {
            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('employee_id', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $totalEmployees = Employee::where('status', 'Active')->count();

    $presentToday = Attendance::whereDate('date', today())
        ->where('status', 'Present')
        ->count();

    $checkedOutToday = Attendance::whereDate('date', today())
        ->whereNotNull('check_out')
        ->count();

    $absentToday = max($totalEmployees - $presentToday, 0);

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
        $request->validate([
            'employee_id' => ['required', 'exists:employees,id'],
        ]);

        $attendance = Attendance::firstOrCreate(
            [
                'employee_id' => $request->employee_id,
                'date' => today(),
            ],
            [
                'check_in' => now()->format('H:i:s'),
                'status' => 'Present',
            ]
        );

        if (! $attendance->wasRecentlyCreated) {
            return back()->with(
                'error',
                'Attendance already recorded for today.'
            );
        }

        return back()->with('success', 'Check-in successful!');
    }

    public function checkOut(Attendance $attendance)
    {
        if ($attendance->date->toDateString() !== today()->toDateString()) {
            return back()->with('error', 'Only today’s attendance can be checked out.');
        }

        if ($attendance->check_out !== null) {
            return back()->with('error', 'Check-out already recorded.');
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
