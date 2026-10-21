<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance | IntelliDesk</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --green: #198754;
            --green-dark: #146c43;
            --green-light: #e8f5ee;
            --background: #f4f7f5;
            --text: #26352c;
            --muted: #68756c;
            --border: #e5e9e6;
            --white: #ffffff;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        .container {
            max-width: 1250px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--green-light);
            color: var(--green);
            font-size: 25px;
        }

        h1 {
            margin: 0 0 8px;
            color: var(--green-dark);
            font-size: 29px;
        }

        h2 {
            margin: 0 0 10px;
            font-size: 20px;
        }

        .subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 16px;
            border: 1px solid transparent;
            border-radius: 7px;
            background: var(--green);
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn:hover {
            background: var(--green-dark);
        }

        .gray {
            background: white;
            border-color: var(--border);
            color: var(--text);
        }

        .gray:hover {
            background: #edf1ee;
        }

        .blue {
            background: #0d6efd;
        }

        .blue:hover {
            background: #0b5ed7;
        }

        .excel {
            background: var(--green);
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .summary-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 22px;
            background: var(--white);
            border: 1px solid #edf0ed;
            border-radius: 12px;
            box-shadow: 0 4px 15px #00000008;
        }

        .summary-card h3 {
            margin: 0 0 12px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .number {
            color: var(--green);
            font-size: 30px;
            font-weight: 700;
        }

        .summary-card.absent .number {
            color: #dc3545;
        }

        .summary-card.checkout .number {
            color: #0d6efd;
        }

        .summary-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 10px;
            background: var(--green-light);
            color: var(--green);
            font-size: 21px;
            flex-shrink: 0;
        }

        .summary-card.absent .summary-icon {
            background: #fce8ea;
            color: #dc3545;
        }

        .summary-card.checkout .summary-icon {
            background: #e8f1ff;
            color: #0d6efd;
        }

        .card {
            margin-bottom: 24px;
            padding: 25px;
            background: var(--white);
            border: 1px solid #edf0ed;
            border-radius: 12px;
            box-shadow: 0 4px 15px #00000008;
        }

        .card-description {
            margin: 0 0 20px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .checkin-form {
            display: flex;
            align-items: end;
            gap: 12px;
            flex-wrap: wrap;
        }

        .form-group {
            flex: 1;
            min-width: 220px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            font-size: 14px;
            font-weight: 600;
        }

        input,
        select {
            width: 100%;
            min-height: 43px;
            padding: 10px 12px;
            border: 1px solid #d8e0da;
            border-radius: 7px;
            background: white;
            color: var(--text);
            font-size: 14px;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px #19875418;
        }

        .message {
            padding: 14px 16px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
        }

        .success {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .error {
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .error p {
            margin: 5px 0;
        }

        .records-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .records-header h2 {
            margin: 0;
        }

        .filter-form {
            display: flex;
            align-items: end;
            gap: 10px;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .search-group {
            flex: 1;
            min-width: 220px;
        }

        .date-group {
            width: 180px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 9px;
        }

        table {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 14px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }

        th {
            background: #edf6f0;
            color: var(--green-dark);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #f8fbf9;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .employee-id {
            color: var(--green-dark);
            font-weight: 700;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: var(--green-light);
            color: var(--green-dark);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .action-form {
            display: inline;
        }

        .action-form .btn {
            padding: 8px 11px;
            font-size: 12px;
            white-space: nowrap;
        }

        .completed {
            color: var(--green-dark);
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .empty {
            padding: 35px 20px;
            text-align: center;
            color: var(--muted);
        }

        .pagination {
            margin-top: 22px;
        }

        @media (max-width: 900px) {
            body {
                padding: 20px;
            }

            .summary {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 550px) {
            body {
                padding: 14px;
            }

            h1 {
                font-size: 23px;
            }

            .summary {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .card {
                padding: 17px;
            }

            .checkin-form,
            .filter-form {
                align-items: stretch;
                flex-direction: column;
            }

            .form-group,
            .search-group,
            .date-group {
                width: 100%;
                min-width: 0;
            }

            .checkin-form .btn,
            .filter-form .btn {
                width: 100%;
            }

            .header > .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
<main class="container">

    <!-- Page Header -->
    <header class="header">
        <div class="brand">
            <div class="brand-icon">✓</div>
            <div>
                <h1>Attendance Management</h1>
                <p class="subtitle">
                    Monitor employee attendance and daily working records.
                </p>
            </div>
        </div>

        <a href="{{ route('dashboard') }}" class="btn gray">
            ← Dashboard
        </a>
    </header>

    <!-- Attendance Summary -->
    <section class="summary">
        <div class="summary-card">
            <div>
                <h3>Total Employees</h3>
                <div class="number">{{ $totalEmployees }}</div>
            </div>
            <div class="summary-icon">👥</div>
        </div>

        <div class="summary-card">
            <div>
                <h3>Present Today</h3>
                <div class="number">{{ $presentToday }}</div>
            </div>
            <div class="summary-icon">✓</div>
        </div>

        <div class="summary-card absent">
            <div>
                <h3>Absent Today</h3>
                <div class="number">{{ $absentToday }}</div>
            </div>
            <div class="summary-icon">!</div>
        </div>

        <div class="summary-card checkout">
            <div>
                <h3>Checked Out</h3>
                <div class="number">{{ $checkedOutToday }}</div>
            </div>
            <div class="summary-icon">↗</div>
        </div>
    </section>

    <!-- Success Message -->
    @if (session('success'))
        <div class="message success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if (session('error'))
        <div class="message error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="message error">
            <strong>Please correct the following errors:</strong>

            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- Check In Employee -->
    <section class="card">
        <h2>Check In Employee</h2>
        <p class="card-description">
            Select an employee to record their attendance for the day.
        </p>

        <form
            action="{{ route('attendance.checkIn') }}"
            method="POST"
            class="checkin-form"
        >
            @csrf

            <div class="form-group">
                <label for="employee_id">Select Employee</label>

                <select id="employee_id" name="employee_id" required>
                    <option value="">Choose an employee</option>

                    @foreach ($employees as $employee)
                        <option
                            value="{{ $employee->id }}"
                            @selected(old('employee_id') == $employee->id)
                        >
                            {{ $employee->employee_id }} - {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn">
                ✓ Check In
            </button>
        </form>

        @error('employee_id')
            <div class="message error" style="margin-top: 12px; margin-bottom: 0;">
                {{ $message }}
            </div>
        @enderror
    </section>

    <!-- Attendance Records -->
    <section class="card">
        <div class="records-header">
            <div>
                <h2>Attendance Records</h2>
                <p class="subtitle" style="margin-top: 8px;">
                    Search, filter and export employee attendance.
                </p>
            </div>

            <a href="{{ route('attendance.export') }}" class="btn excel">
                📊 Export Excel
            </a>
        </div>

        <!-- Search and Date Filter -->
        <form
            action="{{ route('attendance.index') }}"
            method="GET"
            class="filter-form"
        >
            <div class="search-group">
                <label for="search">Search Employee</label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    placeholder="Enter employee name or ID"
                    value="{{ $search ?? '' }}"
                >
            </div>

            <div class="date-group">
                <label for="date">Attendance Date</label>
                <input
                    type="date"
                    id="date"
                    name="date"
                    value="{{ $date }}"
                    required
                >
            </div>

            <button type="submit" class="btn">
                Search
            </button>

            <a href="{{ route('attendance.index') }}" class="btn gray">
                Clear
            </a>
        </form>

        <!-- Attendance Table -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($attendances as $attendance)
                        <tr>
                            <td class="employee-id">
                                {{ $attendance->employee->employee_id }}
                            </td>

                            <td>
                                {{ $attendance->employee->name }}
                            </td>

                            <td>
                                {{ $attendance->date->format('Y-m-d') }}
                            </td>

                            <td>
                                {{ $attendance->check_in ?? '-' }}
                            </td>

                            <td>
                                {{ $attendance->check_out ?? '-' }}
                            </td>

                            <td>
                                <span class="status">
                                    {{ $attendance->status }}
                                </span>
                            </td>

                            <td>
                                @if ($attendance->check_out === null)
                                    <form
                                        action="{{ route('attendance.checkOut', $attendance) }}"
                                        method="POST"
                                        class="action-form"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn blue">
                                            Check Out
                                        </button>
                                    </form>
                                @else
                                    <span class="completed">
                                        ✓ Completed
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty">
                                No attendance records found for the selected date.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $attendances->links() }}
        </div>
    </section>

</main>
</body>
</html>
