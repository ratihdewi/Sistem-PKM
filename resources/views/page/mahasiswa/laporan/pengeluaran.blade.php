    <!-- Create Budget Item Modal -->
    <div class="modal fade" id="pengeluaran_create" tabindex="-1" aria-labelledby="pengeluaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form method="post" action="{{ route('pengeluaran.create') }}" enctype="multipart/form-data">
                @if ($key === 'edit')
                    <form method="post" action="{{ route('pengeluaran.update') }}" enctype="multipart/form-data">
                @endif
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="document_id" value="{{ $document->id }}">
                        <input type="hidden" name="laporan_akhir_status" value="{{ $laporan_akhir_status }}">

                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Deskripsi Item</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="deskripsi_item" name="deskripsi_item"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Jumlah</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="jumlah" name="jumlah"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)" id="harga_satuan"
                                            name="harga_satuan" autocomplete="off">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="bukti_transaksi" class="form-label">Bukti Transaksi</label>
                                <div class="form-group">
                                    <input class="form-control" type="file" id="bukti_transaksi"
                                        name="bukti_transaksi" autocomplete="off" required='required'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Budget Item Modal -->
    <div class="modal fade" id="pengeluaran_update" tabindex="-1" aria-labelledby="pengeluaranLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form method="post" action="{{ route('pengeluaran.update') }}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="document_budget_id" name="document_budget_id">

                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Deskripsi Item</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="deskripsi_item"
                                        name="deskripsi_item" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Jumlah</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="jumlah" name="jumlah"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)" id="harga_satuan"
                                            name="harga_satuan" autocomplete="off">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="bukti_transaksi" class="form-label">Bukti Transaksi</label>
                                <div class="form-group">
                                    <input class="form-control" type="file" id="bukti_transaksi"
                                        name="bukti_transaksi" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
