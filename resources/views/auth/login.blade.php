<!-- @extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-form">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="text" name="username" placeholder="Gebruikersnaam" required>
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <button type="submit">Inloggen</button>
        </form>
    </div>
</div>
@endsection
 -->
