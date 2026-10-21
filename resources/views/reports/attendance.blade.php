<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Attendance Reports | IntelliDesk</title>
    <style>
        :root{--navy:#172b4d;--green:#198754;--green-dark:#146c43;--green-soft:#e8f5ee;--ink:#202b3c;--muted:#758195;--line:#e7ebf1;--page:#f5f7fb;--white:#fff;--red:#d9485f;--blue:#3867d6;--shadow:0 8px 24px rgba(25,42,70,.05)}
        *{box-sizing:border-box}body{margin:0;background:var(--page);color:var(--ink);font-family:Inter,-apple-system,BlinkMacSystemFont,"Segoe UI",Arial,sans-serif;font-size:14px}a{color:inherit;text-decoration:none}button,input{font:inherit}
        .sidebar{position:fixed;inset:0 auto 0 0;width:250px;background:var(--navy);color:#d9e3f2;padding:26px 16px;display:flex;flex-direction:column;z-index:5}.brand{display:flex;align-items:center;gap:11px;padding:0 12px 34px;font-size:20px;font-weight:750;letter-spacing:-.5px;color:#fff}.brand-mark{display:grid;place-items:center;width:36px;height:36px;background:var(--green);border-radius:10px;color:#fff;font-weight:800;font-size:17px}.brand-name{color:#fff}.brand-name span{color:#9fdbbb}.nav-caption{padding:0 12px 11px;color:#91a3bf;text-transform:uppercase;font-size:10px;letter-spacing:1.4px;font-weight:700}.nav{display:grid;gap:5px}.nav a{display:flex;align-items:center;gap:13px;padding:12px 13px;border-radius:9px;color:#c9d5e7;font-weight:550;transition:background .15s,color .15s}.nav a:hover{background:rgba(255,255,255,.08);color:#fff}.nav a.active{background:var(--green);color:#fff;box-shadow:0 5px 14px rgba(25,135,84,.25)}.nav-icon{width:19px;text-align:center;font-size:16px}.sidebar-bottom{margin-top:auto}.help-card{padding:15px;border:1px solid rgba(255,255,255,.12);border-radius:11px;background:rgba(255,255,255,.04);margin:0 3px 18px}.help-card strong{display:block;color:#fff;margin-bottom:5px;font-size:12px}.help-card p{margin:0;color:#9eafc8;font-size:11px;line-height:1.55}.logout-form{padding:0 3px}.logout-btn{width:100%;border:1px solid rgba(255,255,255,.16);background:transparent;color:#e1e8f2;padding:11px 12px;border-radius:8px;text-align:left;cursor:pointer}.logout-btn:hover{background:rgba(255,255,255,.08)}
        .main{margin-left:250px;min-height:100vh}.topbar{height:76px;background:#fff;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 34px;gap:20px}.breadcrumb{color:var(--muted);font-size:12px}.breadcrumb strong{color:var(--ink);font-weight:650}.topbar-right{display:flex;align-items:center;gap:18px}.today{color:var(--muted);font-size:12px}.profile{display:flex;align-items:center;gap:10px;border-left:1px solid var(--line);padding-left:18px}.avatar{display:grid;place-items:center;width:36px;height:36px;border-radius:50%;background:#e5f4eb;color:var(--green-dark);font-weight:750}.profile-name{font-weight:650;font-size:12px}.profile-role{color:var(--muted);font-size:11px;margin-top:3px}.content{max-width:1500px;margin:0 auto;padding:32px 34px 40px}.page-heading{display:flex;justify-content:space-between;align-items:flex-end;gap:18px;margin-bottom:26px}.eyebrow{color:var(--green);font-size:11px;font-weight:750;text-transform:uppercase;letter-spacing:1.4px;margin-bottom:8px}.page-heading h1{font-size:28px;letter-spacing:-.8px;margin:0 0 8px;font-weight:750;color:#1d2a3d}.page-heading p{margin:0;color:var(--muted);font-size:13px}.date-chip{background:#fff;border:1px solid var(--line);border-radius:9px;padding:10px 13px;color:#526078;font-size:12px;white-space:nowrap}
        .summary{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:17px;margin-bottom:22px}.stat{background:#fff;border:1px solid var(--line);border-radius:13px;padding:20px;box-shadow:var(--shadow);min-width:0}.stat-top{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:17px}.stat-label{font-size:12px;color:#6d798b;font-weight:600}.stat-icon{width:36px;height:36px;display:grid;place-items:center;border-radius:10px;background:#edf7f1;color:var(--green);font-size:17px}.stat-icon.blue{background:#edf2ff;color:var(--blue)}.stat-icon.slate{background:#edf1f6;color:#627188}.stat-value{font-size:29px;line-height:1.1;font-weight:760;letter-spacing:-1px;color:#1e2b3d}.stat-note{font-size:11px;color:var(--muted);margin-top:10px}
        .panel{background:#fff;border:1px solid var(--line);border-radius:13px;box-shadow:var(--shadow);overflow:hidden;margin-bottom:20px}.panel-head{display:flex;justify-content:space-between;align-items:center;gap:15px;padding:21px 23px;border-bottom:1px solid var(--line)}.panel-head h2{margin:0 0 5px;font-size:15px;font-weight:750;letter-spacing:-.2px}.panel-head p{margin:0;color:var(--muted);font-size:12px}.filter-body{padding:20px 23px}.filters{display:grid;grid-template-columns:1fr 1fr minmax(200px,1.5fr) auto auto;gap:13px;align-items:end}.field{min-width:0}.field label{display:block;font-size:11px;font-weight:700;color:#526078;margin-bottom:8px}.control{display:block;width:100%;height:42px;padding:0 12px;border:1px solid #dce2eb;border-radius:8px;background:#fff;color:#27364b;outline:none;transition:border-color .15s,box-shadow .15s}.control:focus{border-color:#75b992;box-shadow:0 0 0 3px rgba(25,135,84,.1)}.btn{height:42px;display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:0 15px;border:1px solid transparent;border-radius:8px;font-size:12px;font-weight:750;white-space:nowrap;cursor:pointer;transition:background .15s,border-color .15s}.btn-primary{background:var(--green);color:#fff}.btn-primary:hover{background:var(--green-dark)}.btn-light{background:#fff;color:#526078;border-color:#dce2eb}.btn-light:hover{background:#f7f9fb}.btn-export{background:#edf7f1;color:#176d43;border-color:#d7ecdf}.btn-export:hover{background:#dff1e6}.error-list{margin:0 0 18px;padding:13px 16px;border:1px solid #f2c6cb;border-radius:9px;background:#fff1f2;color:#a12635;font-size:12px}.error-list p{margin:4px 0}
        .table-head{display:flex;justify-content:space-between;align-items:center;gap:14px;padding:20px 23px;border-bottom:1px solid var(--line)}.table-actions{display:flex;align-items:center;gap:9px;flex-wrap:wrap;justify-content:flex-end}.table-head h2{margin:0 0 5px;font-size:15px;font-weight:750}.table-head p{margin:0;color:var(--muted);font-size:12px}.record-count{font-size:11px;color:#667386;background:#f4f6f9;border:1px solid var(--line);border-radius:20px;padding:7px 10px;white-space:nowrap}.table-wrap{overflow-x:auto}table{width:100%;border-collapse:collapse;min-width:760px}thead th{text-align:left;padding:13px 22px;background:#fafbfd;color:#7c8798;font-size:10px;text-transform:uppercase;letter-spacing:.7px;font-weight:750;border-bottom:1px solid var(--line);white-space:nowrap}tbody td{padding:15px 22px;border-bottom:1px solid #eff2f6;font-size:12px;color:#4c586a;white-space:nowrap}tbody tr:last-child td{border-bottom:0}tbody tr:hover{background:#fcfdfd}.employee-cell{display:flex;align-items:center;gap:10px}.mini-avatar{width:32px;height:32px;border-radius:9px;background:#edf3f8;color:#415a77;display:grid;place-items:center;font-weight:750;font-size:11px;flex-shrink:0}.employee-name{font-weight:650;color:#263449;font-size:12px}.employee-id{font-size:11px;color:#8993a2;margin-top:3px}.status{display:inline-flex;align-items:center;gap:6px;padding:5px 9px;border-radius:20px;font-size:10px;font-weight:750;background:#e8f6ee;color:#187747}.status.pending{background:#fff5df;color:#986515}.status-dot{width:5px;height:5px;border-radius:50%;background:currentColor}.empty{padding:42px 20px;text-align:center;color:var(--muted);white-space:normal}.table-footer{padding:17px 22px;border-top:1px solid var(--line);display:flex;justify-content:space-between;align-items:center;gap:15px;color:var(--muted);font-size:11px}.pagination nav{display:flex;align-items:center;gap:4px}.pagination nav div:first-child{display:none}.pagination nav a,.pagination nav span[aria-current],.pagination nav span[aria-disabled]{display:inline-flex;align-items:center;justify-content:center;min-width:30px;height:30px;padding:0 8px;border:1px solid var(--line);border-radius:6px;font-size:11px;color:#526078;background:#fff}.pagination nav span[aria-current]{background:var(--green);border-color:var(--green);color:#fff}.pagination nav span[aria-disabled]{color:#b2bac5}.footnote{text-align:center;color:#99a2af;font-size:10px;margin-top:20px}
        @media(max-width:1200px){.sidebar{width:220px}.main{margin-left:220px}.content{padding:26px 24px}.topbar{padding:0 24px}.summary{grid-template-columns:repeat(2,minmax(0,1fr))}.filters{grid-template-columns:repeat(2,minmax(0,1fr))}.field.search-field{grid-column:span 2}.filters .btn{width:100%}}
        @media(max-width:760px){.sidebar{position:static;width:auto;min-height:auto;padding:16px}.brand{padding:0 8px 16px}.nav-caption,.sidebar-bottom{display:none}.nav{grid-template-columns:repeat(2,minmax(0,1fr))}.nav a{padding:10px;font-size:12px}.main{margin-left:0}.topbar{height:auto;min-height:64px;padding:14px 18px}.today{display:none}.content{padding:22px 16px}.page-heading{align-items:flex-start;flex-direction:column}.filter-body{padding:17px}.table-head{padding:17px}.table-footer{align-items:flex-start;flex-direction:column}.table-footer .pagination{max-width:100%;overflow-x:auto}.panel-head{padding:17px}}
        @media(max-width:450px){.summary{grid-template-columns:1fr}.filters{grid-template-columns:1fr}.field.search-field{grid-column:auto}.topbar-right{gap:0}.profile{padding-left:10px}.profile-name{max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.page-heading h1{font-size:24px}.date-chip{white-space:normal}}
    </style>
</head>
<body>
<aside class="sidebar">
    <a class="brand" href="{{ route('dashboard') }}"><span class="brand-mark">I</span><span class="brand-name">Intelli<span>Desk</span></span></a>
    <div class="nav-caption">Workspace</div>
    <nav class="nav" aria-label="Main navigation">
        <a href="{{ route('dashboard') }}"><span class="nav-icon">▦</span> Dashboard</a>
        <a href="{{ route('employees.index') }}"><span class="nav-icon">♙</span> Employees</a>
        <a href="{{ route('attendance.index') }}"><span class="nav-icon">◷</span> Attendance</a>
        <a class="active" href="{{ route('reports.attendance') }}"><span class="nav-icon">▤</span> Reports</a>
    </nav>
    <div class="sidebar-bottom"><div class="help-card"><strong>IntelliDesk Workspace</strong><p>Attendance insights and exportable workforce records.</p></div><form class="logout-form" method="POST" action="{{ route('logout') }}">@csrf<button class="logout-btn" type="submit">↪ &nbsp; Sign out</button></form></div>
</aside>

<main class="main">
    <header class="topbar">
        <div class="breadcrumb">Workspace &nbsp; / &nbsp; <strong>Attendance reports</strong></div>
        <div class="topbar-right"><div class="today">{{ now()->format('l, d F Y') }}</div><div class="profile"><div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div><div><div class="profile-name">{{ auth()->user()->name }}</div><div class="profile-role">Workspace account</div></div></div></div>
    </header>

    <div class="content">
        <div class="page-heading"><div><div class="eyebrow">Workforce analytics</div><h1>Attendance reports</h1><p>Review attendance records, narrow the reporting period and export the results.</p></div><div class="date-chip">▤ &nbsp; Reporting period: {{ \Illuminate\Support\Carbon::parse($from)->format('d M Y') }} – {{ \Illuminate\Support\Carbon::parse($to)->format('d M Y') }}</div></div>

        @if ($errors->any())
            <div class="error-list" role="alert"><strong>Please check the selected filters.</strong>@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>
        @endif

        <section class="summary" aria-label="Report summary">
            <article class="stat"><div class="stat-top"><div class="stat-label">Active employees</div><div class="stat-icon">♙</div></div><div class="stat-value">{{ number_format($totalEmployees) }}</div><div class="stat-note">Currently active in the employee directory</div></article>
            <article class="stat"><div class="stat-top"><div class="stat-label">Present records</div><div class="stat-icon">✓</div></div><div class="stat-value">{{ number_format($totalPresent) }}</div><div class="stat-note">Matching attendance records in this period</div></article>
            <article class="stat"><div class="stat-top"><div class="stat-label">Checked out</div><div class="stat-icon blue">↗</div></div><div class="stat-value">{{ number_format($totalCheckedOut) }}</div><div class="stat-note">Records with a recorded check-out time</div></article>
            <article class="stat"><div class="stat-top"><div class="stat-label">Records in view</div><div class="stat-icon slate">▤</div></div><div class="stat-value">{{ number_format($totalRecords) }}</div><div class="stat-note">Matches the current date and search filters</div></article>
        </section>

        <section class="panel">
            <div class="panel-head"><div><h2>Filter records</h2><p>Choose a date range and optionally search by employee name or ID.</p></div></div>
            <div class="filter-body">
                <form method="GET" action="{{ route('reports.attendance') }}" class="filters">
                    <div class="field"><label for="from">From date</label><input class="control" type="date" id="from" name="from" value="{{ $from }}" required></div>
                    <div class="field"><label for="to">To date</label><input class="control" type="date" id="to" name="to" value="{{ $to }}" min="{{ $from }}" required></div>
                    <div class="field search-field"><label for="search">Employee name or ID</label><input class="control" type="search" id="search" name="search" value="{{ $search ?? '' }}" placeholder="e.g. EMP-001 or employee name" maxlength="100"></div>
                    <button class="btn btn-primary" type="submit">⌕ &nbsp; Apply filters</button>
                    <a class="btn btn-light" href="{{ route('reports.attendance') }}">Reset</a>
                </form>
            </div>
        </section>

        <section class="panel">
            <div class="table-head"><div><h2>Attendance details</h2><p>Records for the selected reporting period.</p></div><div class="table-actions"><span class="record-count">{{ number_format($attendances->total()) }} {{ \Illuminate\Support\Str::plural('record', $attendances->total()) }}</span><form method="GET" action="{{ route('reports.attendance.export') }}"><input type="hidden" name="from" value="{{ $from }}"><input type="hidden" name="to" value="{{ $to }}"><input type="hidden" name="search" value="{{ $search ?? '' }}"><button type="submit" class="btn btn-export">↓ &nbsp; Export Excel</button></form></div></div>
            <div class="table-wrap"><table><thead><tr><th>Employee</th><th>Date</th><th>Check in</th><th>Check out</th><th>Status</th><th>Record</th></tr></thead><tbody>
                @forelse ($attendances as $attendance)
                    <tr>
                        <td><div class="employee-cell"><div class="mini-avatar">{{ strtoupper(substr($attendance->employee->name ?? 'N', 0, 1)) }}</div><div><div class="employee-name">{{ $attendance->employee->name ?? 'Employee unavailable' }}</div><div class="employee-id">{{ $attendance->employee->employee_id ?? '—' }}</div></div></div></td>
                        <td>{{ $attendance->date?->format('d M Y') ?? '—' }}</td>
                        <td>{{ $attendance->check_in ? \Illuminate\Support\Carbon::parse($attendance->check_in)->format('h:i A') : '—' }}</td>
                        <td>{{ $attendance->check_out ? \Illuminate\Support\Carbon::parse($attendance->check_out)->format('h:i A') : '—' }}</td>
                        <td><span class="status"><span class="status-dot"></span>{{ $attendance->status }}</span></td>
                        <td><span class="status {{ $attendance->check_out ? '' : 'pending' }}">{{ $attendance->check_out ? 'Completed' : 'Open' }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty">No attendance records match these filters.<br><span style="display:inline-block;margin-top:7px">Try a wider date range or clear the employee search.</span></td></tr>
                @endforelse
            </tbody></table></div>
            <div class="table-footer"><span>Showing {{ $attendances->firstItem() ?? 0 }}–{{ $attendances->lastItem() ?? 0 }} of {{ number_format($attendances->total()) }} records</span><div class="pagination">{{ $attendances->links() }}</div></div>
        </section>

        <div class="footnote">IntelliDesk &copy; {{ now()->year }} &nbsp;·&nbsp; Attendance reporting</div>
    </div>
</main>
</body>
</html>
