
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees - IntelliDesk</title>

    <style>
        * { box-sizing: border-box; }

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

        h1 { color: #198754; }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .green { background: #198754; color: white; }
        .gray { background: #e5e9e6; color: #26352c; }

        .card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            box-shadow: 0 3px 12px #0000000d;
            overflow-x: auto;
        }

        .search {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search input {
            padding: 11px;
            width: 300px;
            max-width: 100%;
            border: 1px solid #ccd5ce;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
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

        tr:hover { background: #f5faf6; }

        .status {
            color: #198754;
            font-weight: bold;
        }

        .success {
            padding: 12px;
            margin-bottom: 18px;
            background: #d1e7dd;
            color: #0f5132;
            border-radius: 6px;
        }

        .empty {
            padding: 25px;
            text-align: center;
            color: #68756c;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>Employee Management</h1>
            <p>Manage and view employee information.</p>
        </div>

        <div>
            <a href="{{ route('dashboard') }}" class="btn gray">Dashboard</a>
            <a href="{{ route('employees.create') }}" class="btn green">+ Add Employee</a>
        </div>
    </div>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <form action="{{ route('employees.index') }}" method="GET" class="search">
            <input type="text" name="search" placeholder="Search ID, name, email, department..."
                value="{{ $search ?? '' }}">
            <button type="submit" class="btn green">Search</button>
            <a href="{{ route('employees.index') }}" class="btn gray">Clear</a>
        </form>

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
                        <td>{{ $employee->employee_id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->department ?? '-' }}</td>
                        <td>{{ $employee->position ?? '-' }}</td>
                        <td class="status">{{ $employee->status }}</td>
                        
<td>
    <a href="{{ route('employees.edit', $employee->id) }}"
       class="btn green">Edit</a>

    <form action="{{ route('employees.destroy', $employee->id) }}"
          method="POST"
          style="display:inline;"
          onsubmit="return confirm('Are you sure you want to delete this employee?');">
        @csrf
        @method('DELETE')
        <button type="submit"
                style="background:#dc3545;color:white;padding:10px 15px;border:0;border-radius:6px;cursor:pointer;">
            Delete
        </button>
    </form>
</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty">No employees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $employees->links() }}
        </div>
    </div>
</div>
</body>
</html>
