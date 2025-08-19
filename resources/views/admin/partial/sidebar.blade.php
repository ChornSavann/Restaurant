<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <a href="{{ route('dashboard.index') }}" class="brand-link">
            <img src="{{ asset('admin/assets/img/wholesome-eats-restaurant-logo_11024923.png!w700wp') }}"
                alt="Restaurant Logo" class="brand-image opacity-100 shadow rounded-circle logo-circle" />

            <span class="brand-text fw-light">Restaurent</span>
        </a>
    </div>

    <!-- Sidebar Wrapper -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- User -->
                <li
                    class="nav-item {{ request()->routeIs('user.*') || request()->routeIs('type.*') ? 'menu-open' : '' }}">
                    <a
                        class="nav-link {{ request()->routeIs('user.*') || request()->routeIs('type.*') ? 'active' : '' }}">
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
                                <p>Create User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.myprofile') }}"
                                class="nav-link {{ request()->routeIs('user.myprofile') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Profile</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- Category -->
                <li class="nav-item">
                    <a href="{{ route('category.index') }}"
                        class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-list"></i>
                        <p>Category</p>
                    </a>
                </li>

                <!-- Foods -->
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
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('food.list') }}"
                                class="nav-link {{ request()->routeIs('food.list') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>List foods</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- stocks -->
                <li class="nav-item {{ request()->routeIs('stocks.*') ? 'menu-open' : '' }}">
                    <a class="nav-link {{ request()->routeIs('stocks.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <p>
                            Stocks
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('stocks.index') }}"
                                class="nav-link {{ request()->routeIs('stocks.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Create Stock</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('discount.index') }}"
                                class="nav-link {{ request()->routeIs('stocks.dicount') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Discount</p>
                            </a>
                        </li>
                    </ul>

                </li>

                <!-- Orders -->
                <li
                    class="nav-item {{ request()->routeIs('orders.*') || request()->routeIs('item.*') ? 'menu-open' : '' }}">
                    <a
                        class="nav-link {{ request()->routeIs('orders.*') || request()->routeIs('item.*') ? 'active' : '' }}">
                        <i class="fa-brands fa-jedi-order"></i>
                        <p>
                            Orders
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('order.index') }}"
                                class="nav-link {{ request()->routeIs('orders.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.show') }}"
                                class="nav-link {{ request()->routeIs('orders.show') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Order Detail</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Chefs -->
                <li class="nav-item">
                    <a href="{{ route('chefs.index') }}"
                        class="nav-link {{ request()->routeIs('chefs.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-kitchen-set"></i>
                        <p>Chefs</p>
                    </a>
                </li>

                <!-- Reservation -->
                <li class="nav-item">
                    <a href="{{ route('reservation.index') }}"
                        class="nav-link {{ request()->routeIs('reservation.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-calendar-event"></i>
                        <p>Reservation</p>
                    </a>
                </li>

                {{-- report --}}

                <li class="nav-item {{ request()->routeIs('report.*') ? 'menu-open' : '' }}">
                    <a class="nav-link {{ request()->routeIs('report.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <p>
                            Report
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- Sale Report --}}
                        <li class="nav-item">
                            <a href="{{ route('sale.report') }}"
                                class="nav-link {{ request()->routeIs('sale.report') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Sale Report</p>
                            </a>
                        </li>

                        {{-- Food Report --}}
                        <li class="nav-item">
                            <a href="{{ route('report.food') }}"
                                class="nav-link {{ request()->routeIs('report.food') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Food Report</p>
                            </a>
                        </li>

                        {{-- Customer Report --}}
                        <li class="nav-item">
                            <a href="{{ route('report.customer') }}"
                                class="nav-link {{ request()->routeIs('report.customer') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Customer Report</p>
                            </a>
                        </li>

                        {{-- Stock Report --}}
                        <li class="nav-item">
                            <a href="{{ route('report.stock') }}"
                                class="nav-link {{ request()->routeIs('report.stock') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Stock Report</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
    <!-- End Sidebar Wrapper -->
</aside>
