@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 180px">
                @if ($documents->count() > 0)
                    <div class="mb-3">
                        <a href="#">
                            <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Pengajuan
                                Laporan
                                Kemajuan
                            </button>
                        </a>
                    </div>
                    <div class="mb-3">
                        <a href="#">
                            <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Pengajuan
                                Laporan
                                Akhir
                            </button>
                        </a>
                    </div>
                @endif

                <div class="card mb-4 mt-3">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Skema</th>
                                    <th>Judul Pengajuan</th>
                                    <th>Dana disetujui PT</th>
                                    <th>Dana disetujui Dikti</th>
                                    <th>Status Laporan Kemajuan</th>
                                    <th>Aksi</th>
                                    <th>Status Laporan Akhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Skema</th>
                                    <th>Judul Pengajuan</th>
                                    <th>Dana disetujui PT</th>
                                    <th>Dana disetujui Dikti</th>
                                    <th>Status Laporan Kemajuan</th>
                                    <th>Aksi</th>
                                    <th>Status Laporan Akhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($documents as $document)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $document->created_at->format('Y') }}</td>
                                        <td>{{ $document->skema_pkm->name }}</td>
                                        <td> <a href="{{ route('laporan-kemajuan.show', $document->id) }}"
                                                class="text-decoration-none">{{ $document->judul_proposal }}</a></td>
                                        <td>Rp. {{ number_format($document->pendanaan_pt, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($document->pendanaan_dikti, 0, ',', '.') }}</td>
                                        <td>{{ $document->status_laporan_kemajuan === 'submitted' ? 'Sudah Submit' : '' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('laporan-kemajuan.edit', $document->id) }}"><i
                                                    class="fa fa-pencil"></i></a>
                                            <form action="{{ route('laporan-kemajuan.destroy', $document->id) }}"
                                                method="post" class="d-inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"><i class="ml-2 fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                        <td></td>
                                        <td>
                                            <a href="{{ route('laporan-akhir.edit', $document->id) }}"><i
                                                    class="fa fa-pencil"></i></a>
                                            <form action="#" method="post" class="d-inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"><i class="ml-2 fa fa-trash"></i></button>
                                            </form>
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
