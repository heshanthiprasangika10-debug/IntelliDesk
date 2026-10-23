<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests | IntelliDesk</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7f5;
            color: #26352c;
        }

        header {
            background: #198754;
            color: white;
            padding: 22px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        header h2 {
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 27px;
        }

        .subtitle {
            margin: 0;
            color: #718077;
        }

        .btn {
            display: inline-block;
            padding: 12px 17px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-primary {
            background: #198754;
            color: white;
        }

        .btn-primary:hover {
            background: #146c43;
        }

        .card {
            background: white;
            border: 1px solid #e1e9e3;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.04);
        }

        .card-heading {
            padding: 20px 22px;
            border-bottom: 1px solid #e8eee9;
        }

        .card-heading h2 {
            margin: 0;
            font-size: 18px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            padding: 15px 18px;
            text-align: left;
            border-bottom: 1px solid #edf1ee;
            vertical-align: top;
            font-size: 14px;
        }

        th {
            background: #f8faf8;
            color: #5b6b60;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        tbody tr:hover {
            background: #fbfdfb;
        }

        .employee-name {
            font-weight: 600;
        }

        .employee-id {
            display: block;
            color: #7b887f;
            font-size: 12px;
            margin-top: 5px;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .approved {
            background: #d1e7dd;
            color: #0f5132;
        }

        .rejected {
            background: #f8d7da;
            color: #842029;
        }

        .empty-state {
            padding: 45px 20px;
            text-align: center;
            color: #718077;
        }

        .empty-state h3 {
            color: #34443a;
            margin-top: 0;
        }

        .success-message {
            padding: 13px 16px;
            background: #d1e7dd;
            color: #0f5132;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #7b887f;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            .container {
                margin-top: 25px;
                padding: 0 12px;
            }

            h1 {
                font-size: 23px;
            }
        }
    </style>
</head>
<body>

<header>
    <h2>IntelliDesk</h2>
    <span>Leave Management</span>
</header>

<main class="container">

    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-heading">
        <div>
            <h1>Leave Requests</h1>
            <p class="subtitle">
                View and manage employee leave requests.
            </p>
        </div>

        <a href="{{ route('leave-requests.create') }}"
           class="btn btn-primary">
            + Apply for Leave
        </a>
    </div>

    <section class="card">
        <div class="card-heading">
            <h2>All Leave Requests</h2>
        </div>

        @if ($leaveRequests->isEmpty())
            <div class="empty-state">
                <h3>No leave requests yet</h3>
                <p>Submit a new leave request to see it listed here.</p>

                <a href="{{ route('leave-requests.create') }}"
                   class="btn btn-primary">
                    Apply for Leave
                </a>
            </div>
        @else
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($leaveRequests as $leave)
                            <tr>
                                <td>
                                    <span class="employee-name">
                                        {{ $leave->employee->name ?? 'Employee unavailable' }}
                                    </span>

                                    @if ($leave->employee)
                                        <span class="employee-id">
                                            {{ $leave->employee->employee_id }}
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $leave->leave_type }}</td>

                                <td>
                                    {{ $leave->start_date->format('d M Y') }}
                                </td>

                                <td>
                                    {{ $leave->end_date->format('d M Y') }}
                                </td>

                                <td>{{ $leave->reason }}</td>

                                <td>
                                    @php
                                        $statusClass = match ($leave->status) {
                                            'Approved' => 'approved',
                                            'Rejected' => 'rejected',
                                            default => 'pending',
                                        };
                                    @endphp

                                    <span class="badge {{ $statusClass }}">
                                        {{ $leave->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

</main>

<footer>
    IntelliDesk &copy; {{ date('Y') }} — Employee Management System
</footer>

</body>
</html>
