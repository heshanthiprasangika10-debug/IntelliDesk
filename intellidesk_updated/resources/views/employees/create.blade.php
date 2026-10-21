
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee - IntelliDesk</title>

    <style>
        * {
            box-sizing: border-box;
        }

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

        h1 {
            margin-top: 0;
            color: #198754;
        }

        .form-group {
            margin-bottom: 18px;
        }

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

        button {
            background: #198754;
            color: white;
        }

        .cancel {
            background: #e5e9e6;
            color: #26352c;
        }

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
        <h1>Add New Employee</h1>
        <p>Enter the employee details below.</p>

        @if ($errors->any())
            <div class="errors">
                <strong>Please correct these errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="employee_id">Employee ID *</label>
                <input type="text" id="employee_id" name="employee_id"
                    value="{{ old('employee_id') }}" required>
            </div>

            <div class="form-group">
                <label for="name">Full Name *</label>
                <input type="text" id="name" name="name"
                    value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email"
                    value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone"
                    value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" id="department" name="department"
                    value="{{ old('department') }}">
            </div>

            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" id="position" name="position"
                    value="{{ old('position') }}">
            </div>

            <div class="form-group">
                <label for="hire_date">Hire Date</label>
                <input type="date" id="hire_date" name="hire_date"
                    value="{{ old('hire_date') }}">
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="Active" {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="buttons">
                <button type="submit">Save Employee</button>
                <a class="cancel" href="{{ route('employees.index') }}">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
