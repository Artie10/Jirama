<title>Portail Client - JIRAMA</title>
<section class="hero-client">
    <div class="hero-client-container">

        <div class="hero-client-content">

            <div class="hero-badge">
                <span class="hero-status-dot"></span>
                Service en ligne · JIRAMA
            </div>

            <h1>
                Votre branchement d'eau,
                <span>en toute simplicité.</span>
            </h1>

            <p class="hero-description">
                Bienvenue sur la Plateforme Nationale de Demande
                de Branchement Neuf en Eau de la JIRAMA.
                Effectuez votre demande en ligne, transmettez vos
                documents et suivez l'évolution de votre dossier
                depuis votre espace client.
            </p>

            <div class="hero-actions">

                <a href="#loginSection" class="hero-btn hero-btn-primary">
                    <i class="fa-solid fa-folder-open"></i>
                    Accéder à mon dossier
                </a>

                <a href="{{ route('demande.create') }}"
                   class="hero-btn hero-btn-secondary">
                    <i class="fa-solid fa-file-circle-plus"></i>
                    Effectuer une demande
                </a>

            </div>

            <div class="hero-features">
                <div class="hero-feature">
                    <span class="hero-feature-icon">
                        <i class="fa-solid fa-laptop"></i>
                    </span>
                    <div>
                        <strong>100 % en ligne</strong>
                        <small>Une démarche simplifiée</small>
                    </div>
                </div>

                <div class="hero-feature">
                    <span class="hero-feature-icon">
                        <i class="fa-solid fa-file-circle-check"></i>
                    </span>
                    <div>
                        <strong>Suivi de dossier</strong>
                        <small>Consultez son évolution</small>
                    </div>
                </div>
            </div>

        </div>

        <div class="hero-client-visual">
            <div class="hero-visual-circle"></div>

            <div class="hero-visual-card">
                <div class="hero-water-icon">
                    <i class="fa-solid fa-droplet"></i>
                </div>

                <span class="hero-visual-label">
                    VOTRE SERVICE PUBLIC
                </span>

                <h2>Un accès simplifié à l'eau</h2>

                <p>
                    Réalisez vos démarches à distance
                    et suivez votre demande étape par étape.
                </p>

                <div class="hero-visual-line"></div>

                <div class="hero-visual-footer">
                    <i class="fa-solid fa-shield-halved"></i>
                    Une plateforme dédiée aux demandeurs
                </div>
            </div>

            <div class="hero-floating-icon hero-floating-top">
                <i class="fa-solid fa-droplet"></i>
            </div>

            <div class="hero-floating-icon hero-floating-bottom">
                <i class="fa-solid fa-file-circle-check"></i>
            </div>
        </div>

    </div>
</section>

<section id="loginSection">
<div class="login">

    <!-- Partie description -->
    <div class="descr">

        <img class='logo' src="{{ asset('photos/Water.png') }}" alt="">

        <div class="titre">
            <span>Portail declaratif & Consultation</span>

        </div>

        <p class="description">
            Déposez votre demande de raccordement,
            suivez votre dossier en temps réel ou réalisez
            votre relevé de mesure géoréférencé sur site.
        </p>

    </div>



<!-- Formulaire de connexion -->
<form class="formulaire" method="POST" action="{{ route('client.login.submit') }}">
    @csrf

    <label for="reference">
        Référence dossier ou Courriel demandeur
    </label>

    <input
        type="text"
        id="reference"
        name="reference"
        value="{{ old('reference') }}"
        placeholder="Ex: RAC-2025-8842 ou client@domaine.com"
        required
    >

    @error('reference')
        <p class="msgError">{{ $message }}</p>
    @enderror

    <div class="password-label">
        <label for="password">Code d'accès sécurisé</label>
        <a href="#">Code oublié ?</a>
    </div>

    <input
        type="password"
        id="password"
        name="password"
        placeholder="••••••••"
        required
    >

    @error('password')
        <p class="msgError">{{ $message }}</p>
    @enderror

    @if (session('error'))
        <p class="msgError">{{ session('error') }}</p>
    @endif

    <button type="submit" class="btn-login">
        Accéder à mon espace client
    </button>
</form>

</section>
<style>
.entete {
    width: 100%;
    margin-right: 0%
    max-width: 950px;
    min-height: 100vh;
    padding-top: 100px;
    box-sizing: border-box;

    background:
        radial-gradient(
            circle at 75% 70%,
            rgba(20, 73, 130, 0.35),
            transparent 40%
        ),
        linear-gradient(
            115deg,
            #001326 0%,
            #061d3b 50%,
            #001326 100%
        );

    color: white;
    overflow: hidden;
    justify-content:center;
    display:flex;
    flex-direction:column;
    font-family: Arial, Helvetica, sans-serif;

}
.compEnt{
     margin-left:6%;
     animation: slideInUp 0.6s ease-out forwards;
}

