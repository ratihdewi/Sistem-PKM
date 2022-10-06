@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-3" style="margin-top: 180px">
                <div class="row">
                    <div class="col">
                        <div class="card bg-light">
                            <div class="card-body">
                                <form action="{{ route('proposal.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="jenis_pkm" class="col-sm-2 col-form-label">Jenis PKM</label>
                                        <div class="col-sm-10">
                                            <select id="jenis_pkm"
                                                class="form-select @error('skema_pkm') is-invalid @enderror"
                                                aria-label="Default select example">
                                                <option id="select_jenis_pkm" selected disabled>Jenis PKM</option>

                                                @foreach ($jenis_pkm as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="skema_pkm" class="col-sm-2 col-form-label">Skema PKM</label>
                                        <div class="col-sm-10">
                                            <select id="skema_pkm"
                                                class="form-select @error('skema_pkm') is-invalid @enderror"
                                                aria-label="Default select example" name="skema_pkm">
                                                <option id="select_skema_pkm" selected disabled>Skema PKM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="judul_proposal" class="col-sm-2 col-form-label">Judul Proposal</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                class="form-control @error('judul_proposal') is-invalid @enderror"
                                                id="judul_proposal" name="judul_proposal"
                                                value="{{ old('judul_proposal') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row mahasiswa">
                                        <label for="anggota_1" class="col-sm-2 col-form-label">Anggota 1</label>
                                        <div class="col-sm-3">
                                            <input type="text"
                                                class="form-control @error('anggota_1') is-invalid @enderror" id="anggota_1"
                                                name="anggota_1">
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="hidden" id="anggota_1_id" name="anggota_1_id" value="">
                                            <input type="text" readonly class="form-control-plaintext"
                                                id="anggota_1_name" value="Nama Terisi Otomatis">
                                        </div>
                                    </div>
                                    <div class="mb-3 row mahasiswa">
                                        <label for="anggota_2" class="col-sm-2 col-form-label">Anggota 2</label>
                                        <div class="col-sm-3">
                                            <input type="text"
                                                class="form-control @error('anggota_2') is-invalid @enderror" id="anggota_2"
                                                name="anggota_2">
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="hidden" id="anggota_2_id" name="anggota_2_id" value="">
                                            <input type="text" readonly class="form-control-plaintext"
                                                id="anggota_2_name" value="Nama Terisi Otomatis">
                                        </div>
                                    </div>
                                    <div class="mb-3 row mahasiswa">
                                        <label for="anggota_3" class="col-sm-2 col-form-label">Anggota 3</label>
                                        <div class="col-sm-3">
                                            <input type="text"
                                                class="form-control @error('anggota_3') is-invalid @enderror" id="anggota_3"
                                                name="anggota_3">
                                            </select>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="hidden" id="anggota_3_id" name="anggota_3_id" value="">
                                            <input type="text" readonly class="form-control-plaintext"
                                                id="anggota_3_name" value="Nama Terisi Otomatis">
                                        </div>
                                    </div>
                                    <div class="mb-3 row mahasiswa">
                                        <label for="anggota_4" class="col-sm-2 col-form-label">Anggota 4</label>
                                        <div class="col-sm-3">
                                            <input type="text"
                                                class="form-control @error('anggota_4') is-invalid @enderror" id="anggota_4"
                                                name="anggota_4">
                                            </select>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="hidden" id="anggota_4_id" name="anggota_4_id" value="">
                                            <input type="text" readonly class="form-control-plaintext"
                                                id="anggota_4_name" value="Nama Terisi Otomatis">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="dosen_pendamping" class="col-sm-2 col-form-label">Dosen
                                            Pendamping</label>
                                        <div class="col-sm-10">
                                            <select class="form-select @error('dosen_pendamping') is-invalid @enderror"
                                                aria-label="Default select example" name="dosen_pendamping">
                                                <option selected disabled>Dosen Pendamping</option>

                                                @foreach ($data_dosen as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="pendanaan_dikti" class="col-sm-2 col-form-label">Sumber Pendanaan
                                            DIKTI</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="text"
                                                    class="form-control @error('pendanaan_dikti') is-invalid @enderror"
                                                    aria-label="Amount (to the nearest dollar)" name="pendanaan_dikti"
                                                    value="{{ old('pendanaan_dikti') }}">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="pendanaan_pt" class="col-sm-2 col-form-label">Sumber Pendanaan
                                            PT</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="text"
                                                    class="form-control @error('pendanaan_pt') is-invalid @enderror"
                                                    aria-label="Amount (to the nearest dollar)" name="pendanaan_pt"
                                                    value="{{ old('pendanaan_pt') }}">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="luaran_proposal" class="col-sm-2 col-form-label">Luaran
                                            Proposal</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                class="form-control @error('luaran_proposal') is-invalid @enderror"
                                                id="luaran_proposal" name="luaran_proposal"
                                                value="{{ old('luaran_proposal') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="proposal" class="col-sm-2 col-form-label">Upload Proposal</label>
                                        <div class="col-sm-10">
                                            <input class="form-control @error('proposal') is-invalid @enderror"
                                                type="file" id="proposal" name="proposal">
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
        $('#jenis_pkm').change(function() {
            var id = $(this).val()
            var url = "{{ route('skema', ':id') }}"
            url = url.replace(':id', id)

            $("#jenis_pkm option[id='select_jenis_pkm']").hide()
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    $('#skema_pkm').empty().append(
                        data.map(function(item) {
                            return `<option value="${item.id}">${item.name}</option>`
                        })
                    )
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log('XHR', xhr);
                    console.log('status', textStatus);
                    console.log('Error in', errorThrown);
                }
            });
        });

        $('#anggota_1').on('change', function() {
            var mhs = $(this).val();

            $.ajax({
                type: 'GET',
                url: "{{ route('mahasiswa') }}",
                data: {
                    'mhs': mhs
                },
                success: function(data) {
                    $('#anggota_1_id').val(data['id'])
                    $('#anggota_1_name').val(data['name'] ?? 'Nama Tidak Ditemukan')
                }
            })
        })

        $('#anggota_2').on('change', function() {
            var mhs = $(this).val();

            $.ajax({
                type: 'GET',
                url: "{{ route('mahasiswa') }}",
                data: {
                    'mhs': mhs
                },
                success: function(data) {
                    $('#anggota_2_id').val(data['id'])
                    $('#anggota_2_name').val(data['name'] ?? 'Nama Tidak Ditemukan')
                }
            })
        })

        $('#anggota_3').on('change', function() {
            var mhs = $(this).val();

            $.ajax({
                type: 'GET',
                url: "{{ route('mahasiswa') }}",
                data: {
                    'mhs': mhs
                },
                success: function(data) {
                    $('#anggota_3_id').val(data['id'])
                    $('#anggota_3_name').val(data['name'] ?? 'Nama Tidak Ditemukan')
                }
            })
        })

        $('#anggota_4').on('change', function() {
            var mhs = $(this).val();

            $.ajax({
                type: 'GET',
                url: "{{ route('mahasiswa') }}",
                data: {
                    'mhs': mhs
                },
                success: function(data) {
                    $('#anggota_4_id').val(data['id'])
                    $('#anggota_4_name').val(data['name'] ?? 'Nama Tidak Ditemukan')
                }
            })
        })
    </script>
@endpush
