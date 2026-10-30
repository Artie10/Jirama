
@props(['dossier'])

<nav class="dashboard-navbar" id="dashboardNavbar">

    {{-- Bouton burger --}}
    <button type="button"
            class="navbar-burger"
            id="navbarBurger"
            aria-label="Ouvrir le menu"
            aria-expanded="false"
            aria-controls="navbarMenu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    {{-- Menu --}}
    <div class="navbar-menu" id="navbarMenu">

        <a href="{{ route('suivi') }}"
           class="nav-item {{ request()->routeIs('suivi', 'client.dashboard') ? 'active' : '' }}">
            <span>Suivi de dossier et modification</span>
        </a>

        <a href="{{ route('demande.create') }}"
           class="nav-item {{ request()->routeIs('demande.create') ? 'active' : '' }}">
            <span>Nouvelle demande</span>
        </a>

        <a href="{{ route('technicien') }}"
           class="nav-item {{ request()->routeIs('technicien') ? 'active' : '' }}">
            <span>Technicien terrain</span>
        </a>

        <a href="{{ route('devis') }}"
           class="nav-item {{ request()->routeIs('devis') ? 'active' : '' }}">
            <span>Mes devis & dossiers</span>
        </a>

    </div>

    {{-- Informations du client connecté --}}
    <div class="navbar-user">

        <div class="user-info">

            <span class="user-name">
                {{ $dossier->Nom }}
            </span>

            <span class="user-type">
                {{ $dossier->statut_demandeur ?? 'Client' }}
                • Ref #{{ $dossier->NumDossier }}
            </span>

        </div>

        {{-- Avatar --}}
        <img src="{{ asset('photos/Dossier.png') }}"
             alt="Photo du client"
             class="user-avatar">

        {{-- Déconnexion --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit"
                    class="logout-btn"
                    title="Déconnexion"
                    aria-label="Se déconnecter">

                <svg width="20"
                     height="20"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>

                </svg>

            </button>
        </form>

    </div>

</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const burger = document.getElementById('navbarBurger');
    const menu = document.getElementById('navbarMenu');
    const navbar = document.getElementById('dashboardNavbar');

    if (!burger || !menu || !navbar) return;

    function setMenu(open) {

        menu.classList.toggle('open', open);

        burger.setAttribute('aria-expanded', String(open));

        burger.setAttribute(
            'aria-label',
            open ? 'Fermer le menu' : 'Ouvrir le menu'
        );
    }

    // Ouvrir ou fermer le menu
    burger.addEventListener('click', function () {
        setMenu(!menu.classList.contains('open'));
    });

    // Fermer en cliquant sur un lien
    menu.querySelectorAll('.nav-item').forEach(function (link) {

        link.addEventListener('click', function () {
            setMenu(false);
        });

    });

    // Fermer en cliquant à l'extérieur
    document.addEventListener('click', function (event) {

        if (!navbar.contains(event.target)) {
            setMenu(false);
        }

    });

    // Fermer avec la touche Échap
    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            setMenu(false);
        }

    });

    // Fermer en repassant sur desktop
    window.addEventListener('resize', function () {

        if (window.innerWidth > 860) {
            setMenu(false);
        }

    });

});
</script>
