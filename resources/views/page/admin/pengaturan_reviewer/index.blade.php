@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 180px">
                <h3 class="mb-3" style="color: #5D7DCF">Pengaturan Reviewer</h3>

                <div>
                    <a href="{{ route('pengaturan-reviewer.create') }}">
                        <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Tambah User
                            <i class="fa fa-plus"></i></button>
                    </a>
                </div>

                <div class="row">
                    <div class="col-md-8">
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
                                        <tr>
                                            <td>#</td>
                                            <td></td>
                                            <td>
                                                <a href="#"><i class="fa fa-pencil"></i></a>
                                                <form action="#" method="post" class="d-inline-block">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit"><i class="ml-2 fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
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