@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 5%">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-n3" role="alert"
                        style="width: 40%; margin-left: auto; margin-right: 0;">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>
                @endif

                <h3 class="mb-3" style="color: #5D7DCF">Rekap Proposal</h3>

                <div class="card mb-4 mt-3">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Skema PKM</th>
                                    <th>Judul Pengajuan</th>
                                    <th>Nama Ketua</th>
                                    <th>NIM Ketua</th>
                                    <th>Status Review</th>
                                    <th>Hasil Evaluasi</th>
                                    <th>Keterangan</th>
                                    <th>Reviewer</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Skema PKM</th>
                                    <th>Judul Pengajuan</th>
                                    <th>Nama Ketua</th>
                                    <th>NIM Ketua</th>
                                    <th>Status Review</th>
                                    <th>Hasil Evaluasi</th>
                                    <th>Keterangan</th>
                                    <th>Reviewer</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($documents as $document)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $document['tahun'] }}</td>
                                        <td>{{ $document['skema_pkm'] }}</td>
                                        <td>{{ $document['judul_pengajuan'] }}</td>
                                        <td>{{ $document['nama_ketua'] }}</td>
                                        <td>{{ $document['nim_ketua'] }}</td>
                                        <td>
                                            <a href="#"
                                                data-proposal="{{ \App\Enums\DocumentStatus::getDescription($document['status_proposal']) }}"
                                                data-laporan_kemajuan="{{ \App\Enums\DocumentStatus::getDescription($document['status_laporan_kemajuan']) }}"
                                                data-laporan_akhir="{{ \App\Enums\DocumentStatus::getDescription($document['status_laporan_akhir']) }}"
                                                data-bs-toggle="modal" data-bs-target="#status"><i
                                                    class="fa fa-info-circle"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('daftar-usulan.review', $document['id']) }}"><i
                                                    class="fa fa-info-circle"></i></a>
                                        </td>
                                        <td>Didanai/Ditolak</td>
                                        <td style="padding: 0">
                                            <a href="{{ route('daftar-usulan.reviewer', $document['id']) }}"><i
                                                    class="fa fa-info-circle"></i></a>
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

    @include('page.admin.daftar_usulan.status')
@endsection

@push('extra_js')
    <script>
        $(document).ready(function() {
            var currentAnggota = 1;

            $('#status').on('show.bs.modal', function(event) {
                let data = $(event.relatedTarget);
                let modal = $(this);

                let status_proposal = data.data('proposal');
                let status_laporan_kemajuan = data.data('laporan_kemajuan');
                let status_laporan_akhir = data.data('laporan_akhir');

                modal.find('.modal-body #proposal').val(status_proposal);
                modal.find('.modal-body #laporan_kemajuan').val(status_laporan_kemajuan);
                modal.find('.modal-body #laporan_akhir').val(status_laporan_akhir);
            });
        })
    </script>
@endpush
