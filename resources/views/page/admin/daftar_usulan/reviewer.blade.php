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

                <div>
                    <a href="#" data-document-id="{{ $document->id }}" data-bs-toggle="modal"
                        data-bs-target="#add-reviewer">
                        <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Tambah Reviewer
                            <i class="fa fa-plus"></i></button>
                    </a>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4 mt-3">
                            <div class="card-body">
                                <table id="datatablesSimple">
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
                                        @foreach ($reviewers as $reviewer)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $reviewer->name }}</td>
                                                <td style="padding: 0">
                                                    <form id="delete-reviewer"
                                                        action="{{ route('daftar-usulan.delete-reviewer') }}" method="post"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="hidden" name="document_id"
                                                            value="{{ $document->id }}">
                                                        <input type="hidden" name="reviewer_id"
                                                            value="{{ $reviewer->id }}">

                                                        <button type="submit"
                                                            class="btn btn-datatable btn-icon btn-transparent-dark"
                                                            @if (array_search($reviewer->name, array_column($proposal_comments, 'reviewer')) !== false) style="opacity: 0.5; cursor: default; pointer-events: none" @endif><i
                                                                class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('page.admin.daftar_usulan.add_reviewer')
@endsection

@push('extra_js')
    <script>
        $(document).ready(function() {
            var currentAnggota = 1;

            $('#add-reviewer').on('show.bs.modal', function(event) {
                let data = $(event.relatedTarget);
                let modal = $(this);

                let document_id = data.data('document-id');

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

            $(document).on('submit', '[id^=delete-reviewer]', function(ev) {
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
