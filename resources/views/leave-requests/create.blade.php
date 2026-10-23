<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Leave | IntelliDesk</title>

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
            padding: 22px 7%;
        }

        header h2 {
            margin: 0;
        }

        .container {
            max-width: 760px;
            margin: 35px auto;
            padding: 0 18px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #e1e9e3;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.04);
        }

        h1 {
            margin-top: 0;
            font-size: 26px;
        }

        .subtitle {
            color: #6b786f;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 19px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccd8cf;
            border-radius: 7px;
            font-size: 15px;
            background: white;
        }

        input:focus, select:focus, textarea:focus {
            outline: 2px solid #a8dfbd;
            border-color: #198754;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .date-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .error {
            color: #b42318;
            font-size: 13px;
            margin-top: 6px;
        }

        .alert {
            background: #fff0f0;
            color: #a61b1b;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 19px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            font-size: 15px;
            cursor: pointer;
        }

        .btn-primary {
            background: #198754;
            color: white;
        }

        .btn-primary:hover {
            background: #146c43;
        }

        .btn-secondary {
            background: #edf2ee;
            color: #33443a;
        }

        @media (max-width: 560px) {
            .card {
                padding: 20px;
            }

            .date-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>
<body>

<header>
    <h2>IntelliDesk</h2>
</header>

<div class="container">
    <div class="card">
        <h1>Apply for Leave</h1>
        <p class="subtitle">
            Complete the form below to submit a leave request.
        </p>

        @if ($errors->any())
            <div class="alert">
                Please correct the errors below.
            </div>
        @endif

        <form action="{{ route('leave-requests.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="employee_id">Employee</label>

                <select id="employee_id" name="employee_id" required>
                    <option value="">Select employee</option>

                    @foreach ($employees as $employee)
                        <option
                            value="{{ $employee->id }}"
                            {{ old('employee_id') == $employee->id ? 'selected' : '' }}
                        >
                            {{ $employee->name }}
                            ({{ $employee->employee_id }})
                        </option>
                    @endforeach
                </select>

                @error('employee_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="leave_type">Leave Type</label>

                <select id="leave_type" name="leave_type" required>
                    <option value="">Select leave type</option>
                    <option value="Annual" {{ old('leave_type') == 'Annual' ? 'selected' : '' }}>Annual Leave</option>
                    <option value="Casual" {{ old('leave_type') == 'Casual' ? 'selected' : '' }}>Casual Leave</option>
                    <option value="Sick" {{ old('leave_type') == 'Sick' ? 'selected' : '' }}>Sick Leave</option>
                    <option value="Other" {{ old('leave_type') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>

                @error('leave_type')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="date-row">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        value="{{ old('start_date') }}"
                        required
                    >

                    @error('start_date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        value="{{ old('end_date') }}"
                        required
                    >

                    @error('end_date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="reason">Reason for Leave</label>

                <textarea
                    id="reason"
                    name="reason"
                    placeholder="Enter the reason for your leave..."
                    maxlength="1000"
                    required
                >{{ old('reason') }}</textarea>

                @error('reason')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">
                    Submit Request
                </button>

                <a href="{{ route('leave-requests.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
