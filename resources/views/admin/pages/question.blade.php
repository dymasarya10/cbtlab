@extends('admin.layouts.body')
@section('adminsection')
    <div class="row">
        <div class="col">
            <div class="card shadow bg-white" style="border-radius: 1.5em">
                <div class="card-header py-3 bg-white"
                    style="border-radius: 1.5em; border-bottom-left-radius: 0px;border-bottom-right-radius: 0px">
                    <h6 class="m-0 font-weight-bold text-gray-900 text-uppercase">Daftar Soal</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('createqst') }}" class="btn text-white bg-primarycust-non-gr">
                        Tambah Data
                    </a>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show  animate__animated animate__fadeIn mt-3"
                            role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        @foreach ($collection as $item)
                            <div class="col">
                                <div class="card shadow my-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-dark">{{ $item->question_name }} -
                                            {{ $item->subject }} - KELAS {{ $item->grade }}
                                            @if ($item->status === 1)
                                                <i class="fas fa-check-circle text-success"> Active</i>
                                            @else
                                                <i class="fas fa-exclamation-triangle text-warning"> Inactive</i>
                                            @endif
                                        </h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">aksi:</div>
                                                {{-- <a class="dropdown-item" href="#">Edit</a> --}}
                                                @if ($item->status === 1)
                                                    <form action="{{ route('activateqst') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" value="0" name="status">
                                                        <input type="hidden" name="target" value="{{ $item->id }}">
                                                        <button type="submit"
                                                            class="btn dropdown-item">Nonaktifkan</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('activateqst') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" value="1" name="status">
                                                        <input type="hidden" name="target" value="{{ $item->id }}">
                                                        <button type="submit" class="btn dropdown-item">Aktifkan</button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('deleteqst') }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="target_id" value="{{ $item->id }}">
                                                    <button class="btn dropdown-item" type="submit"
                                                        onclick="return confirm('Apakah anda ingin menghapus '.$item->question_name.' ?')">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-3 d-flex align-items-center">
                                                Durasi
                                            </div>
                                            <div class="col-9">
                                                {{ $item->duration }} Menit
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-3 d-flex align-items-center">
                                                Pembuat
                                            </div>
                                            <div class="col-9">
                                                {{ $item->creator }}
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-3 d-flex align-items-center">
                                                File Soal
                                            </div>
                                            <div class="col-9">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#soal{{ $item->id }}">Lihat</button>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-3 d-flex align-items-center">
                                                Jawaban
                                            </div>
                                            <div class="col-9">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#jawaban{{ $item->id }}">Lihat</button>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-3 d-flex align-items-center">
                                                Peserta
                                            </div>
                                            <div class="col-9">
                                                <button class="btn-primary btn" data-toggle="modal"
                                                    data-target="#peserta{{ $item->id }}">
                                                    Lihat
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL PESERTA --}}
                                <div class="modal fade" id="peserta{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="pesertaTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">{{ $item->question_name }} -
                                                    {{ $item->subject }} - KELAS {{ $item->grade }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Peserta</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $arrstd = explode(',', $item->passtest);
                                                            @endphp
                                                            @foreach ($arrstd as $dx => $std)
                                                                <tr>
                                                                    <th scope="row">{{ $dx + 1 }}</th>
                                                                    <td>{{ $std }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL JAWABAN --}}
                                <div class="modal fade" id="jawaban{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="jawabanTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">{{ $item->question_name }} -
                                                    {{ $item->subject }} - KELAS {{ $item->grade }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Jawaban</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $arranswer = explode(',', $item->answer_key);
                                                            @endphp
                                                            @foreach ($arranswer as $ind => $ans)
                                                                <tr>
                                                                    <th scope="row">{{ $ind + 1 }}</th>
                                                                    <td>{{ $ans }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL SOAL --}}
                                <div class="modal fade" id="soal{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="soalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                    {{ $item->question_name }} -
                                                    {{ $item->subject }} - KELAS {{ $item->grade }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <embed src="{{ asset('storage/' . $item->question_path) }}"
                                                    type="application/pdf" width="100%" height="600">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- <div class="table-responsive">
    <table class="table">
        <tbody>
            <tr>
                <td>File Soal</td>
                <td><button class="btn btn-primary">Lihat</button></td>
            </tr>
            <tr>
                <td>Jawaban</td>
                <td><button class="btn btn-primary">Lihat</button></td>
            </tr>
        </tbody>
    </table>
</div> --}}
