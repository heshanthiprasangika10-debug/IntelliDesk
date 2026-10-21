<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IntelliDesk | Register</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { min-height: 100vh; display: grid; place-items: center; margin: 0; padding: 20px; background: #f3f7f4; }
        main { width: 100%; max-width: 460px; padding: 40px; background: #fff; border-radius: 16px; box-shadow: 0 12px 40px rgba(0, 0, 0, .08); }
        h1 { margin-top: 0; color: #137547; }
        label { display: block; margin: 18px 0 8px; color: #34463a; }
        input { width: 100%; padding: 13px; border: 1px solid #dce5de; border-radius: 8px; }
        button { width: 100%; margin-top: 24px; padding: 14px; border: 0; border-radius: 8px; background: #137547; color: #fff; font-size: 16px; font-weight: bold; cursor: pointer; }
        .error { color: #a12622; }
    </style>
</head>
<body>
    <main>
        <h1>Create your account</h1>
        <p>Join IntelliDesk to access your workspace.</p>

        @if ($errors->any())
            <div class="error" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required>

            <label for="email">Email Address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required>

            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>

            <button type="submit">Create Account</button>
        </form>

        <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
    </main>
</body>
</html>
