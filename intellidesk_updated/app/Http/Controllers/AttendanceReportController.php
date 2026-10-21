<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceReportExport;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceReportController extends Controller
{
    public function index(Request $request)
    {
        $request->merge([
            'from' => $request->input('from') ?: now()->startOfMonth()->toDateString(),
            'to' => $request->input('to') ?: now()->toDateString(),
        ]);

        $validated = $request->validate([
            'from' => ['required', 'date'],
            'to' => ['required', 'date', 'after_or_equal:from'],
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        $from = $validated['from'];
        $to = $validated['to'];
        $search = trim($validated['search'] ?? '');
        $search = $search !== '' ? $search : null;

        $recordsQuery = Attendance::with('employee')
            ->whereBetween('date', [$from, $to])
            ->when($search, function ($query, $search) {
                $query->whereHas('employee', function ($employeeQuery) use ($search) {
                    $employeeQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('employee_id', 'like', "%{$search}%");
                });
            });

        $attendances = (clone $recordsQuery)
            ->orderByDesc('date')
            ->orderByDesc('check_in')
            ->paginate(15)
            ->withQueryString();

        $totalEmployees = Employee::where('status', 'Active')->count();
        $totalPresent = (clone $recordsQuery)->where('status', 'Present')->count();
        $totalCheckedOut = (clone $recordsQuery)->whereNotNull('check_out')->count();
        $totalRecords = (clone $recordsQuery)->count();

        return view('reports.attendance', compact(
            'attendances',
            'from',
            'to',
            'search',
            'totalEmployees',
            'totalPresent',
            'totalCheckedOut',
            'totalRecords'
        ));
    }

    public function export(Request $request)
    {
        $request->merge([
            'from' => $request->input('from') ?: now()->startOfMonth()->toDateString(),
            'to' => $request->input('to') ?: now()->toDateString(),
        ]);

        $validated = $request->validate([
            'from' => ['required', 'date'],
            'to' => ['required', 'date', 'after_or_equal:from'],
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        $search = trim($validated['search'] ?? '');

        return Excel::download(
            new AttendanceReportExport(
                $validated['from'],
                $validated['to'],
                $search !== '' ? $search : null
            ),
            'intellidesk-attendance-report-' . $validated['from'] . '-to-' . $validated['to'] . '.xlsx'
        );
    }
}
