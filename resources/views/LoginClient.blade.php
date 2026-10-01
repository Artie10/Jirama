<section>
<div class="entete">
    <div class="titre">
        <span class="point"></span>
        <span>Plateforme Nationale De Demande de Branchement neuf Eau</span>
    </div>

    <h1>Accéder à votre espace Client</h1>
    <p>Plateforme pour les client du jirama souhaitant effectuer une demande de branchement neuf en Eau</p>
</div>
</section>
<section class="">
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

    <!-- Formulaire -->
    <div class="formulaire">

        <label for="reference">
            Référence dossier ou Courriel demandeur
        </label>

        <input
            type="text"
            id="reference"
            name="reference"
            placeholder="Ex: RAC-2025-8842 ou client@domaine.com"
        >

        <div class="password-label">
            <label for="password">
                Code d'accès sécurisé
            </label>

            <a href="#">Code oublié ?</a>
        </div>

        <input
            type="password"
            id="password"
            name="password"
            placeholder="••••••••"
        >
    </div>
    <p class="msgError"></p>
    <button class="btn-login">Acceder à mon espace client</button>

    <!-- Assistance -->
    <div class="assistance">
        <span>♧</span>
        <p>
            Assistance raccordement : <strong>0800 400 900</strong>
        </p>

        <strong>Guichet Ouvert<br>24/7</strong>
    </div>

</div>
</div>
</section>
<style>
.entete {
    width: 100%;
    margin-right: 0%
    max-width: 950px;
    min-height: 6px;
    padding: 42px;
    box-sizing: border-box;

    border-radius: 22px;

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

    font-family: Arial, Helvetica, sans-serif;
}

.titre {
    display: flex;
    align-items: center;
    gap: 14px;

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
    margin: 10px 0 11px;

    font-size: 40px;
    line-height: 1.08;
    font-weight: 70;
}

.entete p{
    max-width: 850px;

    margin-bottom: 0px;

    color: #e5e9f2;

    font-size: 18px;
    line-height: 1.65;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background: #f5f6fa;
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
</style>
