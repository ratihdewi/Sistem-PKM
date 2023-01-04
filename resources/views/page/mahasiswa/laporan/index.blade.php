@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 5%">
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
                                        <td> <a href="{{ route('laporan.show', $document->id) }}"
                                                class="text-decoration-none">{{ $document->judul_proposal }}</a></td>
                                        <td>Rp. {{ number_format($document->pendanaan_pt, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($document->pendanaan_dikti, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($document->status_laporan_kemajuan === 'not_submitted')
                                                <div class="mb-3">
                                                    <a href="{{ route('laporan-kemajuan.create', $document->id) }}"
                                                        @if ($document->status_proposal !== 'approved') style="pointer-events: none" @endif>
                                                        <button type="button"
                                                            class="btn {{ $document->status_proposal !== 'approved' ? 'disabled' : '' }}"
                                                            style="background-color: #5D7DCF; color: #fff">Ajukan Laporan
                                                            Kemajuan
                                                        </button>
                                                    </a>
                                                </div>
                                            @else
                                                {{ \App\Enums\DocumentStatus::getDescription($document->status_laporan_kemajuan) }}
                                            @endif
                                        </td>
                                        <td style="padding: 0">
                                            <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                                href="{{ route('laporan-kemajuan.edit', $document->id) }}"
                                                @if ($document->status_laporan_kemajuan === 'not_submitted') style="opacity: 0.5; cursor: default; pointer-events: none" @endif><i
                                                    class="fa fa-pencil"></i></a>
                                            <form id="delete-laporan-kemajuan"
                                                action="{{ route('laporan-kemajuan.delete', $document->id) }}"
                                                method="post" class="d-inline-block"
                                                @if ($document->status_laporan_kemajuan === 'not_submitted') style="opacity: 0.5; cursor: default; pointer-events: none" @endif>
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-datatable btn-icon btn-transparent-dark"
                                                    type="submit"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                        <td>
                                            @if ($document->status_laporan_akhir === 'not_submitted')
                                                <div class="mb-3">
                                                    <a href="{{ route('laporan-akhir.create', $document->id) }}"
                                                        @if ($document->status_laporan_kemajuan !== 'approved') style="pointer-events: none" @endif>
                                                        <button type="button"
                                                            class="btn {{ $document->status_laporan_kemajuan !== 'approved' ? 'disabled' : '' }}"
                                                            style="background-color: #5D7DCF; color: #fff"
                                                            aria-disabled="true">Ajukan Laporan
                                                            Akhir
                                                        </button>
                                                    </a>
                                                </div>
                                            @else
                                                {{ \App\Enums\DocumentStatus::getDescription($document->status_laporan_akhir) }}
                                            @endif
                                        </td>
                                        <td style="padding: 0">
                                            <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                                href="{{ route('laporan-akhir.edit', $document->id) }}"
                                                @if ($document->status_laporan_akhir === 'not_submitted') style="opacity: 0.5; cursor: default; pointer-events: none" @endif><i
                                                    class="fa fa-pencil"></i></a>
                                            <form id="delete-laporan-akhir"
                                                action="{{ route('laporan-akhir.delete', $document->id) }}" method="post"
                                                class="d-inline-block"
                                                @if ($document->status_laporan_akhir === 'not_submitted') style="opacity: 0.5; cursor: default; pointer-events: none" @endif>
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-datatable btn-icon btn-transparent-dark"
                                                    type="submit"><i class="fa fa-trash"></i></button>
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

@push('extra_js')
    <script>
        $(document).on('submit', '[id^=delete-laporan-kemajuan]', function(ev) {
            var form = this;
            ev.preventDefault();
            swal({
                    title: "Hapus Laporan Kemajuan?",
                    text: "Laporan kemajuan akan terhapus secara permanen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        return form.submit();
                    } else {
                        return false;
                    }
                });
        })

        $(document).on('submit', '[id^=delete-laporan-akhir]', function(ev) {
            var form = this;
            ev.preventDefault();
            swal({
                    title: "Hapus Laporan Akhir?",
                    text: "Laporan akhir akan terhapus secara permanen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        return form.submit();
                    } else {
                        return false;
                    }
                });
        })
    </script>
@endpush