.titre {
    display: flex;
    align-items: center;
    gap: 20px;
    margin: 5%;
    width: fit-content;
    padding: 10px 22px;

    border-radius: 35px;

    background: linear-gradient(
        90deg,
        #073b7d,
        #123f80
    );

    color: #b9ccec;

    font-size: 24px;
    font-weight: 60;
    letter-spacing: 1px;
}

.point {
    width: 16px;
    height: 28px;
    border-radius: 50%;
    background: #ff5b00;
}

.entete h1 {

  margin: 3%;
    font-size: 40px;
    line-height: 1.08;
    font-weight: 70;
}

.entete p{
    max-width: 850px;
  margin: 3%;
    margin-bottom: 0px;

    color: #e5e9f2;

    font-size: 18px;
    line-height: 1.65;
}
.btn-item {
  display: flex;
  gap: 1rem;
  margin-top: 2rem;
}
.btn {
  padding: 1rem 2rem;
  border: none;
  cursor: pointer;
  font-size: 1rem;
  font-weight: 600;
  transition: 0.3s;
    margin: 3%;
}

.btn-room {
  background: #17233b;
  color: #ff5b00;
}

.btn-room:hover {
  transform: translateY(-3px);
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background: #17233b;
    color: #17233b;
}

.login {
    width: 100%;
    max-width: 740px;
    margin: 40px auto;
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    animation: slideInUp 0.6s ease-out forwards;
}

/* Barre supérieure */
.login::before {
    content: "";
    display: block;
    height: 6px;
    background: linear-gradient(
        to right,
        #ff5a00,
        #ffb36b,
        #1268e8
    );
}

/* DESCRIPTION */

.descr {
    padding: 40px 50px 20px;
}

.logo {
    width: 70px;
    height: 50px;
    background: #f2f3f7;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    color: #ff6500;
    float: left;
    margin-right: 20px;
}

.titre span {
    color: #e86118;
    font-weight: bold;
    font-size: 20px;
    letter-spacing: 1px;
}

.titre h1 {
    font-size: 32px;
    line-height: 1.2;
    margin-top: 10px;
}

.description {
    clear: both;
    padding-top: 35px;
    font-size: 20px;
    line-height: 1.5;
    color: #555;
}


/* FORMULAIRE */

.formulaire {
    padding: 10px 50px 40px;
}
/* LABELS */

label {
    display: block;
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

input {
    width: 100%;
    height: 60px;
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 0 20px;
    font-size: 17px;
    margin-bottom: 25px;
    outline: none;
    background: white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
}

input:focus {
    border-color: #1268e8;
}


/* MOT DE PASSE */

.password-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.password-label a {
    color: #1268e8;
    font-weight: bold;
    text-decoration: none;
}
/* BOUTON PRINCIPAL */

.btn-login {
    width: 100%;
    height: 60px;
    border: none;
    border-radius: 8px;
    background: #062a57;
    color: white;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    margin-bottom: 10px;
}

.btn-login:hover {
    background: #06254b;
}


/* ASSISTANCE */
.assistance {
    background: #f1f2f6;
    padding: 25px 50px;
    display: flex;
    align-items: center;
    gap: 15px;
    font-size: 17px;
}

.assistance p {
    flex: 1;
}

.assistance span {
    color: #1268e8;
    font-size: 25px;
}


/* RESPONSIVE */

@media (max-width: 600px) {

    .login {
        margin: 0;
        border-radius: 0;
    }

    .descr,
    .formulaire {
        padding-left: 25px;
        padding-right: 25px;
    }

    .titre span {
        font-size: 16px;
    }

    .titre h1 {
        font-size: 27px;
    }

    .description {
        font-size: 17px;
    }

   .assistance {
        padding: 20px 25px;
        font-size: 14px;
    }
}

@keyframes slideInUp{
    from{
        opacity: 0;
        transform: translateY(30px);
    }
    to{
        opacity: 1;
        transform: translateY(0);
    }
}


/* ===== SECTION D'ACCUEIL JIRAMA ===== */

.hero-client {
    position: relative;
    overflow: hidden;
    padding: 90px 7%;
    background: linear-gradient(135deg, #f4f9ff 0%, #ffffff 55%, #eaf5ff 100%);
    font-family: Arial, Helvetica, sans-serif;
}

.hero-client::before {
    content: "";
    position: absolute;
    width: 420px;
    height: 420px;
    top: -220px;
    left: -130px;
    border-radius: 50%;
    background: rgba(16, 112, 210, 0.07);
}

.hero-client-container {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    align-items: center;
    gap: 65px;
    max-width: 1250px;
    margin: 0 auto;
}

.hero-client-content {
    max-width: 680px;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 10px 16px;
    margin-bottom: 25px;
    border: 1px solid #d6e8fa;
    border-radius: 30px;
    background: #ffffff;
    color: #1457a6;
    font-size: 13px;
    font-weight: 700;
    box-shadow: 0 5px 20px rgba(20, 87, 166, 0.05);
}

.hero-status-dot {
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: #19a974;
    box-shadow: 0 0 0 4px rgba(25, 169, 116, 0.12);
}

.hero-client h1 {
    margin: 0 0 22px;
    color: #102b4e;
    font-size: clamp(34px, 4.2vw, 56px);
    line-height: 1.16;
    font-weight: 800;
    letter-spacing: -1.5px;
}

.hero-client h1 span {
    display: block;
    color: #0875d1;
}

.hero-description {
    max-width: 590px;
    margin: 0;
    color: #62748a;
    font-size: 16px;
    line-height: 1.9;
}

.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    margin-top: 32px;
}

.hero-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    min-height: 52px;
    padding: 0 22px;
    border: 2px solid transparent;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    transition: transform 0.2s ease, box-shadow 0.2s ease,
                background 0.2s ease;
}

