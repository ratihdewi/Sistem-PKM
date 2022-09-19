@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 180px">
                <form action="{{ route('proposal.update', $document->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3 row">
                        <label for="jenis_pkm" class="col-sm-2 col-form-label">Jenis PKM</label>
                        <div class="col-sm-10">
                            <select id="jenis_pkm" class="form-select @error('skema_pkm') is-invalid @enderror"
                                aria-label="Default select example">
                                <option id="select_jenis_pkm" selected disabled>Jenis PKM</option>
                                @foreach ($jenis_pkm as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="skema_pkm" class="col-sm-2 col-form-label">Skema PKM</label>
                        <div class="col-sm-10">
                            <select id="skema_pkm" class="form-select @error('skema_pkm') is-invalid @enderror"
                                aria-label="Default select example" name="skema_pkm">
                                <option id="select_skema_pkm" selected disabled>Skema PKM</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="title" class="col-sm-2 col-form-label">Judul Proposal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title', $document->title) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="anggota_1" class="col-sm-2 col-form-label">Anggota 1</label>
                        <div class="col-sm-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Anggota 1</option>
                            </select>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                value="email@example.com">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="anggota_2" class="col-sm-2 col-form-label">Anggota 2</label>
                        <div class="col-sm-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Anggota 2</option>
                            </select>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                value="email@example.com">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="anggota_3" class="col-sm-2 col-form-label">Anggota 3</label>
                        <div class="col-sm-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Anggota 3</option>
                            </select>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                value="email@example.com">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="anggota_4" class="col-sm-2 col-form-label">Anggota 4</label>
                        <div class="col-sm-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Anggota 4</option>
                            </select>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                value="email@example.com">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="dosen_pendamping" class="col-sm-2 col-form-label">Dosen Pendamping</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Dosen Pendamping</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pendanaan_dikti" class="col-sm-2 col-form-label">Sumber Pendanaan DIKTI</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control @error('pendanaan_dikti') is-invalid @enderror"
                                    aria-label="Amount (to the nearest dollar)" name="pendanaan_dikti"
                                    value="{{ old('pendanaan_dikti', $document->pendanaan_dikti) }}">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pendanaan_pt" class="col-sm-2 col-form-label">Sumber Pendanaan PT</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control @error('pendanaan_pt') is-invalid @enderror"
                                    aria-label="Amount (to the nearest dollar)" name="pendanaan_pt"
                                    value="{{ old('pendanaan_pt', $document->pendanaan_pt) }}">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="luaran_proposal" class="col-sm-2 col-form-label">Luaran Proposal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('luaran_proposal') is-invalid @enderror"
                                id="luaran_proposal" name="luaran_proposal"
                                value="{{ old('luaran_proposal', $document->file->luaran_proposal) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="proposal" class="col-sm-2 col-form-label">Upload Proposal</label>
                        <div class="col-sm-10">
                            <input class="form-control @error('proposal') is-invalid @enderror" type="file"
                                id="proposal" name="proposal">
                        </div>
                    </div>
                    <div class="mt-4 mb-4 text-center">
                        <a href="#">
                            <button type="submit" class="btn"
                                style="background-color: #5D7DCF; color: #fff">Submit</button>
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection

@push('extra_js')
    <script>
        $('#jenis_pkm').change(function() {
            $("#jenis_pkm option[id='select_jenis_pkm']").hide()
            $.ajax({
                type: 'GET',
                url: '../skema-pkm/' + $(this).val(),
                success: function(data) {
                    $('#skema_pkm').empty().append(
                        data.map(function(item) {
                            return `<option value="${item.id}">${item.name}</option>`
                        })
                    )
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log('XHR', xhr);
                    console.log('status', textStatus);
                    console.log('Error in', errorThrown);
                }
            });
        });
    </script>
@endpush
