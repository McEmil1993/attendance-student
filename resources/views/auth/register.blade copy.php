<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>Register</h2>

@if($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/register">
    @csrf

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required><br>

    <!-- Fixed position as instructor (readonly) -->
    <label>Position:</label><br>
    <input type="text" name="position" value="instructor" readonly><br>

    <label>Department:</label><br>
    <input type="text" name="department" value="{{ old('department') }}"><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br>

    <label>Confirm Password:</label><br>
    <input type="password" name="password_confirmation" required><br>

    <button type="submit">Register</button>
</form>

<a href="/login">Login</a>
</body>
</html>
