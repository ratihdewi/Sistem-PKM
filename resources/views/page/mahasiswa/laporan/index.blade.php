@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 180px">
                <div class="mb-3">
                    <a href="#">
                        <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Pengajuan Laporan
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
                <div>
                    <button type="button" class="btn mt-2" style="background-color: #5D7DCF; color: #fff">Sort By <i
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
                                <tr>
                                    <td>#</td>
                                    <td>2022</td>
                                    <td>PKM-XX</td>
                                    <td>ABCDE</td>
                                    <td>Rp. xxx.xxx.xxx</td>
                                    <td>Rp. xxx.xxx.xxx</td>
                                    <td></td>
                                    <td>
                                        <a href="#"><i class="fa fa-pencil"></i></a>
                                        <form action="#" method="post" class="d-inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"><i class="ml-2 fa fa-trash"></i></button>
                                        </form>
                                    </td>
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
        </main>
    </div>
@endsection
