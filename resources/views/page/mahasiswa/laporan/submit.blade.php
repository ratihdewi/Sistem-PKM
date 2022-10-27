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
                                <input type="hidden" name="key" value="{{ $key }}">

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
                                        <textarea type="text" class="form-control" id="luaran_proposal" name="luaran_proposal" readonly>{{ $document->berkas->proposal->luaran_proposal }}</textarea>
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

                                <!-- INI TUH INPUTNTYA YER-->
                                <div class="mb-3 row">
                                    <label for="pendanaan_pt" class="col-sm-11 col-form-label">Rincian Pengeluaran</label>
                                    <div class="col-sm-1">
                                        <button class="btn btn-transparent-dark" type="button" data-bs-toggle="modal"
                                            data-bs-target="#pengeluaran"><i class="ml-2 fa fa-plus fa-2x"></i></button>
                                    </div>
                                </div>
                                <!-- INI TUH TABELNYA -->
                                <div class="mb-3 row">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Deskripsi Item</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Harga Satuan</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Bukti Transaksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Deskripsi Item</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Harga Satuan</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Bukti Transaksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody id="budget-table">
                                            @foreach ($budgets as $budget)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $budget->deskripsi_item }}</td>
                                                    <td>{{ $budget->jumlah }}</td>
                                                    <td>Rp. {{ number_format($budget->harga_satuan, 0, ',', '.') }}</td>

                                                    <td>Rp.
                                                        {{ number_format((string) ((int) $budget->jumlah * (int) $budget->harga_satuan), 0, ',', '.') }}
                                                    </td>
                                                    <td>{{ $budget->bukti_transaksi }}</td>
                                                </tr>
                                            @endforeach
                                            {{-- <tr>
                                                <th scope="row"></th>
                                                <td><strong>Total</strong></td>
                                                <td></td>
                                                <td></td>
                                                <td><strong>-----</strong></td>
                                                <td></td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
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

    <!-- Modal -->
    <div class="modal fade" id="pengeluaran" tabindex="-1" aria-labelledby="pengeluaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form method="post" action="{{ route('pengeluaran') }}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="document_id" value="{{ $document->id }}">

                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Deskripsi Item</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="deskripsi_item" name="deskripsi_item"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Jumlah</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="jumlah" name="jumlah"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)" id="harga_satuan"
                                            name="harga_satuan" autocomplete="off">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="bukti_transaksi" class="form-label">Bukti Transaksi</label>
                                <div class="form-group">
                                    <input class="form-control" type="file" id="bukti_transaksi"
                                        name="bukti_transaksi" autocomplete="off" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
