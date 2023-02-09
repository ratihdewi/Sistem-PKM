@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-3" style="margin-top: 5%">
                <div class="row">
                    <div class="col">
                        <div class="card bg-light">
                            <div class="card-body">
                                <form action="{{ route('pengaturan-dokumen.submit') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="file_name" class="col-sm-3 col-form-label">Nama File</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('file_name') is-invalid @enderror" id="file_name"
                                                name="file_name" value="{{ old('file_name') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="jenis_surat" class="col-sm-3 col-form-label">Jenis Surat
                                            Keputusan</label>
                                        <div class="col-sm-9">
                                            <select id="jenis_surat" class="form-select single-select"
                                                aria-label="Default select example" name="jenis_surat">

                                                @foreach ($jenis_surat as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="periode_akademik" class="col-sm-3 col-form-label">Periode
                                            Akademik</label>
                                        <div class="col-sm-9">
                                            <select id="periode_akademik" class="form-select single-select"
                                                aria-label="Default select example" name="periode_akademik">

                                                @foreach ($tahun_akademik as $item)
                                                    <option value="{{ $item->id }}">{{ "{$item->tahun}-{$item->term}" }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="skema_pkm" class="col-sm-3 col-form-label">Skema PKM</label>
                                        <div class="col-sm-9">
                                            <select id="skema_pkm" class="form-select single-select"
                                                aria-label="Default select example" name="skema_pkm">
                                                <option value="">-</option>

                                                @foreach ($skema_pkm as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div id="reviewer">
                                        <div class="row reviewer">
                                            <label for="reviewer" class="col-sm-3 col-form-label">Dosen Pendamping PKM dan
                                                Reviewer</label>
                                            <div class="col-sm-9">
                                                <select id="reviewer" class="form-select dosen-select" name="reviewer[]"
                                                    multiple="multiple">

                                                    @foreach ($data_dosen as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="file_sk" class="col-sm-3 col-form-label">Upload SK</label>
                                        <div class="col-sm-9">
                                            <input class="form-control @error('file_sk') is-invalid @enderror""
                                                type="file" id="file_sk" name="file_sk">
                                        </div>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <a href="#">
                                            <button type="submit" class="btn"
                                                style="background-color: #5D7DCF; color: #fff">Submit</button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('extra_js')
    <script>
        $(document).ready(function() {
            $('.single-select').select2();
            $('.dosen-select').select2({
                placeholder: 'Pilih Dosen'
            });
        });
    </script>
@endpush
