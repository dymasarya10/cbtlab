<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon text-gray-900">
            <i class="fas fa-laptop"></i>
            <div class="sidebar-brand-text mx-3">CBT-LAB</div>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Heading -->
    @if (auth()->user()->role === 'admin')
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ $heading === 'Dashboard' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admindashboard') }}">
                <i class="fas fa-school"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            admin
        </div>
        <li class="nav-item  {{ $heading === 'Admin' ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-users-cog"></i>
                <span>Otoritas</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Aplikasi:</h6>
                    <a class="collapse-item" href="{{ route('questionlist') }}">Daftar Soal</a>
                    <a class="collapse-item" href="{{ route('admingrade') }}">Daftar Kelas</a>
                    <a class="collapse-item" href="{{ route('adminsubject') }}">Daftar Mata Pelajaran</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">User:</h6>
                    <a class="collapse-item" href="{{ route('adminstudent') }}">Murid</a>
                    {{-- <a class="collapse-item" href="{{ route('adminteacher') }}">Guru</a> --}}
                </div>
            </div>
        </li>
    @endif


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        guru
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item {{ $heading === 'Daftar Soal' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('questionlist') }}">
            <i class="far fa-keyboard"></i>
            <span>Daftar Soal</span></a>
    </li>
    <li class="nav-item {{ $heading === 'Hasil Ujian' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('testresult') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Hasil Ujian</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ $heading === 'Info' ? 'active' : '' }}">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-info-circle"></i>
            <span>Tentang Aplikasi</span></a>
    </li>

    <!-- Sidebar Message -->
    <!-- <div class="sidebar-card d-none d-lg-flex">
        <img class="img-fluid w-50" src="img/logo.png" alt="...">
        <p class="text-center mb-t text-gray-900"><strong>CBT-LAB</strong> was created by Dymas Arya Nanda in order to help his first place for the IT thing to organize it's need for the test</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Read More...</a>
    </div> -->

</ul>
