<?php

namespace App\Exports;

use App\Models\Attendance;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    public function collection(): Enumerable
    {
        return Attendance::with('employee')
            ->orderByDesc('date')
            ->get()
            ->map(function ($attendance) {
                return [
                    'Employee ID' => $attendance->employee->employee_id,
                    'Employee Name' => $attendance->employee->name,
                    'Date' => $attendance->date->format('Y-m-d'),
                    'Check In' => $attendance->check_in,
                    'Check Out' => $attendance->check_out,
                    'Status' => $attendance->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Employee ID',
            'Employee Name',
            'Date',
            'Check In',
            'Check Out',
            'Status',
        ];
    }
}
