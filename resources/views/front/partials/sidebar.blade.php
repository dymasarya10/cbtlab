<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Menu</div>
                <a class="nav-link" href="index.html">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                    Daftar Ujian
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="row">
                <div class="col-3 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="" class="img-fluid rounded-5"
                        width="100%">
                </div>
                <div class="col-9">
                    <div class="small">Selamat datang ,</div>
                    {{ auth()->user()->name }}
                    @if (auth()->user()->status === '1')
                        <i class="fa-solid fa-square-check text-success"></i>
                    @else
                        <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>
