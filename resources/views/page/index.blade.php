@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            @can('mahasiswa')
                <div class="container-fluid px-4" style="margin-top: 5%">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h6>Pengusul Program Kreativitas Mahasiswa </h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-1 row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="nama"
                                            value="{{ auth()->user()->name }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="nim"
                                            value="{{ auth()->user()->nomor_induk }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="prodi"
                                            value="{{ auth()->user()->prodi->name }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="peran" class="col-sm-2 col-form-label">Peran</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="peran"
                                            value="{{ $peran }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mt-4">
                        <div class="card card-header-actions h-100">
                            <div class="card-header">
                                <h6>Informasi dan Pengumuman</h6>
                            </div>
                            <div class="card-body">
                                <div class="timeline  timeline-xs">
                                    @foreach ($pengumuman as $item)
                                        <div class="timeline-item">
                                            <div class="timeline-item-marker">
                                                <div class="timeline-item-marker-text">{{ $item->created_at->diffForHumans() }}
                                                </div>
                                                <div class="timeline-item-marker-indicator bg-primary"></div>
                                            </div>
                                            <div class="timeline-item-content">
                                                {!! $item->text !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elsecan('dosen')
                <div class="container-fluid px-4" style="margin-top: 5%">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h6>Dokumen</h6>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nama File</th>
                                            <th>Jenis Surat</th>
                                            <th>Periode Akademik</th>
                                            <th>Unduh</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama File</th>
                                            <th>Jenis Surat</th>
                                            <th>Periode Akademik</th>
                                            <th>Unduh</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($dokumen as $item)
                                            <tr>
                                                <td>{{ $item->file_name }}</td>
                                                <td>{{ $item->jenis_surat->name }}</td>
                                                <td>{{ "{$item->tahun_akademik->tahun}-{$item->tahun_akademik->term}" }}</td>
                                                <td>
                                                    <a href="{{ route('download-activity-document', $item->file_sk) }}"><i
                                                            class="ml-2 fa fa-file-arrow-down fa-3x"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col mt-4">
                        <div class="card card-header-actions h-100">
                            <div class="card-header">
                                <h6>Informasi dan Pengumuman</h6>
                            </div>
                            <div class="card-body">
                                <div class="timeline timeline-xs">
                                    @foreach ($pengumuman as $item)
                                        <div class="timeline-item">
                                            <div class="timeline-item-marker">
                                                <div class="timeline-item-marker-text">{{ $item->created_at->diffForHumans() }}
                                                </div>
                                                <div class="timeline-item-marker-indicator bg-primary"></div>
                                            </div>
                                            <div class="timeline-item-content">
                                                {!! $item->text !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="container-fluid px-4" style="margin-top: 5%">
                    <h3 class="mb-3" style="color: #5D7DCF">Rekap Proposal</h3>

                    <div class="card mb-4 mt-3">
                        {{-- <div class="card-header">
                            <h5>Rekap Berdasarkan Skema PKM</h5>
                        </div> --}}
                        <div class="card-body">
                            <div class="row" id="rekap_skema_pkm_highchart"></div>
                            <div class="row mt-3">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun</th>
                                            <th>Jenis</th>
                                            <th>Skema</th>
                                            <th>Jumlah Usulan</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun</th>
                                            <th>Jenis</th>
                                            <th>Skema</th>
                                            <th>Jumlah Usulan</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($skema_pkm as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->created_at->format('Y') }}</td>
                                                <td>{{ $item->jenis_pkm->name }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->jumlah_usulan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 mt-3">
                        {{-- <div class="card-header">
                            <h5>Rekap Berdasarkan Prodi</h5>
                        </div> --}}
                        <div class="card-body">
                            <div class="row" id="rekap_prodi_highchart"></div>
                            <div class="row mt-3">
                                <table id="datatablesSimple2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun</th>
                                            <th>Prodi</th>
                                            <th>Jumlah Usulan</th>
                                            <th>Jumlah Mahasiswa</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun</th>
                                            <th>Prodi</th>
                                            <th>Jumlah Usulan</th>
                                            <th>Jumlah Mahasiswa</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($prodi as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->created_at->format('Y') }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->jumlah_usulan }}</td>
                                                <td>{{ $item->jumlah_peserta }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </main>
    </div>
@endsection

@push('extra_js')
    @can('admin')
        <script type="text/javascript">
            var skema_pkm = <?php echo json_encode($skema_pkm); ?>;
            let jenis_pkm = function(skema_pkm, value) {
                var jenis_pkm = skema_pkm.filter(function(item) {
                    return item.jenis_pkm.name === value;
                });

                return {
                    name: value,
                    y: jenis_pkm.length,
                    drilldown: value.toLowerCase(),
                };
            };
            let skema_pkm_data = (value) => skema_pkm.filter(function(item) {
                return item.jenis_pkm.name === value;
            }).map(function(item) {
                return [item.name, item.jumlah_usulan];
            });

            Highcharts.chart('rekap_skema_pkm_highchart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Rekap Berdasarkan Skema PKM'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Jumlah'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
                series: [{
                    name: 'Skema',
                    colorByPoint: true,
                    data: [
                        jenis_pkm(skema_pkm, 'PKM 8 Bidang'),
                        jenis_pkm(skema_pkm, 'PKM Artikel Ilmiah'),
                        jenis_pkm(skema_pkm, 'PKM Gagasan Futuristik Tertulis')
                    ]
                }],
                drilldown: {
                    series: [{
                        name: 'Usulan',
                        id: "PKM 8 Bidang".toLowerCase(),
                        data: skema_pkm_data('PKM 8 Bidang')
                    }, {
                        name: 'Usulan',
                        id: "PKM Artikel Ilmiah".toLowerCase(),
                        data: skema_pkm_data('PKM Artikel Ilmiah')
                    }, {
                        name: 'Usulan',
                        id: "PKM Gagasan Futuristik Tertulis".toLowerCase(),
                        data: skema_pkm_data('PKM Gagasan Futuristik Tertulis')
                    }]
                },
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        }
                    }]
                }
            });

            var prodi = <?php echo json_encode($prodi); ?>;
            let prodi_name = prodi.map(function(item) {
                return item.name;
            });
            let jumlah_usulan = prodi.map(function(item) {
                return item.jumlah_usulan;
            });
            let jumlah_peserta = prodi.map(function(item) {
                return item.jumlah_peserta;
            });

            Highcharts.chart('rekap_prodi_highchart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Rekap Berdasarkan Prodi'
                },
                xAxis: {
                    categories: prodi_name
                },
                yAxis: {
                    title: {
                        text: 'Jumlah'
                    }
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
                series: [{
                    name: 'Usulan',
                    data: jumlah_usulan
                }, {
                    name: 'Peserta',
                    data: jumlah_peserta
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        }
                    }]
                }
            });
        </script>
    @endcan
@endpush
