<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('admin/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Restaurent</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                       class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- User --}}
                <li class="nav-item {{ request()->routeIs('user.*') || request()->routeIs('type.*') ? 'menu-open' : '' }}">
                    <a class="nav-link {{ request()->routeIs('user.*') || request()->routeIs('type.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-users"></i>
                        <p>
                            User
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}"
                               class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{route('user.changePasswordForm')}}"
                               class="nav-link {{ request()->routeIs('type.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Change Password</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                {{-- Category --}}
                <li class="nav-item">
                    <a href="{{ route('category.index') }}"
                       class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-list"></i>
                        <p>Category</p>
                    </a>
                </li>

                {{-- Foods --}}
                <li class="nav-item {{ request()->routeIs('food.*') ? 'menu-open' : '' }}">
                    <a class="nav-link {{ request()->routeIs('food.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-bowl-food"></i>
                        <p>
                            Foods
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('food.index') }}"
                               class="nav-link {{ request()->routeIs('food.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Food</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Orders --}}
                <li class="nav-item {{ request()->routeIs('orders.*') || request()->routeIs('item.*') ? 'menu-open' : '' }}">
                    <a class="nav-link {{ request()->routeIs('orders.*') || request()->routeIs('item.*') ? 'active' : '' }}">
                        <i class="fa-brands fa-jedi-order"></i>
                        <p>
                            Orders
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}"
                               class="nav-link {{ request()->routeIs('orders.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.items') }}"
                               class="nav-link {{ request()->routeIs('orders.items') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Item</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Chefs --}}
                <li class="nav-item">
                    <a href="{{ route('chefs.index') }}"
                       class="nav-link {{ request()->routeIs('chefs.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-kitchen-set"></i>
                        <p>Chefs</p>
                    </a>
                </li>

                {{-- Reservation --}}
                <li class="nav-item">
                    <a href="{{ route('reservation.index') }}"
                       class="nav-link {{ request()->routeIs('reservation.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Reservation</p>
                    </a>
                </li>

                {{-- Logout --}}
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                       class="nav-link {{ request()->routeIs('logout') ? 'active' : '' }}">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>


    <!--end::Sidebar Wrapper-->
</aside>
