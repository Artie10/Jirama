<nav class="dashboard-navbar" id="dashboardNavbar">

    {{-- Bouton burger (visible seulement sur mobile) --}}
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
           class="nav-item {{ request()->routeIs('suivi') ? 'active' : '' }}">
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

    {{-- Utilisateur (inchangé) --}}
    <div class="navbar-user">
        <div class="user-info">
            <span class="user-name">Marc Deval</span>
            <span class="user-type">Particulier • Ref #VR-8492</span>
        </div>

        <img src="{{ asset('photos/Dossier.png') }}" alt="Utilisateur" class="user-avatar">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn" title="Déconnexion">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
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
    const menu   = document.getElementById('navbarMenu');
    const navbar = document.getElementById('dashboardNavbar');

    function setMenu(open) {
        menu.classList.toggle('open', open);
        burger.setAttribute('aria-expanded', open);
        burger.setAttribute('aria-label', open ? 'Fermer le menu' : 'Ouvrir le menu');
    }

    burger.addEventListener('click', function () {
        setMenu(!menu.classList.contains('open'));
    });

    // Fermer en cliquant sur un lien
    menu.querySelectorAll('.nav-item').forEach(function (link) {
        link.addEventListener('click', function () { setMenu(false); });
    });

    // Fermer en cliquant à l'extérieur
    document.addEventListener('click', function (e) {
        if (!navbar.contains(e.target)) setMenu(false);
    });

    // Fermer avec Échap
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') setMenu(false);
    });

    // Fermer si on repasse en desktop
    window.addEventListener('resize', function () {
        if (window.innerWidth > 860) setMenu(false);
    });
});
</script>
