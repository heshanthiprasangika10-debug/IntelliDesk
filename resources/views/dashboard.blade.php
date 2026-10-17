<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IntelliDesk | Dashboard</title>
</head>
<body>
    <main>
        <h1>Welcome, {{ auth()->user()->name }}</h1>
        <p>You are signed in to IntelliDesk.</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Sign out</button>
        </form>
    </main>
</body>
</html>
