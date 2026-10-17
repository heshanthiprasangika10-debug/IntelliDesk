
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IntelliDesk | Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f3f7f4;
            padding: 20px;
        }

        .login-container {
            display: flex;
            width: 850px;
            max-width: 100%;
            min-height: 500px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        }

        .welcome-panel {
            flex: 1;
            background: #137547;
            color: white;
            padding: 55px 35px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .welcome-panel h1 {
            font-size: 32px;
            margin-bottom: 18px;
        }

        .welcome-panel p {
            line-height: 1.7;
            color: #e0f2e8;
        }

        .login-panel {
            flex: 1;
            padding: 55px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            color: #137547;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 35px;
        }

        .login-panel h2 {
            color: #24352b;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #78827b;
            margin-bottom: 28px;
            font-size: 14px;
        }

        label {
            display: block;
            color: #34463a;
            font-size: 14px;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 13px;
            margin-bottom: 20px;
            border: 1px solid #dce5de;
            border-radius: 8px;
            outline: none;
        }

        input:focus {
            border-color: #137547;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #137547;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #0e6039;
        }

        .note {
            text-align: center;
            color: #89928c;
            font-size: 12px;
            margin-top: 25px;
        }

        @media (max-width: 650px) {
            .login-container {
                flex-direction: column;
            }

            .welcome-panel {
                padding: 30px;
            }

            .login-panel {
                padding: 35px 25px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">

        <div class="welcome-panel">
            <h1>IntelliDesk</h1>
            <p>
                Smart Support. Simple Solutions.<br><br>
                Your AI-powered office helpdesk
                for managing employee requests,
                support tickets and knowledge.
            </p>
        </div>

        <div class="login-panel">
            <div class="logo">IntelliDesk.</div>

            <h2>Welcome Back!</h2>
            <p class="subtitle">Sign in to access your workspace.</p>

            @if (session('success'))
                <p role="status">{{ session('success') }}</p>
            @endif

            @if ($errors->any())
                <p role="alert">{{ $errors->first() }}</p>
            @endif

            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                >

                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >

                <button type="submit">Sign In</button>
            </form>

            <p class="note">New to IntelliDesk? <a href="{{ route('register') }}">Create an account</a></p>
            <p class="note">© 2026 IntelliDesk · Smart Employee Support</p>
        </div>

    </div>

</body>
</html>
