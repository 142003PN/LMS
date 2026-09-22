<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/style.css')
</head>
<body class="login-page">
    <div class="login-container">
        <h2>Login</h2>
        @if ($errors->any())
            <div role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="form-group">
                <label for="id">User ID:</label>
                <input type="text" id="id" name="id" value="{{ old('id') }}" inputmode="numeric" autocomplete="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" autocomplete="current-password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
