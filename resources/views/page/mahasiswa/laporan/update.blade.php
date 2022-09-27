@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 180px">
                <div class="row">
                    <div class="col">
                        <div class="card bg-light">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="judul_proposal" class="col-sm-2 col-form-label">Judul Proposal</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="judul_proposal"
                                                name="judul_proposal" value="{{ $document->judul_proposal }}" readonly>
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
                                                    type="file" id="luaran_laporan_kemajuan"
                                                    name="luaran_laporan_kemajuan">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="file_laporan_kemajuan" class="col-sm-2 col-form-label">Upload
                                                Laporan
                                                Kemajuan</label>
                                            <div class="col-sm-10">
                                                <input
                                                    class="form-control @error('file_laporan_kemajuan') is-invalid @enderror"
                                                    type="file" id="file_laporan_kemajuan" name="file_laporan_kemajuan">
                                            </div>
                                        </div>
                                    @endif

                                    @if (Request::is('laporan-akhir*'))
                                        <div class="mb-3 row">
                                            <label for="luaran_laporan_kemajuan" class="col-sm-2 col-form-label">Upload
                                                Luaran Laporan Akhir</label>
                                            <div class="col-sm-10">
                                                <input
                                                    class="form-control @error('luaran_laporan_kemajuan') is-invalid @enderror"
                                                    type="file" id="luaran_laporan_kemajuan"
                                                    name="luaran_laporan_kemajuan">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="file_laporan_kemajuan" class="col-sm-2 col-form-label">Upload
                                                Laporan Akhir</label>
                                            <div class="col-sm-10">
                                                <input
                                                    class="form-control @error('file_laporan_kemajuan') is-invalid @enderror"
                                                    type="file" id="file_laporan_kemajuan" name="file_laporan_kemajuan">
                                            </div>
                                        </div>
                                    @endif

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
