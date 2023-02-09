<div class="modal fade" id="reviewer_create" tabindex="-1" aria-labelledby="pengeluaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Reviewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_reviewer" action="{{ route('pengaturan-reviewer.submit') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3 row">
                        <label for="dosen" class="col-sm-3 col-form-label">Nama Dosen</label>
                        <div class="col-sm-9">
                            <select id="dosen" class="form-select dosen-select" name="dosen[]" multiple="multiple">

                                @foreach ($data_dosen as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button form="add_reviewer" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
