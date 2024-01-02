@extends('admin.layouts.body')
@section('adminsection')
    @foreach ($collection as $item)
        <div class="card shadow p-3" style="border-radius: 3em">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-gray-900 text-uppercase">Edit {{ $role }}</h6>
            </div>
            <form class="needs-validation" action="{{ route('updateuser',['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="oldImg" value="{{ $item->image }}">
                <input type="hidden" name="remember_token" value="{{ Str::random(10) }}">
                <input type="hidden" name="role" value="{{ $role }}">
                <div class="modal-body">
                    <div class="row row-cols-1">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input required type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Masukkan Email ..." name="email"
                                    value="{{ $item->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="password" value="{{ $item->password }}">
                        {{-- <div class="col">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input required type="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div> --}}
                    </div>
                    <div class="row row-cols-1">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text"
                                    class="form-control
                        @error('name')
                        is-invalid
                        @enderror
                        "
                                    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nama ..."
                                    name="name" value="{{ $item->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kelas</label>
                                @php
                                    ($role === 'student') ? $gr = $item->grade : $gr = $item->subject;
                                @endphp
                                <select class="form-control" id="exampleFormControlSelect1" name="{{ ($role === 'student') ? 'grade' : 'subject' }}">
                                    @foreach ($data_select as $data)
                                        <option value="{{ $data->name }}{{ ($role === 'teacher') ? ' ('.$data->level.')' : '' }}" {{ $data->name === $gr ? 'selected' : '' }}>
                                            {{ $data->name }}{{ ($role === 'teacher') ? ' ('.$data->level.')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NISN</label>
                                <input value="{{ $item->identity_number }}" required type="text"
                                    class="form-control @error('identity_number')
                        is-invalid
                        @enderror"
                                    id="" aria-describedby="emailHelp" placeholder="Masukkan NISN ..."
                                    name="identity_number">
                                @error('identity_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Jenjang</label>
                                <select name="level" class="form-control @error('level') is-invalid @enderror"
                                    id="exampleFormControlSelect1">
                                    <option value="SMK" {{ $item->level === 'SMK' ? 'selected' : '' }}>SMK</option>
                                    <option value="SMP" {{ $item->level === 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SD" {{ $item->level === 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="TK" {{ $item->level === 'TK' ? 'selected' : '' }}>TK</option>
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-lg-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Foto Siswa</label>
                                <input type="file" class="form-control-file border p-2 rounded border-black"
                                    id="exampleFormControlFile1" accept=".png" name="image" value="0">
                                <small id="emailHelp" class="form-text text-muted">* untuk penggunaan terbaik, pastikan
                                    <strong>foto berukuran 1:1</strong> dan <strong>maksimal 2 mb</strong></small>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="" class="img-fluid w-25">
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('adminstudent') }}" class="btn btn-danger">BATAL</a>
                    <button type="submit" name="submit" class="btn btn-success">UPDATE</button>
                </div>
            </form>
        </div>
    @endforeach
@endsection
