@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 180px">
                <h3 class="mb-3" style="color: #5D7DCF">Review Laporan Akhir</h3>

                <div class="row">
                    <div class="col-lg-7">
                        <div class="card" style="height: 39rem;">
                            <div class="card-header">
                                <div class="row mb-3">
                                    <div class="col">
                                        <h5>{{ $document->judul_proposal }}</h5>
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
                            <form method="post" action="{{ route('review.submit-laporan-akhir', $document->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h5>Review Laporan Akhir</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <p>Hasil Review</p>
                                        <div class="col-md-6">
                                            <input type="radio" name="hasil_review" id="approved" value="approved">
                                            <label class="form-check-label" for="approved">
                                                <p style="color: green">Setuju</p>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" name="hasil_review" id="revision" value="revision">
                                            <label class="form-check-label" for="revision">
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
                                <div class="timeline timeline-xs">
                                    @foreach ($comments as $comment)
                                        <div class="timeline-item">
                                            <div class="timeline-item-marker">
                                                {{-- <div class="timeline-item-marker-text">27 min</div> --}}
                                                <div class="timeline-item-marker-indicator bg-primary"></div>
                                            </div>
                                            <div class="timeline-item-content">
                                                <i class="fa-regular fa-calendar"></i> {{ $comment['waktu'] }}
                                                {{-- <br />
                                                <i class="fa-solid fa-pencil"></i> <a class="fw-bold text-success">
                                                    Surat
                                                    Disetujui oleh, </a>
                                                Asisten Manajer Infrastruktur --}}
                                                <br />
                                                <a class="btn btn-icon btn-transparent-dark m-0 p-0"><img
                                                        class="img-fluid ml-1"
                                                        src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                                        style="width: 40px;" /></a>
                                                {{ $comment['reviewer'] }}
                                                @if ($comment['status'] === 'Disetujui')
                                                    <p style="margin: 0 0 0 50px;"><span
                                                            class="badge badge-pill badge-success m-0">{{ $comment['status'] }}</span>
                                                    </p>
                                                @else
                                                    <p style="margin: 0 0 0 50px;"><span
                                                            class="badge badge-pill badge-danger m-0">{{ $comment['status'] }}</span>
                                                    </p>
                                                @endif
                                                <span style="margin: 0 0 0 50px;"><i class="fa-solid fa-comment"></i>
                                                    {{ $comment['komentar'] }}</span>
                                                @if ($comment['file_evaluasi'] !== null)
                                                    <br>
                                                    <span style="margin: 0 0 0 50px;"><i class="fa-solid fa-file"></i>
                                                        {{ $comment['file_evaluasi'] }}
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
