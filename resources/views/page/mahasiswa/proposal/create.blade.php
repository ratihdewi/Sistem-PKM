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
                                                aria-label="Default select example" name="jenis_pkm">
                                                <option id="select_jenis_pkm" selected disabled>Jenis PKM</option>

                                                @foreach ($jenis_pkm as $item)
                                                    <option {{ old('jenis_pkm') == $item->id ? 'selected' : '' }}
                                                        value="{{ $item->id }}">{{ $item->name }}</option>
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
                                                <input type="hidden" id="skema_pkm_old" name="skema_pkm_old"
                                                    value="{{ old('skema_pkm') }}">
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
                                    <div id="mahasiswa">
                                        <div class="mb-3 row mahasiswa">
                                            <label for="anggota_1" class="col-sm-2 col-form-label">Anggota 1</label>
                                            <div class="col-sm-3">
                                                <input type="text"
                                                    class="form-control @error('anggota_1') is-invalid @enderror"
                                                    id="anggota_1" name="anggota_1" placeholder="NIM"
                                                    onchange="checkName(1)">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="hidden" id="anggota_1_id" name="anggota_1_id" value="">
                                                <input type="text" readonly class="form-control-plaintext"
                                                    id="anggota_1_name" value="Nama Terisi Otomatis">
                                            </div>
                                            <div class="col-sm-1">
                                                <button class="btn btn-transparent-dark" type="button" id="add_anggota"><i
                                                        class="ml-2 fa fa-plus fa-2x"></i></button>
                                            </div>
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
                                            <textarea class="form-control @error('luaran_proposal') is-invalid @enderror" id="luaran_proposal"
                                                name="luaran_proposal">{{ old('luaran_proposal') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="proposal" class="col-sm-2 col-form-label">Upload Proposal</label>
                                        <div class="col-sm-10">
                                            <input class="form-control @error('proposal') is-invalid @enderror"
                                                type="file" id="proposal" name="proposal">
                                        </div>
                                    </div>
                                    {{-- <!-- INI TUH INPUTNTYA YER-->
                                    <div class="mb-3 row">
                                        <label for="pendanaan_pt" class="col-sm-2 col-form-label">Rincian Pengeluaran</label>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-12" id="data">
                                            <input type="text" id="item" placeholder="Enter an Item">
                                            <input type="number" id="jumlah" placeholder="Enter the quantity">
                                            <input type="number" id="harga_satuan" placeholder="Enter the price">
                                            <input type="file" id="bukti" placeholder="Upload Bukti">
                                            <button id="addItem">Add</button>
                                        </div>
                                    </div>
                                    <!-- INI TUH TABELNYA -->
                                    <div class="mb-3 row">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Deskripsi Item</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Total</th>
                                                    <th>Bukti Transaksi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Peter</td>
                                                    <td>20</td>
                                                    <td>20000</td>
                                                    <td>400000</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>James</td>
                                                    <td>40</td>
                                                    <td>20000</td>
                                                    <td>800000</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Ronald</td>
                                                    <td>30</td>
                                                    <td>20000</td>
                                                    <td>600000</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div> --}}
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

<!-- INI TUH SCRIPT BUAT NAMBAH DATA DARI INPUT HTML DIATAS, DATANYA NANTI LANGSUNG MASUK KETABEL

<script>
    let btnAdd = document.querySelector('#addItem');
    let table = document.querySelector('table');
    let itemInput = document.querySelector('#item');
    let jumlahInput = document.querySelector('#jumlah');
    let hargaInput = document.querySelector('#harga_satuan');
    let buktiInput = document.querySelector('#bukti');
    btnAdd.addEventListener('click', () => {
        let item = itemInput.value;
        let jumlah = jumlahInput.value;
        let harga = hargaInput.value;
        let total = harga * jumlah;
        let bukti = buktiInput.value;
        let template = `
                    <tr>
                        <td>${item}</td>
                        <td>${jumlah}</td>
                        <td>${harga}</td>
                        <td>${total}</td>
                        <td>${bukti}</td>
                        <td></td>
                    </tr>`;
        table.innerHTML += template;
    });
</script>

-->

@push('extra_js')
    <script>
        function checkName(anggota) {
            var mhs = $(`#anggota_${anggota}`).val();

            $.ajax({
                type: 'GET',
                url: "{{ route('mahasiswa') }}",
                data: {
                    'mhs': mhs
                },
                success: function(data) {
                    $(`#anggota_${anggota}_id`).val(data['id'])
                    $(`#anggota_${anggota}_name`).val(data['name'] ?? 'Nama Tidak Ditemukan')
                }
            })
        }

        $(document).ready(function() {
            var currentAnggota = 1;

            $('#jenis_pkm').change(function() {
                var id = $(this).val()
                var url = "{{ route('skema', ':id') }}"
                url = url.replace(':id', id)

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        $('#skema_pkm').empty()
                        $('#skema_pkm').append(
                            `<option id="select_skema_pkm" selected disabled>Skema PKM</option>`
                        )
                        $('#skema_pkm').append(
                            data.map(function(item) {
                                if (parseInt($('#skema_pkm_old').val()) == item.id) {
                                    return `<option selected value="${item.id}">${item.name}</option>`
                                } else {
                                    return `<option value="${item.id}">${item.name}</option>`
                                }
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
            $('#jenis_pkm').trigger('change');

            $('#add_anggota').on('click', function() {
                currentAnggota++;

                if (currentAnggota <= 4) {
                    $('div[id=mahasiswa]').append(`
                        <div class="mb-3 row mahasiswa">
                            <label for="anggota_` + currentAnggota +
                        `" class="col-sm-2 col-form-label">Anggota ${currentAnggota.toString()}</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control @error('anggota_` + currentAnggota + `') is-invalid @enderror" id="anggota_` +
                        currentAnggota + `" name="anggota_` + currentAnggota + `" placeholder="NIM" onchange="checkName(${currentAnggota})"}}>
                            </div>
                            <div class="col-sm-6">
                                <input type="hidden" id="anggota_` + currentAnggota + `_id" name="anggota_` +
                        currentAnggota + `_id" value="">
                                <input type="text" readonly class="form-control-plaintext" id="anggota_` +
                        currentAnggota + `_name" value="Nama Terisi Otomatis">
                            </div>
                        </div>
                    `);
                }

                if (currentAnggota == 4) {
                    $('#add_anggota').hide();
                }
            });
        });
    </script>
@endpush
