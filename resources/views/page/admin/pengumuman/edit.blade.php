@extends('layout.main')

@section('container')
    <style>
        .ck-editor__editable {
            max-height: 350px;
        }
    </style>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-3" style="margin-top: 5%">
                <div class="row">
                    <div class="col">
                        <div class="card bg-light">
                            <div class="card-body">
                                <form action="{{ route('pengumuman.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3 row">
                                        <label for="title" class="col-sm-2 col-form-label">Judul</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" value="{{$data->title}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="announcement" class="col-sm-2 col-form-label">Teks</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="announcement" name="announcement">{{$data->text}}</textarea>
                                        </div>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <a href="#">
                                            <button type="submit" class="btn"
                                                style="background-color: #5D7DCF; color: #fff">Submit</button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('extra_js')
    <script>
        ClassicEditor
            .create(document.querySelector('#announcement'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
