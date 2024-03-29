<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img src="{{ asset('images/icon/logo.png')}}" alt="CoolAdmin"/>
                </a>
                <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="has-sub">
                    <a class="js-arrow" href="{{route('dashboard')}}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li>
                    <a href="{{route('users.index')}}">
                        <i class="fas fa-users"></i>Users</a>
                </li>
                <li>
                    <a href="{{route('categories.index')}}">
                        <i class="fas fa-list-ul"></i>Categories</a>
                </li>
                <li>
                    <a href="{{route('products.index')}}">
                        <i class="fas fa-truck"></i>Products</a>
                </li>
                <li>
                    <a href="{{route('currencies.index')}}">
                        <i class="fas fa-money-bill-alt"></i>Currencies</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
