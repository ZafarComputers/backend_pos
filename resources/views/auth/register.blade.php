<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>

    @if ($errors->any())
        <div>
            <strong>Whoops! Something went wrong.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/register') }}">
        @csrf

        <label>First Name:</label>
        <input type="text" name="first_name" value="{{ old('first_name') }}" required><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" value="{{ old('last_name') }}" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
