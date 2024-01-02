@extends('admin.layouts.body')
@section('adminsection')
    <div class="row">
        <div class="col">
            <div class="card shadow rounded-4 p-3" style="border-radius: 2em">
                <form action="" method="GET" id="myForm">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jumlah Soal</label>
                        <input value="{{ old('jumlahsoal') }}" type="number" class="form-control" id="jerojos"
                            aria-describedby="emailHelp" name="jumlahsoal">
                        <div id="emailHelp" class="form-text">*jumlah soal harus sesuai dengan soal yang telah dibuat</div>
                    </div>
                    <button type="submit" class="btn bg-primarycust-non-gr text-white">Buat</button>
                </form>
            </div>
        </div>
    </div>
    @php
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Memeriksa apakah variabel $_GET['jumlahsoal'] ada dan nilainya lebih dari 0
            if (isset($_GET['jumlahsoal']) && intval($_GET['jumlahsoal']) > 0) {
                $jumlahsoal = (int) $_GET['jumlahsoal'];
                $cek = true;
            } else {
                $jumlahsoal = 0;
                $cek = false;
            }
        }
    @endphp
    @if ($cek === true)
        <div class="row mt-4">
            <div class="col">
                <div class="card shadow rounded-4 p-3" style="border-radius: 2em">
                    <p class="font-weight-bold text-gray-900">Jumlah soal : {{ $jumlahsoal }}</p>
                    <form action="{{ route('storeqst') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="level" value="choose">
                        {{-- CONTENT FORM --}}
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Ujian</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="question_name">
                                </div>
                            </div>
                        </div>
                        {{-- CONTENT FORM --}}
                        {{-- CONTENT FORM --}}
                        <div class="row row-cols-1 row-cols-md-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1">Mata Pelajaran</label>
                                    <select name="subject" class="form-control" id="exampleFormControlSelect1">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->name }}-{{ $subject->level }}">{{ $subject->name }}-{{ $subject->level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1">Kelas</label>
                                    <select name="grade" class="form-control" id="exampleFormControlSelect1">
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->name }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Durasi</label>
                                    <input type="number" class="form-control" id="durasi" aria-describedby="emailHelp"
                                        name="duration" value="30">
                                </div>
                            </div>
                        </div>
                        {{-- CONTENT FORM --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlFile1">Masukan Soal</label>
                                <input type="file"
                                    class="mb-4 form-control-file border p-2 rounded border-black @error('question_path')
                                border-danger is-invalid
                                @enderror"
                                    id="exampleFormControlFile1" accept=".pdf" name="question_path">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- CONTENT FORM --}}
                        <div class="row">
                            <div class="col">
                                <label for="">Buat Kunci Jawaban</label>
                                <div class="table-responsive table-bordered table-sm table-hover">
                                    <table class="table">
                                        <thead>
                                            <tr class="bg-success text-white">
                                                <th scope="col">No</th>
                                                <th scope="col">A</th>
                                                <th scope="col">B</th>
                                                <th scope="col">C</th>
                                                <th scope="col">D</th>
                                                <th scope="col">E</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < $jumlahsoal; $i++)
                                                <tr>
                                                    <th scope="row">{{ $i + 1 }}</th>
                                                    <td class="d-none">
                                                        <input type="radio" name="answer_key[{{ $i }}]"
                                                            value="0" id="" checked>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="answer_key[{{ $i }}]"
                                                            value="A" id="">
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="answer_key[{{ $i }}]"
                                                            value="B" id="">
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="answer_key[{{ $i }}]"
                                                            value="C" id="">
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="answer_key[{{ $i }}]"
                                                            value="D" id="">
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="answer_key[{{ $i }}]"
                                                            value="E" id="">
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-success text-white">
                                                <th scope="col">No</th>
                                                <th scope="col">A</th>
                                                <th scope="col">B</th>
                                                <th scope="col">C</th>
                                                <th scope="col">D</th>
                                                <th scope="col">E</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- CONTENT FORM --}}
                        <div class="row">
                            <div class="col">
                                <div class="my-3">
                                    <label for="exampleInputEmail1" class="form-label">Pembuat Soal</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="creator" value="{{ auth()->user()->name }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class=" mt-3 btn bg-primarycust-non-gr text-white">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="row mt-4">
            <div class="col">
                <div class="card shadow p-3 text-center mb-3" style="border-radius: 2em">
                    <div class="display-6 text-danger text-uppercase">
                        Masukan Jumlah Soal
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        var jumlahSoalInput = document.getElementById('jerojos');
        var durasi = document.getElementById('durasi');

        jumlahSoalInput.addEventListener('input', function() {
            if (jumlahSoalInput.value <= 0 || jumlahSoalInput.value === '') {
                alert('Jumlah soal tidak boleh kurang dari atau sama dengan 0');
                jumlahSoalInput.value = ''; // Menghapus nilai input jika kurang dari 0
            }
        });
        durasi.addEventListener('input', function() {
            if (durasi.value <= 0) {
                alert('Jumlah durasi tidak boleh kurang dari 0');
                durasi.value = ''; // Menghapus nilai input jika kurang dari 0
            }
            if (durasi.value > 180) {
                alert('Jumlah durasi maksimal 180 menit');
                durasi.value = ''; // Menghapus nilai input jika kurang dari 0
            }
        });
    </script>
@endsection
