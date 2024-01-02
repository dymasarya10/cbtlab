@include('front.layouts.head')
<div class="sb-nav-fixed">
    @include('front.partials.topbar')
    <div id="layoutSidenav">
        @include('front.partials.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @if (auth()->user()->status === '1')
                        @include('front.partials.heading')
                        @yield('frontsection')
                    @else
                        <div class="row align-items-center justify-content-center" style="min-height: 70vh">
                            <div class="col-12 col-md-7 col-lg-6">
                                <div class="text-center">
                                    <h4 class="display-5 mb-5">Sepertinya akun anda belum aktif, silakan hubungi admin
                                    </h4>
                                    <img src="{{ asset('assets/front/img/undraw_mobile_login_re_9ntv.svg') }}"
                                        alt="" class="img-fluid w-50">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </main>
            @include('front.partials.footer')
        </div>
    </div>
</div>
@include('front.layouts.foot')
