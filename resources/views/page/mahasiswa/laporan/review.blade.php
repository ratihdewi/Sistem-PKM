@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 4%">
                <div class="mb-3">
                    <h3 class="mb-3" style="color: #5D7DCF">Review Laporan Kemajuan</h3>
                    @if ($document->status_laporan_kemajuan === 'not_submitted')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3" style="color: #5D7DCF">Anda belum mengajukan Laporan Kemajuan</h5>
                            </div>
                        </div>
                    @else
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <div class="card" style="height: 39rem;">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col">
                                                <h5>{{ $document->judul_proposal }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <embed id="file_proposal" name="file_proposal"
                                            src="{{ asset("documents/laporan_kemajuan/{$document->berkas->laporan_kemajuan->file_laporan_kemajuan}") }}"
                                            type="application/pdf" width="100%" height="100%" readonly="">
                                        </embed>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card" style="height: 39rem;">
                                    <div class="card-header">
                                        <h5>Riwayat Review</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="timeline timeline-xs">
                                            @foreach ($comments_laporan_kemajuan as $comment)
                                                <div class="timeline-item">
                                                    <div class="timeline-item-marker">
                                                        {{-- <div class="timeline-item-marker-text">27 min</div> --}}
                                                        <div class="timeline-item-marker-indicator bg-primary"></div>
                                                    </div>
                                                    <div class="timeline-item-content">
                                                        <i class="fa-regular fa-calendar"></i> {{ $comment['waktu'] }}
                                                        {{-- <br />
                                                        <i class="fa-solid fa-pencil"></i> <a class="fw-bold text-success">
                                                            Surat
                                                            Disetujui oleh, </a>
                                                        Asisten Manajer Infrastruktur --}}
                                                        <br />
                                                        <a class="btn btn-icon btn-transparent-dark m-0 p-0"><img
                                                                class="img-fluid ml-1"
                                                                src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                                                style="width: 40px;" /></a>
                                                        {{ $comment['reviewer'] }}
                                                        @if ($comment['status'] === 'Disetujui')
                                                            <p style="margin: 0 0 0 50px;"><span
                                                                    class="badge badge-pill badge-success m-0">{{ $comment['status'] }}</span>
                                                            </p>
                                                        @else
                                                            <p style="margin: 0 0 0 50px;"><span
                                                                    class="badge badge-pill badge-danger m-0">{{ $comment['status'] }}</span>
                                                            </p>
                                                        @endif
                                                        <span style="margin: 0 0 0 50px;"><i
                                                                class="fa-solid fa-comment"></i>
                                                            {{ $comment['komentar'] }}</span>
                                                        @if ($comment['file_evaluasi'] !== null)
                                                            <br>
                                                            <span style="margin: 0 0 0 50px;"><i
                                                                    class="fa-solid fa-file"></i>
                                                                {{ $comment['file_evaluasi'] }}
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col">
                                                <h5>Rincian Pengeluaran</h5>
                                            </div>
                                            <div class="col text-right">
                                                <a href="{{ route('kemajuan-budgets.export', $document->id) }}"><i
                                                        class="ml-2 fa fa-file-arrow-down fa-3x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <table id="datatablesSimple">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Deskripsi Item</th>
                                                        <th scope="col">Jumlah</th>
                                                        <th scope="col">Harga Satuan</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col">Bukti Transaksi</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Deskripsi Item</th>
                                                        <th scope="col">Jumlah</th>
                                                        <th scope="col">Harga Satuan</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col">Bukti Transaksi</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody id="budget-table">
                                                    @foreach ($laporan_kemajuan_budgets as $budget)
                                                        <tr>
                                                            <th scope="row">{{ $loop->iteration }}</th>
                                                            <td>{{ $budget->deskripsi_item }}</td>
                                                            <td>{{ $budget->jumlah }}</td>
                                                            <td>Rp. {{ number_format($budget->harga_satuan, 0, ',', '.') }}
                                                            </td>

                                                            <td>Rp.
                                                                {{ number_format((string) ((int) $budget->jumlah * (int) $budget->harga_satuan), 0, ',', '.') }}
                                                            </td>
                                                            <td><a class="mfp-image bukti_transaksi" href="#"
                                                                    data-mfp-src="{{ asset("documents/bukti_transaksi/{$budget->bukti_transaksi}") }}">
                                                                    <img style="cursor: pointer" width="125px"
                                                                        src="{{ asset("documents/bukti_transaksi/{$budget->bukti_transaksi}") }}"
                                                                        alt="{{ $budget->bukti_transaksi }}">
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    {{-- <tr>
                                                        <th scope="row"></th>
                                                        <td><strong>Total</strong></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><strong>-----</strong></td>
                                                        <td></td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <h3 class="mb-3" style="color: #5D7DCF">Review Laporan Akhir</h3>
                    @if ($document->status_laporan_akhir === 'not_submitted')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3" style="color: #5D7DCF">Anda belum mengajukan Laporan Akhir</h5>
                            </div>
                        </div>
                    @else
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <div class="card" style="height: 39rem;">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col">
                                                <h5>{{ $document->judul_proposal }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <embed id="file_proposal" name="file_proposal"
                                            src="{{ asset("documents/proposal/{$document->berkas->proposal->file_proposal}") }}"
                                            type="application/pdf" width="100%" height="100%" readonly="">
                                        </embed>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card" style="height: 39rem;">
                                    <div class="card-header">
                                        <h5>Riwayat Review</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="timeline timeline-xs">
                                            @foreach ($comments_laporan_akhir as $comment)
                                                <div class="timeline-item">
                                                    <div class="timeline-item-marker">
                                                        {{-- <div class="timeline-item-marker-text">27 min</div> --}}
                                                        <div class="timeline-item-marker-indicator bg-primary"></div>
                                                    </div>
                                                    <div class="timeline-item-content">
                                                        <i class="fa-regular fa-calendar"></i> {{ $comment['waktu'] }}
                                                        {{-- <br />
                                                        <i class="fa-solid fa-pencil"></i> <a class="fw-bold text-success">
                                                            Surat
                                                            Disetujui oleh, </a>
                                                        Asisten Manajer Infrastruktur --}}
                                                        <br />
                                                        <a class="btn btn-icon btn-transparent-dark m-0 p-0"><img
                                                                class="img-fluid ml-1"
                                                                src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                                                style="width: 40px;" /></a>
                                                        {{ $comment['reviewer'] }}
                                                        @if ($comment['status'] === 'Disetujui')
                                                            <p style="margin: 0 0 0 50px;"><span
                                                                    class="badge badge-pill badge-success m-0">{{ $comment['status'] }}</span>
                                                            </p>
                                                        @else
                                                            <p style="margin: 0 0 0 50px;"><span
                                                                    class="badge badge-pill badge-danger m-0">{{ $comment['status'] }}</span>
                                                            </p>
                                                        @endif
                                                        <span style="margin: 0 0 0 50px;"><i
                                                                class="fa-solid fa-comment"></i>
                                                            {{ $comment['komentar'] }}</span>
                                                        @if ($comment['file_evaluasi'] !== null)
                                                            <br>
                                                            <span style="margin: 0 0 0 50px;"><i
                                                                    class="fa-solid fa-file"></i>
                                                                {{ $comment['file_evaluasi'] }}
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col">
                                                <h5>Rincian Pengeluaran</h5>
                                            </div>
                                            <div class="col text-right">
                                                <a href="{{ route('akhir-budgets.export', $document->id) }}"><i
                                                        class="ml-2 fa fa-file-arrow-down fa-3x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <table id="datatablesSimple2">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Deskripsi Item</th>
                                                        <th scope="col">Jumlah</th>
                                                        <th scope="col">Harga Satuan</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col">Bukti Transaksi</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Deskripsi Item</th>
                                                        <th scope="col">Jumlah</th>
                                                        <th scope="col">Harga Satuan</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col">Bukti Transaksi</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody id="budget-table">
                                                    @foreach ($laporan_akhir_budgets as $budget)
                                                        <tr>
                                                            <th scope="row">{{ $loop->iteration }}</th>
                                                            <td>{{ $budget->deskripsi_item }}</td>
                                                            <td>{{ $budget->jumlah }}</td>
                                                            <td>Rp. {{ number_format($budget->harga_satuan, 0, ',', '.') }}
                                                            </td>

                                                            <td>Rp.
                                                                {{ number_format((string) ((int) $budget->jumlah * (int) $budget->harga_satuan), 0, ',', '.') }}
                                                            </td>
                                                            <td><a class="mfp-image bukti_transaksi" href="#"
                                                                    data-mfp-src="{{ asset("documents/bukti_transaksi/{$budget->bukti_transaksi}") }}">
                                                                    <img style="cursor: pointer" width="125px"
                                                                        src="{{ asset("documents/bukti_transaksi/{$budget->bukti_transaksi}") }}"
                                                                        alt="{{ $budget->bukti_transaksi }}">
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    {{-- <tr>
                                                        <th scope="row"></th>
                                                        <td><strong>Total</strong></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><strong>-----</strong></td>
                                                        <td></td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="my-3">
                    <a href="{{ route('laporan.index') }}">
                        <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Kembali
                        </button>
                    </a>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('extra_js')
    <script>
        $(document).ready(function() {
            $('.bukti_transaksi').magnificPopup({
                type: 'image',
                removalDelay: 300,
                mainClass: 'mfp-fade'
            });
        });
    </script>
@endpush
