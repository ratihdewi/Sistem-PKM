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
                                        <td>{{ $document->document_owners->data_mahasiswa->implode('nomor_induk', ', ') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('review.proposal', $document->id) }}"
                                                class="text-decoration-none">{{ $document->judul_proposal }}</a>
                                        </td>
                                        <td>
                                            <a href="#"
                                                data-proposal="{{ \App\Enums\DocumentStatus::getDescription($document->status_proposal) }}"
                                                data-laporan_kemajuan="{{ \App\Enums\DocumentStatus::getDescription($document->status_laporan_kemajuan) }}"
                                                data-laporan_akhir="{{ \App\Enums\DocumentStatus::getDescription($document->status_laporan_akhir) }}"
                                                data-bs-toggle="modal" data-bs-target="#status"><i
                                                    class="fa fa-info-circle"></i></a>
                                        </td>
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

    @include('page.dosen.review.status')
@endsection

@push('extra_js')
    <script>
        $(document).ready(function() {
            $('#status').on('show.bs.modal', function(event) {
                let data = $(event.relatedTarget);
                let modal = $(this);

                let status_proposal = data.data('proposal');
                let status_laporan_kemajuan = data.data('laporan_kemajuan');
                let status_laporan_akhir = data.data('laporan_akhir');

                let status_color = function(status, attribute_id) {
                    if (status == 'Disetujui') {
                        return modal.find(`.modal-body ${attribute_id}`).addClass(
                            'border-success text-success');
                    } else if (status == 'Revisi') {
                        return modal.find(`.modal-body ${attribute_id}`).addClass(
                            'border-danger text-danger');
                    } else {
                        return;
                    }
                }

                modal.find('.modal-body #proposal').val(status_proposal);
                status_color(status_proposal, '#proposal');
                modal.find('.modal-body #laporan_kemajuan').val(status_laporan_kemajuan);
                status_color(status_laporan_kemajuan, '#laporan_kemajuan');
                modal.find('.modal-body #laporan_akhir').val(status_laporan_akhir);
                status_color(status_laporan_akhir, '#laporan_akhir');
            })
        })
    </script>
@endpush
