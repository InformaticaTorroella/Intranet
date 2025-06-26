<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-title">Intranet Torroella de Montgrí</div>
    <div class="login-container">
        @if(session('success'))
            <div class="login-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="login-error" style="margin-top:15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="text" name="username" placeholder="Usuario" required autofocus>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
    @if(session()->has('username'))
        {{ session('username') }}
    @endif
</body>
</html>
