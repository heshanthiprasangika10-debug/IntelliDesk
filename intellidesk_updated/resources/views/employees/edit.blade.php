
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee - IntelliDesk</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 30px 15px;
            font-family: Arial, sans-serif;
            background: #f4f7f5;
            color: #26352c;
        }

        .container {
            max-width: 700px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px #00000012;
        }

        h1 { color: #198754; }

        .form-group { margin-bottom: 18px; }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccd5ce;
            border-radius: 6px;
            font-size: 15px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        button, .cancel {
            padding: 11px 18px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 15px;
        }

        button { background: #198754; color: white; }
        .cancel { background: #e5e9e6; color: #26352c; }

        .errors {
            padding: 12px;
            margin-bottom: 20px;
            color: #842029;
            background: #f8d7da;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Employee</h1>
        <p>Update the employee details below.</p>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="employee_id">Employee ID *</label>
                <input id="employee_id" name="employee_id" type="text"
                    value="{{ old('employee_id', $employee->employee_id) }}" required>
            </div>

            <div class="form-group">
                <label for="name">Full Name *</label>
                <input id="name" name="name" type="text"
                    value="{{ old('name', $employee->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address *</label>
                <input id="email" name="email" type="email"
                    value="{{ old('email', $employee->email) }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input id="phone" name="phone" type="text"
                    value="{{ old('phone', $employee->phone) }}">
            </div>

            <div class="form-group">
                <label for="department">Department</label>
                <input id="department" name="department" type="text"
                    value="{{ old('department', $employee->department) }}">
            </div>

            <div class="form-group">
                <label for="position">Position</label>
                <input id="position" name="position" type="text"
                    value="{{ old('position', $employee->position) }}">
            </div>

            <div class="form-group">
                <label for="hire_date">Hire Date</label>
                <input id="hire_date" name="hire_date" type="date"
                    value="{{ old('hire_date', $employee->hire_date?->format('Y-m-d')) }}">
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="Active" {{ old('status', $employee->status) == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status', $employee->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="buttons">
                <button type="submit">Update Employee</button>
                <a href="{{ route('employees.index') }}" class="cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
