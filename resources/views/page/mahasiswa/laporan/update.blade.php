@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 180px">
                <div class="row">
                    <div class="col">
                        <div class="card bg-light">
                            <div class="card-body">
                                @if (Request::is('laporan-kemajuan*'))
                                    <form action="{{ route('laporan-kemajuan.submit', $document->id) }}" method="post"
                                        enctype="multipart/form-data">
                                @endif
                                @if (Request::is('laporan-akhir*'))
                                    <form action="{{ route('laporan-akhir.submit', $document->id) }}" method="post"
                                        enctype="multipart/form-data">
                                @endif
                                @method('PUT')
                                @csrf
                                <div class="mb-3 row">
                                    <label for="judul_proposal" class="col-sm-2 col-form-label">Judul Proposal</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul_proposal" name="judul_proposal"
                                            value="{{ $document->judul_proposal }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="pendanaan_dikti" class="col-sm-2 col-form-label">Sumber Pendanaan
                                        DIKTI</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" class="form-control"
                                                aria-label="Amount (to the nearest dollar)" name="pendanaan_dikti"
                                                value="{{ $document->pendanaan_dikti }}" readonly>
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
                                            <input type="text" class="form-control"
                                                aria-label="Amount (to the nearest dollar)" name="pendanaan_pt"
                                                value="{{ $document->pendanaan_pt }}" readonly>
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="luaran_proposal" class="col-sm-2 col-form-label">Luaran
                                        Proposal</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="luaran_proposal"
                                            name="luaran_proposal"
                                            value="{{ $document->berkas->proposal->luaran_proposal }}" readonly>
                                    </div>
                                </div>

                                @if (Request::is('laporan-kemajuan*'))
                                    <div class="mb-3 row">
                                        <label for="luaran_laporan_kemajuan" class="col-sm-2 col-form-label">Upload
                                            Luaran
                                            Laporan
                                            Kemajuan</label>
                                        <div class="col-sm-10">
                                            <input
                                                class="form-control @error('luaran_laporan_kemajuan') is-invalid @enderror"
                                                type="file" id="luaran_laporan_kemajuan" name="luaran_laporan_kemajuan">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="laporan_kemajuan" class="col-sm-2 col-form-label">Upload
                                            Laporan
                                            Kemajuan</label>
                                        <div class="col-sm-10">
                                            <input class="form-control @error('laporan_kemajuan') is-invalid @enderror"
                                                type="file" id="laporan_kemajuan" name="laporan_kemajuan">
                                        </div>
                                    </div>
                                @endif

                                @if (Request::is('laporan-akhir*'))
                                    <div class="mb-3 row">
                                        <label for="luaran_laporan_akhir" class="col-sm-2 col-form-label">Upload
                                            Luaran Laporan Akhir</label>
                                        <div class="col-sm-10">
                                            <input class="form-control @error('luaran_laporan_akhir') is-invalid @enderror"
                                                type="file" id="luaran_laporan_akhir" name="luaran_laporan_akhir">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="laporan_akhir" class="col-sm-2 col-form-label">Upload
                                            Laporan Akhir</label>
                                        <div class="col-sm-10">
                                            <input class="form-control @error('laporan_akhir') is-invalid @enderror"
                                                type="file" id="laporan_akhir" name="laporan_akhir">
                                        </div>
                                    </div>
                                @endif

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