.hero-btn:hover {
    transform: translateY(-3px);
}

.hero-btn-primary {
    color: #ffffff;
    background: #0875d1;
    box-shadow: 0 9px 22px rgba(8, 117, 209, 0.2);
}

.hero-btn-primary:hover {
    color: #ffffff;
    background: #075eaa;
    box-shadow: 0 12px 25px rgba(8, 117, 209, 0.28);
}

.hero-btn-secondary {
    color: #0875d1;
    border-color: #b9d9f5;
    background: #ffffff;
}

.hero-btn-secondary:hover {
    color: #075eaa;
    border-color: #0875d1;
    background: #f3f9ff;
}

.hero-features {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    margin-top: 42px;
}

.hero-feature {
    display: flex;
    align-items: center;
    gap: 12px;
}

.hero-feature-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border-radius: 12px;
    color: #0875d1;
    background: #e4f2ff;
}

.hero-feature strong,
.hero-feature small {
    display: block;
}

.hero-feature strong {
    margin-bottom: 5px;
    color: #193957;
    font-size: 13px;
}

.hero-feature small {
    color: #7b8da2;
    font-size: 12px;
}

/* ===== CARTE VISUELLE ===== */

.hero-client-visual {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 400px;
}

.hero-visual-circle {
    position: absolute;
    width: min(360px, 90%);
    aspect-ratio: 1;
    border-radius: 50%;
    background: linear-gradient(145deg, #c8e7ff, #eaf6ff);
}

.hero-visual-card {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 340px;
    padding: 35px 30px;
    border: 1px solid rgba(255, 255, 255, 0.9);
    border-radius: 24px;
    background: rgba(255, 255, 255, 0.94);
    box-shadow: 0 25px 70px rgba(27, 81, 133, 0.14);
}

.hero-water-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 65px;
    height: 65px;
    margin-bottom: 25px;
    border-radius: 20px;
    color: #ffffff;
    background: linear-gradient(145deg, #168be8, #0759b4);
    font-size: 28px;
}

.hero-visual-label {
    color: #0875d1;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.hero-visual-card h2 {
    margin: 13px 0;
    color: #102b4e;
    font-size: 25px;
    line-height: 1.35;
}

.hero-visual-card p {
    margin: 0;
    color: #708198;
    font-size: 13px;
    line-height: 1.8;
}

.hero-visual-line {
    height: 1px;
    margin: 23px 0 18px;
    background: #e7eef5;
}

.hero-visual-footer {
    display: flex;
    align-items: center;
    gap: 9px;
    color: #526981;
    font-size: 11px;
    font-weight: 600;
}

.hero-visual-footer i {
    color: #15976c;
}

.hero-floating-icon {
    position: absolute;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 55px;
    height: 55px;
    border: 4px solid #ffffff;
    border-radius: 17px;
    background: #ffffff;
    color: #0875d1;
    box-shadow: 0 10px 30px rgba(27, 81, 133, 0.12);
    font-size: 20px;
}

.hero-floating-top {
    top: 30px;
    right: 5px;
}

.hero-floating-bottom {
    bottom: 30px;
    left: 0;
    color: #15976c;
}

/* ===== RESPONSIVE ===== */

@media (max-width: 900px) {
    .hero-client {
        padding: 65px 6%;
    }

    .hero-client-container {
        grid-template-columns: 1fr;
        gap: 35px;
    }

    .hero-client-content {
        max-width: 100%;
    }

    .hero-client-visual {
        min-height: 370px;
    }
}

@media (max-width: 520px) {
    .hero-client {
        padding: 45px 20px;
    }

    .hero-client h1 {
        font-size: 35px;
        letter-spacing: -0.8px;
    }

    .hero-description {
        font-size: 14px;
        line-height: 1.8;
    }

    .hero-actions {
        flex-direction: column;
    }

    .hero-btn {
        width: 100%;
        box-sizing: border-box;
    }

    .hero-features {
        flex-direction: column;
        gap: 18px;
        margin-top: 30px;
    }

    .hero-client-visual {
        min-height: 340px;
    }

    .hero-visual-card {
        max-width: 300px;
        padding: 28px 23px;
    }

    .hero-floating-top {
        right: -3px;
    }

    .hero-floating-bottom {
        left: -3px;
    }
}

</style>
