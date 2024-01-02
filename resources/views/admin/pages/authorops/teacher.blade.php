@extends('admin.layouts.body')
@section('adminsection')
    <div class="row">
        <div class="col">
            <div class="card shadow bg-white" style="border-radius: 1.5em">
                <div class="card-header py-3 bg-white" style="border-radius: 1.5em; border-bottom-left-radius: 0px;border-bottom-right-radius: 0px">
                    <h6 class="m-0 font-weight-bold text-gray-900 text-uppercase">Daftar Guru</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admincreateacc',['role' => 'teacher']) }}" class="btn text-white bg-primarycust-non-gr">
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
                    <div class="search mt-3">
                        <form action="/admin/teacher" class="container-fluid p-0" method="GET">
                            <div class="input-group w-25 mb-4">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Cari NIP..." aria-label="Search" aria-describedby="basic-addon2"
                                    name="s" value="{{ request('s') }}">
                                <div class="input-group-append">
                                    <button class="btn bg-primarycust-non-gr text-white" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                        </form>
                    </div>
                    <div class="table-responsive my-1">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Mata Pelajaran</th>
                                    <th scope="col">Jenjang</th>
                                    <th scope="col" class="text-center">Foto</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collection as $item)
                                    <?php
                                    $item->status === '1' ? ($value = [0, 'Aktif']) : ($value = [1, 'NonAktif']);
                                    $item->image === null ? ($img = asset('assets/admin/img/undraw_profile.svg')) : ($img = asset('storage/' . $item->image));
                                    $item->image === null ? ($delimg = 0) : ($delimg = $item->image);
                                    $value[1] === 'Aktif' ? ($btn = 'btn-success') : ($btn = 'btn-danger');
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration + $collection->perPage() * ($collection->currentPage() - 1) }}
                                        </th>
                                        <td>{{ $item->identity_number }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->subject }}</td>
                                        <td>{{ $item->level }}</td>
                                        <td class="text-center">
                                            <img src="{{ $img }}" alt="" class="img-fluid" width="45em" style="border-radius: 2em">
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('activateuser') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $value[0] }}" name="status">
                                                <input type="hidden" value="{{ $item->id }}" name="target_id">
                                                <button class="btn {{ $btn }}">{{ $value[1] }}</button>
                                            </form>
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('adminshowacc',['id' => Crypt::encrypt($item->id),'role' => 'teacher']) }}" class="mx-2 btn btn-warning">Edit</a>
                                            <form action="{{ route('deleteuser') }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" value="{{ $item->id }}" name="target">
                                                <input type="hidden" value="{{ $delimg }}" name="path">
                                                <button onclick="return confirm('Hapus {{ $item->name }} ?')" type="submit"
                                                    class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $collection->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

