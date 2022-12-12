@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 5%">
                <div class="row">
                    <div class="col">
                        <div class="card bg-light">
                            <div class="card-body">
                                @if (Request::is('laporan-kemajuan*'))
                                    <form id="submit-laporan"
                                        action="{{ route('laporan-kemajuan.submit', $document->id) }}"method="post"
                                        enctype="multipart/form-data">
                                @endif
                                @if (Request::is('laporan-akhir*'))
                                    <form id="submit-laporan"
                                        action="{{ route('laporan-akhir.submit', $document->id) }}"method="post"
                                        enctype="multipart/form-data">
                                @endif
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="key" value="{{ $key }}">

                                <div class="mb-3 row">
                                    <label for="judul_proposal" class="col-sm-2 col-form-label">Judul Proposal</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul_proposal" name="judul_proposal"
                                            value="{{ $document->judul_proposal }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="pendanaan_dikti" class="col-sm-2 col-form-label">Sumber Pendanaan
                                        DIKTI</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" class="form-control"
                                                aria-label="Amount (to the nearest dollar)" name="pendanaan_dikti"
                                                value="{{ $document->pendanaan_dikti }}" readonly>
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="pendanaan_pt" class="col-sm-2 col-form-label">Sumber Pendanaan
                                        PT</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" class="form-control"
                                                aria-label="Amount (to the nearest dollar)" name="pendanaan_pt"
                                                value="{{ $document->pendanaan_pt }}" readonly>
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="luaran_proposal" class="col-sm-2 col-form-label">Luaran
                                        Proposal</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" id="luaran_proposal" name="luaran_proposal" readonly>{{ $document->berkas->proposal->luaran_proposal }}</textarea>
                                    </div>
                                </div>

                                @if (Request::is('laporan-kemajuan*'))
                                    <div class="mb-3 row">
                                        <label for="luaran_laporan_kemajuan" class="col-sm-2 col-form-label">Upload
                                            Luaran
                                            Laporan
                                            Kemajuan</label>
                                        <div class="col-sm-10">
                                            <input
                                                class="form-control @error('luaran_laporan_kemajuan') is-invalid @enderror"
                                                type="file" id="luaran_laporan_kemajuan" name="luaran_laporan_kemajuan">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="laporan_kemajuan" class="col-sm-2 col-form-label">Upload
                                            Laporan
                                            Kemajuan</label>
                                        <div class="col-sm-10">
                                            <input class="form-control @error('laporan_kemajuan') is-invalid @enderror"
                                                type="file" id="laporan_kemajuan" name="laporan_kemajuan">
                                        </div>
                                    </div>
                                @endif

                                @if (Request::is('laporan-akhir*'))
                                    <div class="mb-3 row">
                                        <label for="luaran_laporan_akhir" class="col-sm-2 col-form-label">Upload
                                            Luaran Laporan Akhir</label>
                                        <div class="col-sm-10">
                                            <input class="form-control @error('luaran_laporan_akhir') is-invalid @enderror"
                                                type="file" id="luaran_laporan_akhir" name="luaran_laporan_akhir">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="laporan_akhir" class="col-sm-2 col-form-label">Upload
                                            Laporan Akhir</label>
                                        <div class="col-sm-10">
                                            <input class="form-control @error('laporan_akhir') is-invalid @enderror"
                                                type="file" id="laporan_akhir" name="laporan_akhir">
                                        </div>
                                    </div>
                                @endif
                                </form>

                                <!-- INI TUH INPUTNTYA YER-->
                                <div class="mb-3 row">
                                    <label for="pendanaan_pt" class="col-sm-11 col-form-label">Rincian Pengeluaran</label>
                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-transparent-dark" data-bs-toggle="modal"
                                            data-bs-target="#pengeluaran_create"><i
                                                class="ml-2 fa fa-plus fa-2x"></i></button>
                                    </div>
                                </div>
                                <!-- INI TUH TABELNYA -->
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
                                                <th scope="col">Aksi</th>
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
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody id="budget-table">
                                            @foreach ($budgets as $budget)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $budget->deskripsi_item }}</td>
                                                    <td>{{ $budget->jumlah }}</td>
                                                    <td>Rp. {{ number_format($budget->harga_satuan, 0, ',', '.') }}</td>

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
                                                    <td style="padding: 0">
                                                        <button type="button"
                                                            class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                                            data-bs-toggle="modal" data-bs-target="#pengeluaran_update"
                                                            data-id="{{ $budget->id }}"
                                                            data-deskripsiitem="{{ $budget->deskripsi_item }}"
                                                            data-jumlahitem="{{ $budget->jumlah }}"
                                                            data-hargasatuan="{{ $budget->harga_satuan }}"><i
                                                                class="fa fa-pencil"></i></button>
                                                        <form id="delete-budget-item"
                                                            action="{{ route('pengeluaran.delete', $budget->id) }}"
                                                            method="post" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button data-id="{{ $budget->id }}"
                                                                class="btn btn-datatable btn-icon btn-transparent-dark"
                                                                type="submit"><i class="fa fa-trash"></i></button>
                                                        </form>
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

                                <div class="mt-4 text-center">
                                    <a href="#">
                                        <button form="submit-laporan" type="submit" class="btn"
                                            style="background-color: #5D7DCF; color: #fff">Submit</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    @include('page.mahasiswa.laporan.pengeluaran', ['laporan_akhir_status' => $laporan_akhir])
@endsection

@push('extra_js')
    <script>
        $(document).on('submit', '[id^=delete-budget-item]', function(ev) {
            var form = this;
            ev.preventDefault();
            swal({
                    title: "Hapus Data?",
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
        });

        $(document).ready(function() {
            $('.bukti_transaksi').magnificPopup({
                type: 'image',
                removalDelay: 300,
                mainClass: 'mfp-fade'
            });

            $('#pengeluaran_update').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let modal = $(this);

                let id = button.data('id');
                let deskripsiItem = button.data('deskripsiitem');
                let jumlahItem = button.data('jumlahitem');
                let hargaSatuan = button.data('hargasatuan');

                modal.find('.modal-body #document_budget_id').val(id)
                modal.find('.modal-body #deskripsi_item').val(deskripsiItem)
                modal.find('.modal-body #jumlah').val(jumlahItem)
                modal.find('.modal-body #harga_satuan').val(hargaSatuan)
            })
        });
    </script>
@endpush
