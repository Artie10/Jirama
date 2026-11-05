{{-- resources/views/components/login-admin.blade.php --}}

@props([
    'action' => route('admin.login.submit'),
])

<link rel="stylesheet" href="{{ asset('css/loginAdmin.css') }}">

<div class="login-wrapper">
    <div class="login-card">

        {{-- Panneau de marque --}}
        <aside class="brand-panel">
            <div class="brand">
                <div class="brand-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 2 5 13.2h5.6L9.5 22 19 9.8h-5.7L13.5 2Z"/></svg>
                </div>
                <div>
                    <div class="brand-title">JIRAMA</div>
                    <div class="brand-subtitle">VoltaRéseau</div>
                </div>
            </div>

            <div class="brand-message">
                <h2>Suivi et traitement des dossiers de raccordement</h2>
                <p>
                    Instruisez les demandes, suivez leur avancement et coordonnez
                    les interventions depuis un seul espace.
                </p>
            </div>
        </aside>

        {{-- Formulaire --}}
        <main class="form-panel">
            <div class="login-header">
                <span class="badge">Espace professionnel</span>
                <h1>Connexion administrateur</h1>
                <p>Saisissez vos identifiants pour accéder à la gestion des dossiers.</p>
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
                    <div class="input-wrap">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Votre mot de passe"
                            autocomplete="current-password"
                            required
                        >
                        <button
                            type="button"
                            class="toggle-password"
                            aria-controls="password"
                            aria-label="Afficher le mot de passe"
                            onclick="
                                const i = document.getElementById('password');
                                const show = i.type === 'password';
                                i.type = show ? 'text' : 'password';
                                this.textContent = show ? 'Masquer' : 'Afficher';
                                this.setAttribute('aria-label', show ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
                            "
                        >Afficher</button>
                    </div>
                    @error('password')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    Se connecter
                </button>
            </form>

            <div class="login-footer">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>
                <span>Accès réservé au personnel autorisé de la JIRAMA. Les connexions sont enregistrées.</span>
            </div>
        </main>

    </div>
</div>
