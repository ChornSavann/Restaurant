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
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link @yield('dashboard')">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Dasboard</p>
                    </a>
                </li>
                <li class="nav-item  @yield('menu-open')">
                    <a class="nav-link active">
                        <i class="fa-solid fa-users"></i>
                        <p>
                            User
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{route('user.index')}}" class="nav-link @yield('unit')">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link @yield('type')">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Item</p>
                            </a>
                        </li> --}}

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('category.index')}}" class="nav-link @yield('category')">
                        <i class="fa-solid fa-list"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item  @yield('menu-open')">
                    <a class="nav-link active">
                        <i class="fa-solid fa-bowl-food"></i>
                        <p>
                            Foods
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="{{route('food.index')}}" class="nav-link @yield('food')">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Food</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('orders.index')}}" class="nav-link @yield('order')">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Order</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{route('chefs.index')}}" class="nav-link @yield('chefs')">
                        <i class="fa-solid fa-kitchen-set"></i>
                        <p>Chefs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('reservation.index')}}" class="nav-link @yield('reservation')">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Reservation</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link @yield('logout')">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <p>Logout</p>
                    </a>
                </li>

                <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
