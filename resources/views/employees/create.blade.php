<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee | IntelliDesk</title>

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
            --red: #b42332;
            --shadow: 0 8px 24px rgba(25, 42, 70, 0.05);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 32px 18px;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--page);
            color: var(--ink);
        }

        .container {
            max-width: 850px;
            margin: 0 auto;
        }

        .breadcrumb {
            margin-bottom: 12px;
            color: var(--muted);
            font-size: 13px;
        }

        .breadcrumb span {
            color: var(--green);
            font-weight: 600;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-label {
            margin-bottom: 9px;
            color: var(--green);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-size: 30px;
            color: var(--ink);
        }

        .subtitle {
            margin: 10px 0 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .card {
            overflow: hidden;
            background: var(--white);
            border: 1px solid #edf0f4;
            border-radius: 14px;
            box-shadow: var(--shadow);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 23px 26px;
            border-bottom: 1px solid var(--line);
        }

        .icon-box {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            border-radius: 12px;
            background: var(--green-soft);
            color: var(--green-dark);
            font-size: 24px;
        }

        .card-header h2 {
            margin: 0;
            font-size: 18px;
        }

        .card-header p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .form-content {
            padding: 26px;
        }

        .section-title {
            margin: 0 0 20px;
            font-size: 15px;
            color: var(--ink);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 21px 20px;
        }

        .form-group {
            min-width: 0;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 9px;
            color: #344054;
            font-size: 13px;
            font-weight: 600;
        }

        .required {
            color: var(--red);
        }

        input,
        select {
            width: 100%;
            min-height: 44px;
            padding: 11px 13px;
            border: 1px solid #dce3e8;
            border-radius: 8px;
            outline: none;
            background: #fff;
            color: var(--ink);
            font-family: inherit;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input::placeholder {
            color: #a0a9b6;
        }

        input:focus,
        select:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.10);
        }

        .field-hint {
            display: block;
            margin-top: 7px;
            color: var(--muted);
            font-size: 11px;
        }

        .errors {
            margin-bottom: 23px;
            padding: 15px 18px;
            color: #842029;
            background: #fff1f2;
            border: 1px solid #fecdd3;
            border-radius: 9px;
            font-size: 13px;
        }

        .errors strong {
            display: block;
            margin-bottom: 8px;
        }

        .errors ul {
            margin: 0;
            padding-left: 20px;
            line-height: 1.8;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 29px;
            padding-top: 22px;
            border-top: 1px solid var(--line);
        }

        .footer-note {
            color: var(--muted);
            font-size: 12px;
        }

        .buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 42px;
            padding: 11px 17px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .save-btn {
            color: #fff;
            background: var(--green);
        }

        .save-btn:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
        }

        .cancel-btn {
            color: var(--ink);
            background: #fff;
            border-color: var(--line);
        }

        .cancel-btn:hover {
            background: #f5f7f9;
        }

        @media (max-width: 600px) {
            body {
                padding: 22px 12px;
            }

            h1 {
                font-size: 25px;
            }

            .card-header,
            .form-content {
                padding: 19px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .full-width {
                grid-column: auto;
            }

            .form-footer {
                align-items: stretch;
                flex-direction: column;
            }

            .buttons {
                width: 100%;
            }

            .buttons .btn {
                flex: 1;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="breadcrumb">
        <span>IntelliDesk</span> / Employees / Add Employee
    </div>

    <div class="page-header">
        <div class="page-label">Human Resources</div>
        <h1>Add New Employee</h1>
        <p class="subtitle">
            Add a new employee to your organization by completing the details below.
        </p>
    </div>

    <div class="card">

        <div class="card-header">
            <div class="icon-box">+</div>
            <div>
                <h2>Employee Information</h2>
                <p>Enter the employee's personal and work details.</p>
            </div>
        </div>

        <div class="form-content">

            @if ($errors->any())
                <div class="errors">
                    <strong>Please correct the following errors:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('employees.store') }}" method="POST">
                @csrf

                <h3 class="section-title">Basic Information</h3>

                <div class="form-grid">

                    <div class="form-group">
                        <label for="employee_id">
                            Employee ID <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="employee_id"
                            name="employee_id"
                            placeholder="e.g. EMP001"
                            value="{{ old('employee_id') }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="name">
                            Full Name <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Enter full name"
                            value="{{ old('name') }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">
                            Email Address <span class="required">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="employee@example.com"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            placeholder="Enter phone number"
                            value="{{ old('phone') }}"
                        >
                    </div>

                </div>

                <h3 class="section-title" style="margin-top: 30px;">
                    Work Information
                </h3>

                <div class="form-grid">

                    <div class="form-group">
                        <label for="department">Department</label>
                        <input
                            type="text"
                            id="department"
                            name="department"
                            placeholder="e.g. IT Department"
                            value="{{ old('department') }}"
                        >
                    </div>

                    <div class="form-group">
                        <label for="position">Position</label>
                        <input
                            type="text"
                            id="position"
                            name="position"
                            placeholder="e.g. Software Engineer"
                            value="{{ old('position') }}"
                        >
                    </div>

                    <div class="form-group">
                        <label for="hire_date">Hire Date</label>
                        <input
                            type="date"
                            id="hire_date"
                            name="hire_date"
                            value="{{ old('hire_date') }}"
                        >
                    </div>

                    <div class="form-group">
                        <label for="status">
                            Employment Status <span class="required">*</span>
                        </label>
                        <select id="status" name="status" required>
                            <option value="Active"
                                {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="Inactive"
                                {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                        <span class="field-hint">
                            Select the employee's current status.
                        </span>
                    </div>

                </div>

                <div class="form-footer">
                    <div class="footer-note">
                        <span class="required">*</span> Required fields
                    </div>

                    <div class="buttons">
                        <a
                            href="{{ route('employees.index') }}"
                            class="btn cancel-btn"
                        >
                            Cancel
                        </a>

                        <button type="submit" class="btn save-btn">
                            Save Employee
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>
