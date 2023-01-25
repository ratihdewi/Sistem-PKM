<div class="modal fade" id="reviewer_info" tabindex="-1" aria-labelledby="pengeluaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reviewer Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Daftar Reviewer</h5>
                    </div>
                    <div class="card-body" id="reviewerTable">
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Reviewer</h5>
                    </div>
                    <div class="card-body">
                        <form id="add_reviewer" method="post" action="{{ route('daftar-usulan.add-reviewer') }}">
                            @csrf

                            <input id="document_id" type="hidden" name="document_id">

                            <div id="reviewer">
                                <div class="row reviewer mb-2">
                                    <label for="anggota_1" class="col-sm-3 col-form-label">Anggota 1</label>
                                    <div class="col-sm-7">
                                        <select class="form-select" name="anggota[]">
                                            @foreach ($reviewers as $reviewer)
                                                <option value={{ $reviewer->id }}>{{ $reviewer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-transparent-dark" type="button" id="add_anggota"><i
                                                class="ml-2 fa fa-plus fa-2x"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button form="add_reviewer" type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
