<nav class="dashboard-navbar">

    {{-- Logo --}}
    <div class="navbar-logo">
        <img src="{{ asset('photos/Dossier.png') }}" alt="VoltaRéseau">
    </div>

    {{-- Menu --}}
    <div class="navbar-menu">

        <a href="{{ route('dashboard') }}"
           class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span>Espace Client &</span>
            <span>Terrain</span>
        </a>

        <a href="{{ route('suivi') }}"
           class="nav-item {{ request()->routeIs('suivi') ? 'active' : '' }}">
            <span>Mon Suivi en</span>
            <span>direct</span>
        </a>

        <a href="{{ route('demande.create') }}"
           class="nav-item {{ request()->routeIs('demande.create') ? 'active' : '' }}">
            <span>Nouvelle</span>
            <span>Demande</span>
        </a>

        <a href="{{ route('technicien') }}"
           class="nav-item {{ request()->routeIs('technicien') ? 'active' : '' }}">
            <span>Espace Technicien</span>
            <span>Terrain</span>
        </a>

        <a href="{{ route('devis') }}"
           class="nav-item {{ request()->routeIs('devis') ? 'active' : '' }}">
            <span>Mes Devis &</span>
            <span>Dossiers</span>
        </a>

    </div>

    {{-- Utilisateur --}}
    <div class="navbar-user">

        <div class="user-info">
            <span class="user-name">Marc Deval</span>
            <span class="user-type">Particulier • Ref #VR-8492</span>
        </div>

        <img
            src="{{ asset('photos/Dossier.png') }}"
            alt="Utilisateur"
            class="user-avatar"
        >

        {{-- Déconnexion --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn" title="Déconnexion">
                <svg width="20" height="20" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor"
                     stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
            </button>
        </form>

    </div>

</nav>
