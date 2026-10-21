<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | IntelliDesk</title>
    <style>
        :root{--navy:#172b4d;--navy-2:#213a61;--green:#198754;--green-dark:#146c43;--green-soft:#e8f5ee;--ink:#202b3c;--muted:#758195;--line:#e7ebf1;--page:#f5f7fb;--white:#fff;--red:#d9485f;--amber:#b7791f;--blue:#3867d6;--shadow:0 8px 24px rgba(25,42,70,.05)}
        *{box-sizing:border-box}body{margin:0;background:var(--page);color:var(--ink);font-family:Inter,-apple-system,BlinkMacSystemFont,"Segoe UI",Arial,sans-serif;font-size:14px}a{color:inherit;text-decoration:none}button{font:inherit}
        .app{min-height:100vh}.sidebar{position:fixed;inset:0 auto 0 0;width:250px;background:var(--navy);color:#d9e3f2;padding:26px 16px;display:flex;flex-direction:column;z-index:5}.brand{display:flex;align-items:center;gap:11px;padding:0 12px 34px;font-size:20px;font-weight:750;letter-spacing:-.5px;color:#fff}.brand-mark{display:grid;place-items:center;width:36px;height:36px;background:#198754;border-radius:10px;color:#fff;font-weight:800;font-size:17px}.brand span{color:#9fdbbb}.nav-caption{padding:0 12px 11px;color:#91a3bf;text-transform:uppercase;font-size:10px;letter-spacing:1.4px;font-weight:700}.nav{display:grid;gap:5px}.nav a{display:flex;align-items:center;gap:13px;padding:12px 13px;border-radius:9px;color:#c9d5e7;font-weight:550;transition:background .15s,color .15s}.nav a:hover{background:rgba(255,255,255,.08);color:#fff}.nav a.active{background:var(--green);color:#fff;box-shadow:0 5px 14px rgba(25,135,84,.25)}.nav-icon{width:19px;text-align:center;font-size:16px}.sidebar-bottom{margin-top:auto}.help-card{padding:15px;border:1px solid rgba(255,255,255,.12);border-radius:11px;background:rgba(255,255,255,.04);margin:0 3px 18px}.help-card strong{display:block;color:#fff;margin-bottom:5px;font-size:12px}.help-card p{margin:0;color:#9eafc8;font-size:11px;line-height:1.55}.logout-form{padding:0 3px}.logout-btn{width:100%;border:1px solid rgba(255,255,255,.16);background:transparent;color:#e1e8f2;padding:11px 12px;border-radius:8px;text-align:left;cursor:pointer}.logout-btn:hover{background:rgba(255,255,255,.08)}
        .main{margin-left:250px;min-height:100vh}.topbar{height:76px;background:#fff;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 34px;gap:20px}.breadcrumb{color:var(--muted);font-size:12px}.breadcrumb strong{color:var(--ink);font-weight:650}.topbar-right{display:flex;align-items:center;gap:18px}.today{color:var(--muted);font-size:12px}.profile{display:flex;align-items:center;gap:10px;border-left:1px solid var(--line);padding-left:18px}.avatar{display:grid;place-items:center;width:36px;height:36px;border-radius:50%;background:#e5f4eb;color:var(--green-dark);font-weight:750}.profile-name{font-weight:650;font-size:12px}.profile-role{color:var(--muted);font-size:11px;margin-top:3px}.content{max-width:1500px;margin:0 auto;padding:32px 34px 40px}.page-heading{display:flex;justify-content:space-between;align-items:flex-end;gap:18px;margin-bottom:26px}.eyebrow{color:var(--green);font-size:11px;font-weight:750;text-transform:uppercase;letter-spacing:1.4px;margin-bottom:8px}.page-heading h1{font-size:28px;letter-spacing:-.8px;margin:0 0 8px;font-weight:750;color:#1d2a3d}.page-heading p{margin:0;color:var(--muted);font-size:13px}.date-chip{background:#fff;border:1px solid var(--line);border-radius:9px;padding:10px 13px;color:#526078;font-size:12px;white-space:nowrap}
        .welcome{display:flex;align-items:center;justify-content:space-between;gap:20px;padding:24px 26px;background:linear-gradient(110deg,#fff 0%,#f0f8f3 100%);border:1px solid #dfeee5;border-radius:14px;margin-bottom:23px}.welcome h2{font-size:19px;margin:0 0 8px;letter-spacing:-.35px}.welcome p{margin:0;color:#6b788b;line-height:1.6}.welcome-mark{width:54px;height:54px;border-radius:14px;display:grid;place-items:center;background:#d9f0e2;color:var(--green-dark);font-size:24px;flex-shrink:0}
        .stats{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:17px;margin-bottom:24px}.stat{background:#fff;border:1px solid var(--line);border-radius:13px;padding:20px 20px 17px;box-shadow:var(--shadow);min-width:0}.stat-top{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:17px}.stat-label{font-size:12px;color:#6d798b;font-weight:600}.stat-icon{width:36px;height:36px;display:grid;place-items:center;border-radius:10px;background:#edf7f1;color:var(--green);font-size:17px}.stat-icon.blue{background:#edf2ff;color:var(--blue)}.stat-icon.red{background:#fff0f1;color:var(--red)}.stat-icon.amber{background:#fff7e8;color:var(--amber)}.stat-value{font-size:30px;line-height:1.1;font-weight:760;letter-spacing:-1px;color:#1e2b3d}.stat-note{font-size:11px;color:var(--muted);margin-top:11px}.stat-note strong{color:var(--green-dark);font-weight:700}.rate-track{height:5px;border-radius:10px;background:#e9edf2;overflow:hidden;margin-top:14px}.rate-fill{height:100%;border-radius:10px;background:var(--green)}
        .panel{background:#fff;border:1px solid var(--line);border-radius:13px;box-shadow:var(--shadow);overflow:hidden}.panel-head{display:flex;justify-content:space-between;align-items:center;gap:15px;padding:21px 23px;border-bottom:1px solid var(--line)}.panel-head h2{margin:0 0 5px;font-size:15px;font-weight:750;letter-spacing:-.2px}.panel-head p{margin:0;color:var(--muted);font-size:12px}.text-link{font-size:12px;color:var(--green-dark);font-weight:700;white-space:nowrap}.text-link:hover{text-decoration:underline}.table-wrap{overflow-x:auto}table{border-collapse:collapse;width:100%;min-width:720px}thead th{text-align:left;padding:13px 22px;background:#fafbfd;color:#7c8798;font-size:10px;text-transform:uppercase;letter-spacing:.7px;font-weight:750;border-bottom:1px solid var(--line)}tbody td{padding:15px 22px;border-bottom:1px solid #eff2f6;font-size:12px;color:#4c586a}tbody tr:last-child td{border-bottom:0}tbody tr:hover{background:#fcfdfd}.employee-cell{display:flex;align-items:center;gap:10px}.mini-avatar{width:32px;height:32px;border-radius:9px;background:#edf3f8;color:#415a77;display:grid;place-items:center;font-weight:750;font-size:11px;flex-shrink:0}.employee-name{font-weight:650;color:#263449;font-size:12px}.employee-id{font-size:11px;color:#8993a2;margin-top:3px}.status{display:inline-flex;align-items:center;gap:6px;padding:5px 9px;border-radius:20px;font-size:10px;font-weight:750;background:#e8f6ee;color:#187747}.status.pending{background:#fff5df;color:#986515}.status.neutral{background:#edf1f6;color:#667386}.status-dot{width:5px;height:5px;border-radius:50%;background:currentColor}.empty{padding:35px 20px;text-align:center;color:var(--muted)}.bottom-grid{display:grid;grid-template-columns:1.3fr 1fr;gap:18px;margin-top:22px}.quick-panel{padding:22px}.quick-panel h2{font-size:15px;margin:0 0 6px}.quick-panel>p{font-size:12px;color:var(--muted);margin:0 0 18px}.quick-actions{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px}.quick-action{border:1px solid var(--line);border-radius:10px;padding:16px 13px;transition:border-color .15s,transform .15s}.quick-action:hover{border-color:#9fcfb3;transform:translateY(-1px)}.quick-action .qa-icon{display:grid;place-items:center;width:33px;height:33px;border-radius:9px;background:var(--green-soft);color:var(--green-dark);font-size:15px;margin-bottom:12px}.quick-action strong{display:block;font-size:12px;margin-bottom:5px}.quick-action span{display:block;color:var(--muted);font-size:11px;line-height:1.45}.footnote{margin-top:20px;text-align:center;color:#99a2af;font-size:10px}
        @media(max-width:1150px){.sidebar{width:220px}.main{margin-left:220px}.stats{grid-template-columns:repeat(2,minmax(0,1fr))}.content{padding:26px 24px}.topbar{padding:0 24px}.bottom-grid{grid-template-columns:1fr}}
        @media(max-width:760px){.sidebar{position:static;width:auto;min-height:auto;padding:16px}.brand{padding:0 8px 16px}.nav-caption,.sidebar-bottom{display:none}.nav{grid-template-columns:repeat(2,minmax(0,1fr))}.nav a{padding:10px;font-size:12px}.main{margin-left:0}.topbar{height:auto;min-height:64px;padding:14px 18px}.today{display:none}.content{padding:22px 16px}.page-heading{align-items:flex-start;flex-direction:column}.welcome{padding:20px}.quick-actions{grid-template-columns:1fr}.quick-action{display:flex;align-items:center;gap:12px}.quick-action .qa-icon{margin:0;flex-shrink:0}.quick-action span{margin-top:3px}}
        @media(max-width:450px){.stats{grid-template-columns:1fr}.topbar-right{gap:0}.profile{padding-left:10px}.profile-name{max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.page-heading h1{font-size:24px}}
    </style>
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <a class="brand" href="{{ route('dashboard') }}"><span class="brand-mark">I</span><span style="color:#fff">Intelli<span>Desk</span></span></a>
        <div class="nav-caption">Workspace</div>
        <nav class="nav" aria-label="Main navigation">
            <a class="active" href="{{ route('dashboard') }}"><span class="nav-icon">▦</span> Dashboard</a>
            <a href="{{ route('employees.index') }}"><span class="nav-icon">♙</span> Employees</a>
            <a href="{{ route('attendance.index') }}"><span class="nav-icon">◷</span> Attendance</a>
            <a href="{{ route('reports.attendance') }}"><span class="nav-icon">▤</span> Reports</a>
        </nav>
        <div class="sidebar-bottom">
            <div class="help-card"><strong>IntelliDesk Workspace</strong><p>Employee operations, attendance tracking and reporting in one place.</p></div>
            <form class="logout-form" method="POST" action="{{ route('logout') }}">@csrf<button class="logout-btn" type="submit">↪ &nbsp; Sign out</button></form>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div class="breadcrumb">Workspace &nbsp; / &nbsp; <strong>Dashboard</strong></div>
            <div class="topbar-right">
                <div class="today">{{ now()->format('l, d F Y') }}</div>
                <div class="profile"><div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div><div><div class="profile-name">{{ auth()->user()->name }}</div><div class="profile-role">Workspace account</div></div></div>
            </div>
        </header>

        <div class="content">
            <div class="page-heading">
                <div><div class="eyebrow">Overview</div><h1>Dashboard</h1><p>Here is what is happening across your workforce today.</p></div>
                <div class="date-chip">◷ &nbsp; {{ now()->format('D, d M Y') }}</div>
            </div>

            <section class="welcome">
                <div><h2>Good day, {{ auth()->user()->name }}.</h2><p>Keep employee information up to date and review today's attendance at a glance.</p></div>
                <div class="welcome-mark">✓</div>
            </section>

            <section class="stats" aria-label="Workforce statistics">
                <article class="stat"><div class="stat-top"><div class="stat-label">Total employees</div><div class="stat-icon">♙</div></div><div class="stat-value">{{ number_format($employeeCount) }}</div><div class="stat-note">{{ number_format($totalActiveEmployees) }} active employees</div></article>
                <article class="stat"><div class="stat-top"><div class="stat-label">Present today</div><div class="stat-icon">✓</div></div><div class="stat-value">{{ number_format($presentToday) }}</div><div class="stat-note"><strong>{{ number_format($attendanceRate) }}%</strong> of active workforce checked in</div><div class="rate-track"><div class="rate-fill" style="width: {{ min($attendanceRate, 100) }}%"></div></div></article>
                <article class="stat"><div class="stat-top"><div class="stat-label">Not checked in</div><div class="stat-icon red">◷</div></div><div class="stat-value">{{ number_format($absentToday) }}</div><div class="stat-note">Active employees without a record today</div></article>
                <article class="stat"><div class="stat-top"><div class="stat-label">Attendance records</div><div class="stat-icon blue">▤</div></div><div class="stat-value">{{ number_format($attendanceRecordCount) }}</div><div class="stat-note">{{ number_format($checkedOutToday) }} checked out today</div></article>
            </section>

            <section class="panel">
                <div class="panel-head"><div><h2>Recent attendance activity</h2><p>Latest records captured in the attendance system.</p></div><a class="text-link" href="{{ route('attendance.index') }}">View attendance &rarr;</a></div>
                <div class="table-wrap"><table><thead><tr><th>Employee</th><th>Date</th><th>Check in</th><th>Check out</th><th>Status</th></tr></thead><tbody>
                    @forelse($recentAttendances as $attendance)
                        <tr><td><div class="employee-cell"><div class="mini-avatar">{{ strtoupper(substr($attendance->employee->name ?? 'N', 0, 1)) }}</div><div><div class="employee-name">{{ $attendance->employee->name ?? 'Employee unavailable' }}</div><div class="employee-id">{{ $attendance->employee->employee_id ?? '—' }}</div></div></div></td><td>{{ $attendance->date?->format('d M Y') ?? '—' }}</td><td>{{ $attendance->check_in ? \Illuminate\Support\Carbon::parse($attendance->check_in)->format('h:i A') : '—' }}</td><td>{{ $attendance->check_out ? \Illuminate\Support\Carbon::parse($attendance->check_out)->format('h:i A') : '—' }}</td><td><span class="status"><span class="status-dot"></span>{{ $attendance->check_out ? 'Completed' : 'Present' }}</span></td></tr>
                    @empty
                        <tr><td colspan="5" class="empty">No attendance activity yet. Check in an employee to see records here.</td></tr>
                    @endforelse
                </tbody></table></div>
            </section>

            <div class="bottom-grid">
                <section class="panel quick-panel"><h2>Quick actions</h2><p>Common tasks for day-to-day workforce operations.</p><div class="quick-actions">
                    <a class="quick-action" href="{{ route('employees.index') }}"><span class="qa-icon">♙</span><span><strong>Manage employees</strong><span>View, add or update employee records.</span></span></a>
                    <a class="quick-action" href="{{ route('attendance.index') }}"><span class="qa-icon">◷</span><span><strong>Record attendance</strong><span>Check in and check out employees.</span></span></a>
                    <a class="quick-action" href="{{ route('reports.attendance') }}"><span class="qa-icon">▤</span><span><strong>Attendance reports</strong><span>Filter records and export to Excel.</span></span></a>
                </div></section>
                <section class="panel quick-panel"><h2>Attendance reporting</h2><p>Review attendance within a selected date range and export a spreadsheet for operational use.</p><a href="{{ route('reports.attendance') }}" style="display:inline-flex;align-items:center;gap:8px;background:var(--green);color:white;padding:11px 14px;border-radius:8px;font-weight:700;font-size:12px">Open reports <span>→</span></a><div class="footnote" style="text-align:left">Report totals are calculated from saved attendance records.</div></section>
            </div>
            <div class="footnote">IntelliDesk &copy; {{ now()->year }} &nbsp;·&nbsp; Workforce management</div>
        </div>
    </main>
</div>
</body>
</html>
