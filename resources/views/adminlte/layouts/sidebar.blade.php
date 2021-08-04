<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('cabinet') }}" class="brand-link">
        {{-- <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        <span class="brand-text font-weight-light ml-4" >Личный кабинет</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('profile') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Профиль
                            <!--<span class="right badge badge-danger">New</span>-->
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cabinet.earn') }}" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                            Как зарабатывать
                            <!--<span class="right badge badge-danger">New</span>-->
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cabinet.material') }}" class="nav-link">
                        <i class="nav-icon fas fa-air-freshener"></i>
                        <p>
                            Рекламные материалы
                            <!--<span class="right badge badge-danger">New</span>-->
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cabinet.orders') }}" class="nav-link">
                        <i class="nav-icon fas fa-gift"></i>
                        <p>
                            Заказы
                            <!--<span class="right badge badge-danger">New</span>-->
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt nav-icon "></i>
                        <p>Выход</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
