{{-- resources/views/components/login-admin.blade.php --}}

@props([
    'action' => route('admin.login.submit'),
])

<div class="login-wrapper">
    <div class="login-card">
        <div class="brand">
            <div class="brand-icon" aria-hidden="true">⚡</div>
            <div>
                <div class="brand-title">JIRAMA</div>
                <div class="brand-subtitle">VoltaRéseau</div>
            </div>
        </div>

        <div class="login-header">
            <span class="badge">Espace professionnel</span>
            <h1>Connexion administrateur</h1>
            <p>
                Accédez à votre espace de traitement des dossiers.
            </p>
        </div>

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                <strong>Connexion impossible</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ $action }}">
            @csrf

            <div class="form-group">
               <label for="email">Adresse e-mail professionnelle</label>
<input
    id="email"
    type="email"
    name="email"
    value="{{ old('email') }}"
    placeholder="nom@jirama.mg"
    autocomplete="username"
    required
>
                @error('identifiant')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Votre mot de passe"
                    autocomplete="current-password"
                    required
                >
                @error('password')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                Se connecter
            </button>
        </form>

        <div class="login-footer">
            <span>Accès réservé au personnel autorisé</span>
        </div>
    </div>
</div>
