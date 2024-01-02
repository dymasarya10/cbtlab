<nav class="sb-topnav navbar navbar-expand navbar-dark" style="background: linear-gradient(to right, #009432, #20bf6b);">
    {{-- background: linear-gradient(to right, #009432, #20bf6b); --}}
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html"><img src="{{ asset('assets/admin/img/logo.png') }}" alt="Bootstrap"
            width="30" height="30" class="d-inline-block align-text-bottom">&nbsp;&nbsp;&nbsp;CBT-LAB
        </a>
    <!-- Sidebar Toggle-->
    <button class="text-white btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link text-white dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-power-off"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <li><button class="dropdown-item" type="submit">Logout</button></li>
                </form>
            </ul>
        </li>
    </ul>
</nav>
