@extends('layout.main')

@if (count($errors) > 0)
    @push('script_before_start')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#reviewer_create').modal('show');
            });
        </script>
    @endpush
@endif

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 5%">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show my-n3" role="alert"
                        style="width: 40%; margin-left: auto; margin-right: 0;">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>
                @endif

                <h3 class="mb-3" style="color: #5D7DCF">Pengaturan Reviewer</h3>

                <div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#reviewer_create">
                        <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Tambah User
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
                                            <th>Nama Dosen</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dosen</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($reviewers as $reviewer)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $reviewer->name }}</td>
                                                <td style="padding: 0">
                                                    <form action="{{ route('pengaturan-reviewer.delete', $reviewer->id) }}"
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

    @include('page.admin.pengaturan_reviewer.create', ['data_dosen' => $data_dosen])
@endsection
