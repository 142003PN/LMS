<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h1>
    <p>You are signed in as {{ str_replace('_', ' ', auth()->user()->role) }}.</p>
    <p>Your dashboard is not available yet.</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Log out</button>
    </form>
</body>
</html>
