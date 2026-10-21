<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceReportExport implements FromCollection, WithHeadings
{
    protected $from;
    protected $to;
    protected $search;

    public function __construct($from, $to, $search = null)
    {
        $this->from = $from;
        $this->to = $to;
        $this->search = $search;
    }

    public function collection()
    {
        return Attendance::with('employee')
            ->whereBetween('date', [$this->from, $this->to])
            ->when($this->search, function ($query, $search) {
                $query->whereHas('employee', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('employee_id', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('date')
            ->get()
            ->map(function ($attendance) {
                return [
                    $attendance->employee->employee_id ?? 'N/A',
                    $attendance->employee->name ?? 'N/A',
                    $attendance->date->format('Y-m-d'),
                    $attendance->check_in ?? '-',
                    $attendance->check_out ?? '-',
                    $attendance->status,
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
