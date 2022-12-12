@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 4%">
                <h3 class="mb-3" style="color: #5D7DCF">Rekap Proposal</h3>

                <div>
                    <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Sort By <i
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
                                    <th>Nama Ketua</th>
                                    <th>NIM</th>
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
                                    <th>Skema</th>
                                    <th>Judul Pengajuan</th>
                                    <th>Nama Ketua</th>
                                    <th>NIM</th>
                                    <th>Status Review</th>
                                    <th>Hasil Evaluasi</th>
                                    <th>Keterangan</th>
                                    <th>Reviewer</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2022</td>
                                    <td>PKM-XX</td>
                                    <td>ABCDEFGH</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td></td>
                                    <td></td>
                                    <td>Didanai/Ditolak</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
