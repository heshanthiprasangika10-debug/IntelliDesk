<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance - IntelliDesk</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f4f7f5;
            color: #26352c;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        h1 {
            color: #198754;
        }

        .card {
            background: white;
            padding: 22px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 12px #0000000d;
            overflow-x: auto;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border: 0;
            border-radius: 6px;
            background: #198754;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .gray {
            background: #e5e9e6;
            color: #26352c;
        }

        .blue {
            background: #0d6efd;
        }

        .excel {
            background: #198754;
            margin-bottom: 15px;
        }

        select {
            padding: 10px;
            margin-right: 8px;
            max-width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th, td {
            padding: 13px;
            text-align: left;
            border-bottom: 1px solid #e5e9e6;
        }

        th {
            background: #198754;
            color: white;
        }

        .message {
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 6px;
        }

        .success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .error {
            background: #f8d7da;
            color: #842029;
        }

        .empty {
            padding: 25px;
            text-align: center;
            color: #68756c;
        }

        .status {
            color: #198754;
            font-weight: bold;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 20px;
        }

        .summary-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 12px #0000000d;
        }

        .summary-card h3 {
            margin: 0 0 10px;
            font-size: 15px;
            color: #68756c;
        }

        .summary-card .number {
            font-size: 30px;
            font-weight: bold;
            color: #198754;
        }

        .summary-card.absent .number {
            color: #dc3545;
        }

        .summary-card.checkout .number {
            color: #0d6efd;
        }

        @media (max-width: 800px) {
            .summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .summary {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

<main class="container">

    <!-- Header -->
    <header class="header">

        <div>
            <h1>Attendance Management</h1>
            <p>Today's attendance records.</p>
        </div>

        <a href="{{ route('dashboard') }}" class="btn gray">
            Dashboard
        </a>

    </header>


    <!-- Summary Cards -->
    <section class="summary">

        <div class="summary-card">
            <h3>Total Employees</h3>

            <div class="number">
                {{ $totalEmployees }}
            </div>
        </div>


        <div class="summary-card">
            <h3>Present Today</h3>

            <div class="number">
                {{ $presentToday }}
            </div>
        </div>


        <div class="summary-card absent">
            <h3>Absent Today</h3>

            <div class="number">
                {{ $absentToday }}
            </div>
        </div>


        <div class="summary-card checkout">
            <h3>Checked Out</h3>

            <div class="number">
                {{ $checkedOutToday }}
            </div>
        </div>

    </section>


    <!-- Success Message -->
    @if (session('success'))

        <div class="message success">
            {{ session('success') }}
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

            @foreach ($errors->all() as $error)

                <p>{{ $error }}</p>

            @endforeach

        </div>

    @endif


    <!-- Check In -->
    <section class="card">

        <h2>Check in employee</h2>

        <p style="margin-bottom: 18px;">
            Select an active employee to record attendance.
        </p>


        <form action="{{ route('attendance.checkIn') }}" method="POST">

            @csrf

            <label for="employee_id">
                Employee
            </label>


            <select
                id="employee_id"
                name="employee_id"
                required
            >

                <option value="">
                    Select an employee
                </option>


                @foreach ($employees as $employee)

                    <option
                        value="{{ $employee->id }}"
                        @selected(old('employee_id') == $employee->id)
                    >

                        {{ $employee->employee_id }} - {{ $employee->name }}

                    </option>

                @endforeach

            </select>


            <button type="submit" class="btn">
                Check In
            </button>

        </form>


        @error('employee_id')

            <p
                class="message error"
                style="margin-top: 12px;"
            >

                {{ $message }}

            </p>

        @enderror

    </section>


    <!-- Attendance Records -->
    <section class="card">

        <h2>Today's Attendance Records</h2>


        <!-- Export Excel Button -->
        <div style="margin: 15px 0;">

            <a
                href="{{ route('attendance.export') }}"
                class="btn excel"
            >

                📊 Export Excel

            </a>

        </div>


        <!-- Search and Date Filter -->
        <form
            action="{{ route('attendance.index') }}"
            method="GET"
            style="
                display:flex;
                gap:10px;
                flex-wrap:wrap;
                margin:20px 0;
            "
        >

            <input
                type="text"
                name="search"
                placeholder="Search employee name or ID"
                value="{{ $search ?? '' }}"
                style="
                    padding:10px;
                    border:1px solid #ddd;
                    border-radius:6px;
                    flex:1;
                    min-width:200px;
                "
            >


            <input
                type="date"
                name="date"
                value="{{ $date }}"
                required
                style="
                    padding:10px;
                    border:1px solid #ddd;
                    border-radius:6px;
                "
            >


            <button
                type="submit"
                class="btn"
            >
                Search
            </button>


            <a
                href="{{ route('attendance.index') }}"
                class="btn gray"
            >
                Clear
            </a>

        </form>


        <!-- Attendance Table -->
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

                        <td>
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


                        <td class="status">
                            {{ $attendance->status }}
                        </td>


                        <td>

                            @if ($attendance->check_out === null)

                                <form
                                    action="{{ route('attendance.checkOut', $attendance) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @method('PATCH')


                                    <button
                                        type="submit"
                                        class="btn blue"
                                    >
                                        Check Out
                                    </button>

                                </form>

                            @else

                                Completed

                            @endif

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="empty"
                        >
                            No attendance recorded today.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>


        <!-- Pagination -->
        <div style="margin-top: 20px;">

            {{ $attendances->links() }}

        </div>

    </section>

</main>

</body>
</html>
