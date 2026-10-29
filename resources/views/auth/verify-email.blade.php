
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vérification e-mail | VoltaRéseau</title>

    <style>
        :root {
            --vr-blue: #123b68;
            --vr-blue-dark: #0b2848;
            --vr-orange: #f59e0b;
            --vr-bg: #f3f6fa;
            --vr-text: #263548;
            --vr-muted: #718096;
            --vr-border: #e2e8f0;
            --vr-white: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--vr-text);
            background: var(--vr-bg);
        }

        /* En-tête */
        .vr-header {
            background: var(--vr-white);
            border-bottom: 1px solid var(--vr-border);
            padding: 18px 7%;
        }

        .vr-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--vr-blue);
            font-size: 21px;
            font-weight: 800;
            text-decoration: none;
        }

        .vr-logo {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--vr-blue);
            color: white;
            border-radius: 12px;
            font-size: 22px;
        }

        .vr-brand span small {
            display: block;
            margin-top: 4px;
            color: var(--vr-muted);
            font-size: 11px;
            font-weight: 500;
        }

        /* Contenu principal */
        .vr-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 45px 20px;
        }

        .vr-card {
            width: 100%;
            max-width: 510px;
            padding: 42px;
            background: var(--vr-white);
            border: 1px solid var(--vr-border);
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(18, 59, 104, 0.08);
            text-align: center;
        }

        .vr-icon {
            width: 82px;
            height: 82px;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #fff4df;
            color: var(--vr-blue);
        }

        .vr-icon svg {
            width: 39px;
            height: 39px;
        }

        .vr-badge {
            display: inline-block;
            margin-bottom: 15px;
            padding: 7px 13px;
            border-radius: 30px;
            background: #eaf1f9;
            color: var(--vr-blue);
            font-size: 12px;
            font-weight: 700;
        }

        .vr-card h1 {
            margin-bottom: 15px;
            color: var(--vr-blue-dark);
            font-size: 27px;
            line-height: 1.35;
        }

        .vr-description {
            margin-bottom: 25px;
            color: var(--vr-muted);
            font-size: 15px;
            line-height: 1.8;
        }

        .vr-notice {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 25px;
            padding: 15px;
            border: 1px solid #b8e7c7;
            border-radius: 10px;
            background: #effbf3;
            color: #176534;
            font-size: 14px;
            line-height: 1.6;
            text-align: left;
        }

        .vr-notice svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .vr-actions {
            display: flex;
            flex-direction: column;
            gap: 13px;
        }

        .vr-button {
            width: 100%;
            min-height: 49px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 13px 18px;
            border: 0;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .vr-button:hover {
            transform: translateY(-1px);
        }

        .vr-button-primary {
            background: var(--vr-blue);
            color: var(--vr-white);
        }

        .vr-button-primary:hover {
            background: var(--vr-blue-dark);
        }

        .vr-button-secondary {
            background: #fff7e8;
            color: #9a5a00;
            border: 1px solid #f7d69b;
        }

        .vr-button-secondary:hover {
            background: #ffedc9;
        }

        .vr-help {
            margin-top: 24px;
            color: var(--vr-muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .vr-help strong {
            color: var(--vr-blue);
        }

        /* Pied de page */
        .vr-footer {
            padding: 20px;
            color: var(--vr-muted);
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 600px) {
            .vr-header {
                padding: 15px 20px;
            }

            .vr-brand {
                font-size: 18px;
            }

            .vr-card {
                padding: 30px 22px;
                border-radius: 15px;
            }

            .vr-card h1 {
                font-size: 23px;
            }

            .vr-description {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <header class="vr-header">
        <a href="{{ url('/') }}" class="vr-brand">
            <span class="vr-logo" aria-hidden="true">⚡</span>

            <span>
                VoltaRéseau
                <small>Plateforme de demande de branchement neuf</small>
            </span>
        </a>
    </header>

    <main class="vr-main">
        <section class="vr-card">

            <div class="vr-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.7"
                     stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                    <path d="m3 7 9 6 9-6"/>
                    <circle cx="18" cy="17" r="4" fill="#fff4df"/>
                    <path d="m16.5 17 1 1 2-2"/>
                </svg>
            </div>

            <span class="vr-badge">SÉCURISATION DU COMPTE</span>

            <h1>Vérifiez votre adresse e-mail</h1>

            <p class="vr-description">
                Merci d'avoir créé votre compte VoltaRéseau.
                Pour sécuriser votre espace client et poursuivre
                votre démarche de branchement, veuillez confirmer
                votre adresse e-mail en cliquant sur le lien reçu.
            </p>

            @if (session('status') === 'verification-link-sent')
                <div class="vr-notice" role="status">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <path d="m9 11 3 3L22 4"/>
                    </svg>

                    <span>
                        Un nouveau lien de vérification a été envoyé.
                        Consultez votre boîte e-mail.
                    </span>
                </div>
            @endif

            @if (session('success'))
                <div class="vr-notice" role="status">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="vr-notice" role="alert"
                     style="background:#fff1f1;border-color:#fecaca;color:#991b1b;">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="vr-actions">

                <form method="POST"
                      action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit"
                            class="vr-button vr-button-primary">
                        Renvoyer le lien de vérification
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="vr-button vr-button-secondary">
                        Se déconnecter
                    </button>
                </form>

            </div>

            <p class="vr-help">
                Vous ne trouvez pas l'e-mail ?
                Vérifiez votre dossier <strong>Spam</strong>
                ou courrier indésirable.
            </p>

        </section>
    </main>

    <footer class="vr-footer">
        &copy; {{ date('Y') }} VoltaRéseau.
        Tous droits réservés.
    </footer>

</body>
</html>
