@extends('admin.layouts.body')
@section('adminsection')
    <div class="row">
        <div class="col-md-12 col-lg-7">
            <div class="card bg-white p-3" style="border-radius: 3em">
                <div class="card-header py-3 bg-white"
                    style="border-radius: 1.5em; border-bottom-left-radius: 0px;border-bottom-right-radius: 0px">
                    <h6 class="m-0 font-weight-bold text-gray-900 text-uppercase">Daftar Mata Pelajaran</h6>
                </div>
                <div class="card-body">
                    <button class="btn text-white bg-primarycust-non-gr mb-3" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        Tambah Data
                    </button>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show  animate__animated animate__fadeIn mt-3"
                            role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive my-1">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Jenjang</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collection as $item)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->level }}</td>
                                        <td class="d-flex justify-content-center">
                                            <form action="{{ route('destroysubject') }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" value="{{ $item->id }}" name="target">
                                                <button onclick="return confirm('Hapus Mata Pelajaran {{ $item->name }} ?')"
                                                    type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL --}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primarycust-non-gr text-white">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('storesubject') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Matapelajaran</label>
                            <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                          </div>
                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Jenjang</label>
                            <select name="level" class="form-control"
                                id="exampleFormControlSelect1">
                                <option value="SMK">SMK</option>
                                <option value="SMP">SMP</option>
                                <option value="SD">SD</option>
                                <option value="TK">TK</option>
                            </select>
                          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                        <button type="submit" class="btn btn-success">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
