<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{route('dashboard')}}">
            <img src="{{ asset('images/icon/logo.png')}}" alt="Cool Admin"/>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="{{route('dashboard')}}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                </li>
                <hr/>
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
        </nav>
    </div>


</aside>
