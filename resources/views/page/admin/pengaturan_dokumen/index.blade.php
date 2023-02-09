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

                <h3 class="mb-3" style="color: #5D7DCF">Pengaturan Dokumen</h3>

                <div>
                    <a href="{{ route('pengaturan-dokumen.create') }}">
                        <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Tambah Dokumen
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
                                            <th>Nama File</th>
                                            <th>Jenis Surat</th>
                                            <th>Periode Akademik</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama File</th>
                                            <th>Jenis Surat</th>
                                            <th>Periode Akademik</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($documents as $document)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $document->file_name }}</td>
                                                <td>{{ $document->jenis_surat->name }}</td>
                                                <td>{{ $document->tahun_akademik->tahun . '-' . $document->tahun_akademik->term }}
                                                </td>
                                                <td style="padding: 0">
                                                    <form id="delete-document"
                                                        action="{{ route('pengaturan-dokumen.delete', $document->id) }}"
                                                        method="post" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-datatable btn-icon btn-transparent-dark"><i
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
@endsection

@push('extra_js')
    <script>
        $(document).on('submit', '[id^=delete-document]', function(ev) {
            var form = this;
            ev.preventDefault();
            swal({
                    title: "Hapus Dokumen?",
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
    </script>
@endpush
