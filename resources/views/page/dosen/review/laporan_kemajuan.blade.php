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
                                    <!-- Timeline Item 1-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            {{-- <div class="timeline-item-marker-text">27 min</div> --}}
                                            <div class="timeline-item-marker-indicator bg-primary"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            <i class="fa-regular fa-calendar"></i> 27/10/2022 07:40
                                            <br />
                                            <i class="fa-solid fa-pencil"></i> <a class="fw-bold text-success"> Surat
                                                Disetujui oleh, </a>
                                            Asisten Manajer Infrastruktur
                                            <br />
                                            <a class="btn btn-icon btn-transparent-dark m-0 p-0"><img class="img-fluid ml-1"
                                                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                                    style="width: 40px;" /></a>
                                            Ardhi Priagung
                                            <p style="margin: 0 0 0 50px;"><span
                                                    class="badge badge-pill badge-success m-0">Success</span></p>
                                            <span style="margin: 0 0 0 50px;"><i class="fa-solid fa-comment"></i>
                                                Setuju</span>
                                        </div>
                                    </div>
                                    <!-- Timeline Item 2-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            {{-- <div class="timeline-item-marker-text">58 min</div> --}}
                                            <div class="timeline-item-marker-indicator bg-primary"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            <i class="fa-regular fa-calendar"></i> 27/10/2022 07:40
                                            <br />
                                            <i class="fa-solid fa-pencil"></i> <a class="fw-bold text-success"> Surat
                                                Disetujui oleh, </a>
                                            Asisten Manajer Infrastruktur
                                            <br />
                                            <a class="btn btn-icon btn-transparent-dark m-0 p-0"><img class="img-fluid ml-1"
                                                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                                    style="width: 40px;" /></a>
                                            Ardhi Priagung
                                            <p style="margin: 0 0 0 50px;"><span
                                                    class="badge badge-pill badge-success m-0">Success</span></p>
                                            <span style="margin: 0 0 0 50px;"><i class="fa-solid fa-comment"></i>
                                                Setuju</span>
                                        </div>
                                    </div>
                                    <!-- Timeline Item 3-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            {{-- <div class="timeline-item-marker-text">2 hrs</div> --}}
                                            <div class="timeline-item-marker-indicator bg-primary"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            <i class="fa-regular fa-calendar"></i> 27/10/2022 07:40
                                            <br />
                                            <i class="fa-solid fa-pencil"></i> <a class="fw-bold text-success"> Surat
                                                Disetujui oleh, </a>
                                            Asisten Manajer Infrastruktur
                                            <br />
                                            <a class="btn btn-icon btn-transparent-dark m-0 p-0"><img
                                                    class="img-fluid ml-1"
                                                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                                    style="width: 40px;" /></a>
                                            Ardhi Priagung
                                            <p style="margin: 0 0 0 50px;"><span
                                                    class="badge badge-pill badge-success m-0">Success</span></p>
                                            <span style="margin: 0 0 0 50px;"><i class="fa-solid fa-comment"></i>
                                                Setuju</span>
                                        </div>
                                    </div>
                                    <!-- Timeline Item 4-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            {{-- <div class="timeline-item-marker-text">1 day</div> --}}
                                            <div class="timeline-item-marker-indicator bg-primary"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            <i class="fa-regular fa-calendar"></i> 27/10/2022 07:40
                                            <br />
                                            <i class="fa-solid fa-pencil"></i> <a class="fw-bold text-success"> Surat
                                                Disetujui oleh, </a>
                                            Asisten Manajer Infrastruktur
                                            <br />
                                            <a class="btn btn-icon btn-transparent-dark m-0 p-0"><img
                                                    class="img-fluid ml-1"
                                                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                                    style="width: 40px;" /></a>
                                            Ardhi Priagung
                                            <p style="margin: 0 0 0 50px;"><span
                                                    class="badge badge-pill badge-success m-0">Success</span></p>
                                            <span style="margin: 0 0 0 50px;"><i class="fa-solid fa-comment"></i>
                                                Setuju</span>
                                        </div>
                                    </div>
                                    <!-- Timeline Item 5-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            {{-- <div class="timeline-item-marker-text">1 day</div> --}}
                                            <div class="timeline-item-marker-indicator bg-primary"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            <i class="fa-regular fa-calendar"></i> 27/10/2022 07:40
                                            <br />
                                            <i class="fa-solid fa-pencil"></i> <a class="fw-bold text-success"> Surat
                                                Disetujui oleh, </a>
                                            Asisten Manajer Infrastruktur
                                            <br />
                                            <a class="btn btn-icon btn-transparent-dark m-0 p-0"><img
                                                    class="img-fluid ml-1"
                                                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                                    style="width: 40px;" /></a>
                                            Ardhi Priagung
                                            <p style="margin: 0 0 0 50px;"><span
                                                    class="badge badge-pill badge-success m-0">Success</span></p>
                                            <span style="margin: 0 0 0 50px;"><i class="fa-solid fa-comment"></i>
                                                Setuju</span>
                                        </div>
                                    </div>
                                    <!-- Timeline Item 6-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            {{-- <div class="timeline-item-marker-text">1 day</div> --}}
                                            <div class="timeline-item-marker-indicator bg-primary"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            <i class="fa-regular fa-calendar"></i> 27/10/2022 07:40
                                            <br />
                                            <i class="fa-solid fa-pencil"></i> <a class="fw-bold text-success"> Surat
                                                Disetujui oleh, </a>
                                            Asisten Manajer Infrastruktur
                                            <br />
                                            <a class="btn btn-icon btn-transparent-dark m-0 p-0"><img
                                                    class="img-fluid ml-1"
                                                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                                    style="width: 40px;" /></a>
                                            Ardhi Priagung
                                            <p style="margin: 0 0 0 50px;"><span
                                                    class="badge badge-pill badge-success m-0">Success</span></p>
                                            <span style="margin: 0 0 0 50px;"><i class="fa-solid fa-comment"></i>
                                                Setuju</span>
                                        </div>
                                    </div>
                                    <!-- Timeline Item 7-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            {{-- <div class="timeline-item-marker-text">2 days</div> --}}
                                            <div class="timeline-item-marker-indicator bg-primary"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            <i class="fa-regular fa-calendar"></i> 27/10/2022 07:40
                                            <br />
                                            <i class="fa-solid fa-pencil"></i> <a class="fw-bold text-success"> Surat
                                                Disetujui oleh, </a>
                                            Asisten Manajer Infrastruktur
                                            <br />
                                            <a class="btn btn-icon btn-transparent-dark m-0 p-0"><img
                                                    class="img-fluid ml-1"
                                                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                                    style="width: 40px;" /></a>
                                            Ardhi Priagung
                                            <p style="margin: 0 0 0 50px;"><span
                                                    class="badge badge-pill badge-success m-0">Success</span></p>
                                            <span style="margin: 0 0 0 50px;"><i class="fa-solid fa-comment"></i>
                                                Setuju</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
