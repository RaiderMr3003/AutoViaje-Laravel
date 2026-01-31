<h1>Login</h1>

<form method="POST" action="/login">
    @csrf

    <input name="username" placeholder="Usuario">
    <input name="password" type="password" placeholder="Contraseña">

    <button type="submit">Ingresar</button>

    @error('username')
        <div>{{ $message }}</div>
    @enderror
</form>
