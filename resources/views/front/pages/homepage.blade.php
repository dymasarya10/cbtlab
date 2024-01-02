@extends('front.layouts.body')
@section('frontsection')
    <div class="row">
        <div class="col-12 mb-5 f-Carattere text-center">
            <h2 class="h2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem nihil modi et nesciunt ex
                soluta earum est recusandae amet velit. Illum ea vel pariatur minus deserunt recusandae magnam quisquam
                impedit!</h2>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
        <div class="col">
            <div class="card shadow mb-3">
                <div class="card-header bg-primary text-white">
                    ASAS GENAP
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>Mata Pelajaran</td>
                                    <td>: SBK</td>
                                </tr>
                                <tr>
                                    <td>Jenjang</td>
                                    <td>: SMP</td>
                                </tr>
                                <tr>
                                    <td>Jam Pelaksanaan</td>
                                    <td>: 09:00</td>
                                </tr>
                                <tr>
                                    <td>Durasi</td>
                                    <td>: 120 Menit</td>
                                </tr>
                                <tr>
                                    <td>Pembuat</td>
                                    <td>: Admin</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="container-fluid p-0 text-center">
                        <a href="" class="btn btn-primary w-100 text-center">Kerjakan</a>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="small fst-italic text-decoration-underline">
                        * toleransi keterlambatan adalah <strong>10 Menit</strong>
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection
