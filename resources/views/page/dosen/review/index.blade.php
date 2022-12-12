@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 5%">
                <div>
                    <button type="button" class="btn mt-3" style="background-color: #5D7DCF; color: #fff">Sort By <i
                            class="fa fa-caret-down"></i></button>
                </div>

                <div class="card mb-4 mt-3">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Skema</th>
                                    <th>Nama Pengusul</th>
                                    <th>NIM Pengusul</th>
                                    <th>Judul Proposal</th>
                                    <th>Status</th>
                                    <th>Laporan Kemajuan</th>
                                    <th>Laporan Akhir</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Skema</th>
                                    <th>Nama Pengusul</th>
                                    <th>NIM Pengusul</th>
                                    <th>Judul Proposal</th>
                                    <th>Status</th>
                                    <th>Laporan Kemajuan</th>
                                    <th>Laporan Akhir</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($documents as $document)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $document->created_at->format('Y') }}</td>
                                        <td>{{ $document->skema_pkm->name }}</td>
                                        <td>{{ $document->document_owners->data_mahasiswa->implode('name', ', ') }}</td>
                                        <td>{{ $document->document_owners->data_mahasiswa->implode('username', ', ') }}</td>
                                        <td>
                                            <a href="{{ route('review.proposal', $document->id) }}"
                                                class="text-decoration-none">{{ $document->judul_proposal }}</a>
                                        </td>
                                        <td></td>
                                        <td>
                                            @if ($document->status_laporan_kemajuan !== 'not_submitted')
                                                <a href="{{ route('review.laporan-kemajuan', $document->id) }}"><i
                                                        class="fa fa-file-circle-question"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($document->status_laporan_akhir !== 'not_submitted')
                                                <a href="{{ route('review.laporan-akhir', $document->id) }}"><i
                                                        class="fa fa-file-circle-question"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
