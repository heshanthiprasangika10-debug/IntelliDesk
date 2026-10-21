<?php

namespace App\Http\Controllers;

use App\Models\Employee;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $employees = Employee::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('employee_id', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('employees.index', compact('employees', 'search'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => ['required', 'string', 'max:100', 'unique:employees,employee_id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:191', 'unique:employees,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'department' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'hire_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ]);

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee added successfully!');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'employee_id' => [
                'required', 'string', 'max:100',
                Rule::unique('employees', 'employee_id')->ignore($employee->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:191',
                Rule::unique('employees', 'email')->ignore($employee->id),
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'department' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'hire_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ]);

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully!');
    }
}
