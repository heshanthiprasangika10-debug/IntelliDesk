<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Dashboard | IntelliDesk</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f8f6;
            color: #24352b;
        }

        .header {
            background: #ffffff;
            padding: 20px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2ebe5;
        }

        .brand {
            color: #16834a;
            font-size: 24px;
            font-weight: bold;
        }

        .user-info {
            font-size: 14px;
            color: #526357;
        }

        .container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 22px;
        }

        .welcome {
            margin-bottom: 28px;
        }

        .welcome h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #68796e;
            line-height: 1.6;
        }

        .section-title {
            font-size: 19px;
            margin-bottom: 16px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border: 1px solid #e1ebe4;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(30, 70, 45, 0.04);
        }

        .card-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e7f6ec;
            border-radius: 10px;
            color: #16834a;
            font-size: 23px;
            margin-bottom: 18px;
        }

        .card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card p {
            color: #68796e;
            font-size: 14px;
            line-height: 1.6;
            min-height: 45px;
            margin-bottom: 20px;
        }

        .card a {
            display: inline-block;
            text-decoration: none;
            background: #16834a;
            color: white;
            padding: 10px 16px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: bold;
        }

        .card a:hover {
            background: #116b3b;
        }

        .profile {
            margin-top: 28px;
            background: white;
            border: 1px solid #e1ebe4;
            border-radius: 12px;
            padding: 24px;
        }

        .profile h2 {
            font-size: 18px;
            margin-bottom: 16px;
        }

        .profile p {
            margin: 10px 0;
            color: #526357;
            overflow-wrap: anywhere;
        }

        .profile strong {
            color: #24352b;
        }

        .logout {
            border: none;
            background: #ffffff;
            color: #16834a;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .footer {
            text-align: center;
            padding: 25px;
            color: #829087;
            font-size: 13px;
        }

        @media (max-width: 750px) {
            .cards {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 18px 22px;
                gap: 15px;
                flex-wrap: wrap;
            }

            .welcome h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="brand">IntelliDesk</div>

        <div class="user-info">
            {{ auth()->user()->name }}

            &nbsp; | &nbsp;

            <form action="{{ route('logout') }}"
                  method="POST"
                  style="display:inline;">
                @csrf
                <button type="submit" class="logout">Logout</button>
            </form>
        </div>
    </header>

    <main class="container">

        <section class="welcome">
            <h1>Welcome, {{ auth()->user()->name }}!</h1>

            <p>
                Welcome to your employee workspace.
                Manage your attendance, leave requests and helpdesk
                from one place.
            </p>
        </section>

        <h2 class="section-title">My Workspace</h2>

        <section class="cards">

            <div class="card">
                <div class="card-icon">◷</div>

                <h3>My Attendance</h3>

                <p>
                    Access the attendance page to manage
                    your daily check-in and check-out.
                </p>

                <a href="{{ route('attendance.index') }}">
                    View Attendance
                </a>
            </div>

            <div class="card">
                <div class="card-icon">✓</div>

                <h3>Leave Requests</h3>

                <p>
                    Submit a leave request and access
                    the leave request section.
                </p>

                <a href="{{ route('leave-requests.index') }}">
                    Manage Requests
                </a>
            </div>

            <div class="card">
                <div class="card-icon">?</div>

                <h3>Helpdesk</h3>

                <p>
                    Get assistance with IntelliDesk and
                    ask questions about using the system.
                </p>

                <a href="{{ route('helpdesk') }}">
                    Open Helpdesk
                </a>
            </div>

        </section>

        <section class="profile">
            <h2>My Account</h2>

            <p>
                <strong>Name:</strong>
                {{ auth()->user()->name }}
            </p>

            <p>
                <strong>Email:</strong>
                {{ auth()->user()->email }}
            </p>

            <p>
                <strong>Role:</strong>
                Employee
            </p>
        </section>

    </main>

    <footer class="footer">
        IntelliDesk Employee Workspace
    </footer>

</body>
</html>
