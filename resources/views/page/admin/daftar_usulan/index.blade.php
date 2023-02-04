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
                                            <a href="#"><i class="fa fa-info-circle"></i></a>
                                        </td>
                                        <td>Didanai/Ditolak</td>
                                        <td style="padding: 0">
                                            <a href="#" data-id="{{ $document['id'] }}"
                                                data-reviewers="{{ $document['data_reviewer'] }}" data-bs-toggle="modal"
                                                data-bs-target="#reviewer_info"><i class="fa fa-info-circle"></i></a>
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
    @include('page.admin.daftar_usulan.reviewer_info')
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

            $('#reviewer_info').on('show.bs.modal', function(event) {
                let data = $(event.relatedTarget);
                let modal = $(this);

                let document_id = data.data('id');
                let reviewers = (!data.data('reviewers')?.length ? data.data('reviewers') : JSON.parse(data
                    .data('reviewers').replace(/(&quot\;)/g, "\"")));
                console.log(reviewers);

                modal.find('.modal-body #reviewerTable').html(`
                    <table id="modalDatatable">
                    </table>
                `);

                let url = "{{ route('daftar-usulan.document', ':document_id') }}";
                url = url.replace(':document_id', document_id);

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        let result = JSON.parse(data.proposal_comments)
                        console.log(result);

                        modal.find('.modal-body #modalDatatable').empty().append(`
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Reviewer</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Reviewer</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                ${reviewers.map(function(item, index) {  
                                    const checkName = (obj) => obj.reviewer == item.name;
                                    const resultCheck = result.some(checkName);
                                    
                                    let disabledStyle = resultCheck ? 'style="opacity: 0.5; cursor: default; pointer-events: none"' : '';
                                    let reviewer_id = `<input id="reviewer_id" type="hidden" name="reviewer_id" value="${item.id}">`;
                                    let reviewer_name = `<input id="reviewer_name" type="hidden" name="reviewer_name" value="${item.name}">`;
                                    let delete_button = `<button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark" ${disabledStyle}><i class="fa-solid fa-trash"></i></button>`;         
                                    let form = `<form id="delete_reviewer" method="post" action="{{ route('daftar-usulan.delete-reviewer') }}">@method('DELETE') @csrf <input id="document_id" type="hidden" name="document_id" value="${document_id}"> ${reviewer_id} ${reviewer_name} ${delete_button}</form>`;

                                    return `<tr><td>${index + 1}</td><td>${item.name}</td><td>${form}</td></tr>`
                                })}
                            </tbody>                
                        `);

                        const modalDatatable = document.getElementById("modalDatatable");
                        let dataTable = new simpleDatatables.DataTable(modalDatatable);
                    },
                });
                modal.find('.modal-body #document_id').val(document_id);
            });

            $('#add_anggota').on('click', function() {
                currentAnggota++;

                $.ajax({
                    type: 'GET',
                    url: "{{ route('daftar-usulan.reviewers') }}",
                    success: function(data) {
                        console.log(data);
                        $('div[id=reviewer]').append(`
                            <div class="mb-3 row reviewer">
                                <label for="anggota_` + currentAnggota +
                            `" class="col-sm-3 col-form-label">Anggota ${currentAnggota.toString()}</label>
                                <div class="col-sm-7">                                    
                                    <select class="form-select" name="anggota[]">
                                        ${data.map(function(item) {
                                            return `<option value="${item.id}">${item.name}</option>`
                                        })}
                                    </select>
                                </div>
                            </div>
                        `);
                    },
                });
            });

            $(document).on('submit', '[id^=delete_reviewer]', function(ev) {
                var form = this;
                ev.preventDefault();
                swal({
                        title: "Hapus Reviewer?",
                        text: "Data akan terhapus secara permanen!",
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
        })
    </script>
@endpush
