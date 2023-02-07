@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 5%">
                <h3 class="mb-3" style="color: #5D7DCF">Review Proposal</h3>

                <form method="post" action="{{ route('review.submit-proposal', $document->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-5">
                        <div class="col-lg-8">
                            <div class="mb-3 row">
                                <label for="skema_pkm" class="col-sm-4 col-form-label">Skema PKM</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ $document->skema_pkm->name }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="judul_proposal" class="col-sm-4 col-form-label">Judul Proposal</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ $document->judul_proposal }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nama_ketua" class="col-sm-4 col-form-label">Nama Ketua</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ $data_ketua->name }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="anggota" class="col-sm-4 col-form-label">Anggota</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control"
                                        value="{{ $data_anggota->implode('name', ', ') }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="dosen_pendamping" class="col-sm-4 col-form-label">Dosen Pendamping</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control"
                                        value="{{ $document->document_owners->data_dosen->name }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="pendanaan_dikti" class="col-sm-4 col-form-label">Sumber Pendanaan
                                    DIKTI</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)"
                                            value="{{ $document->pendanaan_dikti }}" readonly>
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="pendanaan_pt" class="col-sm-4 col-form-label">Sumber Pendanaan
                                    PT</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)"
                                            value="{{ $document->pendanaan_pt }}" readonly>
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="luaran_proposal" class="col-sm-4 col-form-label">Luaran
                                    Proposal</label>
                                <div class="col-sm-8">
                                    <textarea type="text" class="form-control" readonly>{{ $document->berkas->proposal->luaran_proposal }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <h5 class="mb-3">Kesalahan Proposal</h5>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="kreativitas" name="kreativitas"
                                    {{ $document->document_checks->kreativitas != 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="kreativitas">
                                    Kreativitas
                                </label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="bidang_pkm" name="bidang_pkm"
                                    {{ $document->document_checks->bidang_pkm != 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="bidang_pkm">
                                    Bidang PKM
                                </label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="kelengkapan_dokumen"
                                    name="kelengkapan_dokumen"
                                    {{ $document->document_checks->kelengkapan_dokumen != 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="kelengkapan_dokumen">
                                    Kelengkapan Dokumen
                                </label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="personalia_pendamping"
                                    name="personalia_pendamping"
                                    {{ $document->document_checks->personalia_pendamping != 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="personalia_pendamping">
                                    Personalia dan Pendamping
                                </label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="dana_pendamping"
                                    name="dana_pendamping"
                                    {{ $document->document_checks->dana_pendamping != 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="dana_pendamping">
                                    Dana Pendamping Perguruan Tinggi
                                </label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="luaran" name="luaran"
                                    {{ $document->document_checks->luaran != 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="luaran">
                                    Luaran
                                </label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="format_inti" name="format_inti"
                                    {{ $document->document_checks->format_inti != 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="format_inti">
                                    Format Inti
                                </label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="format_pendukung"
                                    name="format_pendukung"
                                    {{ $document->document_checks->format_pendukung != 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="format_pendukung">
                                    Format Pendukung
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
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
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5>Review Proposal</h5>
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
                                                            <a
                                                                href="{{ route('download-hasil-evaluasi', ['path' => 'proposal', 'file' => $comment['file_evaluasi']]) }}">{{ $comment['file_evaluasi'] }}</a></span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection
