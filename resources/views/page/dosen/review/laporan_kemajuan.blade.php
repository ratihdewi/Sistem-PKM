@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 180px">
                <h3 class="mb-3" style="color: #5D7DCF">Review Laporan Kemajuan</h3>

                <div class="row">
                    <div class="col-lg-7">
                        <div class="card" style="height: 39rem;">
                            <div class="card-header">
                                <div class="row mb-3">
                                    <div class="col">
                                        <h5>{{ $document->judul_proposal }}</h5>
                                    </div>
                                    <div class="col text-right"><i class="ml-2 fa fa-file-arrow-down fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <embed id="file_proposal" name="file_proposal"
                                    src="{{ asset("documents/proposal/{$document->berkas->proposal->file_proposal}") }}"
                                    type="application/pdf" width="100%" height="100%" readonly="">
                                </embed>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card mb-3">
                            <form method="post" action="{{ route('review.submit-laporan-kemajuan', $document->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h5>Review Laporan Kemajuan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <p>Hasil Review</p>
                                        <div class="col-md-6">
                                            <input type="radio" name="hasil_review" id="setuju" value="setuju">
                                            <label class="form-check-label" for="setuju">
                                                <p style="color: green">Setuju</p>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" name="hasil_review" id="revisi" value="revisi">
                                            <label class="form-check-label" for="revisi">
                                                <p style="color: red">Revisi</p>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <p>Komentar</p>
                                        <div class="col">
                                            <textarea class="form-control @error('komentar') is-invalid @enderror" id="komentar" name="komentar">{{ old('komentar') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <p>Upload Hasil Evaluasi</p>
                                        <div class="col">
                                            <input class="form-control @error('hasil_evaluasi') is-invalid @enderror"
                                                type="file" id="hasil_evaluasi" name="hasil_evaluasi">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <a href="#">
                                            <button type="submit" class="btn"
                                                style="background-color: #5D7DCF; color: #fff">Submit</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>Riwayat Review</h5>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
