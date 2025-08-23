<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>

@if($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="login">
    @csrf
    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>

<a href="register">Register</a>
</body>
</html>
