<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IntelliDesk | Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f7f5;
            color: #1f2937;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #0f5132;
            color: white;
            padding: 25px 18px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
            padding-left: 12px;
        }

        .logo span {
            color: #b7e4c7;
        }

        .menu-title {
            font-size: 12px;
            color: #b7d8c5;
            text-transform: uppercase;
            margin: 0 12px 12px;
        }

        .menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px 12px;
            margin-bottom: 6px;
            border-radius: 8px;
        }

        .menu a:hover,
        .menu a.active {
            background: #198754;
        }

        .logout-form {
            margin-top: 30px;
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #dc3545;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-btn:hover {
            background: #bb2d3b;
        }

        /* Main */
        .main {
            flex: 1;
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 28px;
            color: #0f5132;
        }

        .user-info {
            background: white;
            padding: 10px 18px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        /* Welcome */
        .welcome {
            background: linear-gradient(135deg, #198754, #0f5132);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        .welcome h2 {
            margin-bottom: 8px;
            font-size: 25px;
        }

        .welcome p {
            color: #e1f5e9;
        }

        /* Cards */
        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .card h3 {
            font-size: 15px;
            color: #6b7280;
            margin-bottom: 12px;
        }

        .card .number {
            font-size: 28px;
            font-weight: bold;
            color: #198754;
        }

        /* Quick actions */
        .section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .section h2 {
            margin-bottom: 20px;
            color: #0f5132;
        }

        .actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .action {
            padding: 20px;
            border: 1px solid #dfe7e2;
            border-radius: 10px;
            text-decoration: none;
            color: #198754;
            font-weight: bold;
            text-align: center;
        }

        .action:hover {
            background: #eaf7ef;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .actions {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                width: 190px;
            }

            .main {
                padding: 20px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .topbar {
                display: block;
            }

            .user-info {
                margin-top: 15px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- Sidebar -->
    <aside class="sidebar">

        <div class="logo">
            Intelli<span>Desk</span>
        </div>

        <div class="menu-title">
            Main Menu
        </div>

        <nav class="menu">

            <a href="{{ route('dashboard') }}" class="active">
                🏠 Dashboard
            </a>

            <a href="#">
                👥 Employees
            </a>

            <a href="#">
                🕒 Attendance
            </a>

            <a href="#">
                📊 Reports
            </a>

            <a href="#">
                💬 Chatbot
            </a>

        </nav>

        <form method="POST"
              action="{{ route('logout') }}"
              class="logout-form">

            @csrf

            <button type="submit" class="logout-btn">
                Sign Out
            </button>

        </form>

    </aside>


    <!-- Main Content -->
    <main class="main">

        <!-- Top Bar -->
        <div class="topbar">

            <div>
                <h1>Dashboard</h1>
                <p>IntelliDesk Management System</p>
            </div>

            <div class="user-info">
                👤 {{ auth()->user()->name }}
            </div>

        </div>


        <!-- Welcome -->
        <section class="welcome">

            <h2>
                Welcome, {{ auth()->user()->name }} 👋
            </h2>

            <p>
                Manage employees, attendance and reports from your IntelliDesk dashboard.
            </p>

        </section>


        <!-- Statistics -->
        <section class="cards">

            <div class="card">
                <h3>Total Employees</h3>
                <div class="number">0</div>
            </div>

            <div class="card">
                <h3>Present Today</h3>
                <div class="number">0</div>
            </div>

            <div class="card">
                <h3>Absent Today</h3>
                <div class="number">0</div>
            </div>

            <div class="card">
                <h3>Reports</h3>
                <div class="number">0</div>
            </div>

            
        </section>


        <!-- Quick Actions -->
        <section class="section">

            <h2>Quick Actions</h2>

            <div class="actions">

                <a href="#" class="action">
                    👥 Manage Employees
                </a>

                <a href="#" class="action">
                    🕒 View Attendance
                </a>

                <a href="#" class="action">
                    📊 Generate Report
                </a>

            </div>

        </section>

    </main>

</div>

</body>
</html>
