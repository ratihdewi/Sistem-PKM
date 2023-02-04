@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 5%">
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Proposal</h5>
                            </div>
                            <div class="card-body">
                                <div class="timeline timeline-xs">
                                    @foreach ($proposal_comments as $comment)
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

                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Laporan Kemajuan</h5>
                            </div>
                            <div class="card-body">
                                <div class="timeline timeline-xs">
                                    @foreach ($laporan_kemajuan_comments as $comment)
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

                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Laporan Akhir</h5>
                            </div>
                            <div class="card-body">
                                <div class="timeline timeline-xs">
                                    @foreach ($laporan_akhir_comments as $comment)
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

                <div>
                    <a href="{{ route('daftar-usulan.index') }}">
                        <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Back</button>
                    </a>
                </div>

                {{-- <div class="mt-4 mb-5 text-center">
                    <form action="{{ route('logout.post') }}" method="post">
                        @csrf
                        <button type="submit" class="btn" style="background-color: #5D7DCF; color: #fff">Sign
                            Out</button>
                    </form>
                </div> --}}
            </div>
        </main>
    </div>
@endsection
