@extends('admin.layouts.body')
@section('adminsection')
    @php
        ($role === 'student') ? $rl = 'Murid' : $rl = 'Guru'
    @endphp
    <div class="card shadow p-3" style="border-radius: 3em">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-gray-900 text-uppercase">Tambah {{ $rl }}</h6>
        </div>
        <form class="needs-validation" action="{{ route('storeuser') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="remember_token" value="{{ Str::random(10) }}">
            <input type="hidden" name="role" value="{{ $role }}">
            <div class="modal-body">
                <div class="row row-cols-2">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="email"
                                class="form-control
                            @error('email')
                            is-invalid
                            @enderror"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Email ..."
                                name="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password"
                                class="form-control
                            @error('password')
                            is-invalid
                            @enderror"
                                id="exampleInputPassword1" placeholder="Password" name="password">
                            @error('password')
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
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text"
                                class="form-control
                            @error('name')
                            is-invalid
                            @enderror
                            "
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nama ..."
                                name="name">
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
                            <label for="exampleFormControlSelect1">{{ ($role === 'student') ? 'Kelas' : 'Mata Pelajaran' }}</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="{{ ($role === 'student') ? 'grade' : 'subject' }}">
                                @foreach ($data_select as $item)
                                    <option value="{{ $item->name }}{{ ($role === 'teacher') ? ' ('.$item->level.')' : '' }}">{{ $item->name }}{{ ($role === 'teacher') ? ' ('.$item->level.')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ ($role === 'student') ? 'NISN' : 'NIP' }}</label>
                            <input type="text"
                                class="form-control @error('identity_number')
                            is-invalid
                            @enderror"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan {{ ($role === 'student') ? 'NISN' : 'NIP' }} ..."
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
                                <option value="SMK">SMK</option>
                                <option value="SMP">SMP</option>
                                <option value="SD">SD</option>
                                <option value="TK">TK</option>
                            </select>
                            @error('level')
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
                            <label for="exampleFormControlFile1">Foto {{ ($role === 'student') ? 'Siswa' : 'Guru' }}</label>
                            <input type="file"
                                class="form-control-file border p-2 rounded border-black @error('image')
                            border-danger is-invalid
                            @enderror"
                                id="exampleFormControlFile1" accept=".png" name="image">
                            <small id="emailHelp" class="form-text text-muted">* untuk penggunaan terbaik, pastikan
                                <strong>foto berukuran 1:1</strong> dan <strong>maksimal 2 mb</strong></small>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <a href="{{ ($role === 'student') ? route('adminstudent') : route('adminteacher') }}" class="btn btn-danger">BATAL</a>
                <button type="submit" name="submit" class="btn btn-primary">SIMPAN</button>
            </div>
        </form>
    </div>
@endsection
