<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees | IntelliDesk</title>

    <style>
        :root {
            --green: #198754;
            --green-dark: #146c43;
            --green-soft: #e8f5ee;
            --ink: #202b3c;
            --muted: #758195;
            --line: #e7ebf1;
            --page: #f5f7fb;
            --white: #ffffff;
            --red: #dc3545;
            --shadow: 0 8px 24px rgba(25, 42, 70, 0.05);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 32px;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--page);
            color: var(--ink);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .page-label {
            color: var(--green);
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 750;
            color: var(--ink);
        }

        .subtitle {
            color: var(--muted);
            font-size: 14px;
            margin: 9px 0 0;
            line-height: 1.6;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 16px;
            border-radius: 8px;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            transition: 0.2s ease;
            white-space: nowrap;
        }

        .green {
            background: var(--green);
            color: var(--white);
        }

        .green:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
        }

        .gray {
            background: var(--white);
            color: var(--ink);
            border-color: var(--line);
        }

        .gray:hover {
            background: #f0f4f1;
        }

        .card {
            background: var(--white);
            border: 1px solid #edf0f4;
            padding: 25px;
            border-radius: 14px;
            box-shadow: var(--shadow);
        }

        .card-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 22px;
        }

        .card-heading h2 {
            margin: 0;
            font-size: 18px;
            color: var(--ink);
        }

        .card-heading p {
            margin: 6px 0 0;
            font-size: 13px;
            color: var(--muted);
        }

        .section-tag {
            background: var(--green-soft);
            color: var(--green-dark);
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .search {
            display: flex;
            gap: 10px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }

        .search input {
            padding: 12px 14px;
            width: 360px;
            max-width: 100%;
            border: 1px solid #dce3e8;
            border-radius: 8px;
            outline: none;
            background: #fff;
            color: var(--ink);
            font-size: 13px;
            font-family: inherit;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.10);
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        th, td {
            padding: 15px 16px;
            text-align: left;
            border-bottom: 1px solid var(--line);
            font-size: 13px;
        }

        th {
            background: #f7f9fb;
            color: #637084;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        td {
            color: #354155;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f8fcf9;
        }

        .employee-id {
            color: var(--green-dark);
            font-weight: 700;
            white-space: nowrap;
        }

        .employee-name {
            font-weight: 600;
            color: var(--ink);
        }

        .email {
            color: var(--muted);
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: var(--green-soft);
            color: var(--green-dark);
            font-weight: 600;
            font-size: 11px;
            text-transform: capitalize;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action-btn {
            padding: 8px 11px;
            font-size: 12px;
        }

        .delete-btn {
            background: #fff1f2;
            color: var(--red);
            border: 1px solid #ffe0e4;
        }

        .delete-btn:hover {
            background: var(--red);
            color: #fff;
        }

        .success {
            padding: 14px 17px;
            margin-bottom: 20px;
            background: #e8f5ee;
            color: #146c43;
            border: 1px solid #c9e8d5;
            border-radius: 9px;
            font-size: 14px;
        }

        .empty {
            padding: 35px 20px;
            text-align: center;
            color: var(--muted);
        }

        .pagination {
            margin-top: 22px;
        }

        .footer-note {
            margin-top: 18px;
            color: var(--muted);
            font-size: 12px;
        }

        @media (max-width: 768px) {
            body {
                padding: 18px 12px;
            }

            h1 {
                font-size: 24px;
            }

            .card {
                padding: 16px;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions .btn {
                flex: 1;
            }

            .search input {
                width: 100%;
                flex: 1 1 100%;
            }

            .search .btn {
                flex: 1;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <div>
            <div class="page-label">IntelliDesk / Human Resources</div>
            <h1>Employee Management</h1>
            <p class="subtitle">
                Manage employee information, departments and positions.
            </p>
        </div>

        <div class="header-actions">
            <a href="{{ route('dashboard') }}" class="btn gray">
                ← Dashboard
            </a>

            <a href="{{ route('employees.create') }}" class="btn green">
                + Add Employee
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <div class="card-heading">
            <div>
                <h2>All Employees</h2>
                <p>View and manage your employee records.</p>
            </div>

            <span class="section-tag">Employee Directory</span>
        </div>

        <form action="{{ route('employees.index') }}" method="GET" class="search">
            <input
                type="text"
                name="search"
                placeholder="Search ID, name, email, department..."
                value="{{ $search ?? '' }}"
            >

            <button type="submit" class="btn green">
                Search
            </button>

            <a href="{{ route('employees.index') }}" class="btn gray">
                Clear
            </a>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td class="employee-id">
                                {{ $employee->employee_id }}
                            </td>

                            <td class="employee-name">
                                {{ $employee->name }}
                            </td>

                            <td class="email">
                                {{ $employee->email }}
                            </td>

                            <td>
                                {{ $employee->department ?? '-' }}
                            </td>

                            <td>
                                {{ $employee->position ?? '-' }}
                            </td>

                            <td>
                                <span class="status">
                                    {{ $employee->status }}
                                </span>
                            </td>

                            <td>
                                <div class="actions">
                                    <a
                                        href="{{ route('employees.edit', $employee->id) }}"
                                        class="btn green action-btn"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('employees.destroy', $employee->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this employee?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn delete-btn action-btn"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty">
                                No employees found. Try another search or add a new employee.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $employees->links() }}
        </div>

        <div class="footer-note">
            IntelliDesk Employee Management
        </div>

    </div>
</div>
</body>
</html>
