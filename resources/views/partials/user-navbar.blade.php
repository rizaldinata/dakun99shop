<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('produk.index') }}">
            <img src="{{ asset('images/dakun99shop.png') }}" alt="Logo" height="32" class="me-2">
            Dakun GunShop
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                        href="{{ route('dashboard.index') }}">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.transactions.index') || request()->routeIs('user.transactions.show') ? 'active' : '' }}"
                        href="{{ route('user.transactions.index') }}">
                        <i class="fas fa-box me-1"></i>Riwayat Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}"
                        href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart me-1"></i>Keranjang
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
                        href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        {{-- <li>
                            <a class="dropdown-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
                                href="{{ route('profile.edit') }}">
                                <i class="fas fa-cog me-2"></i>Profil Saya
                            </a>
                        </li> --}}
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
