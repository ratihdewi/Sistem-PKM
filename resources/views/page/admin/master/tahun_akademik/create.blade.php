@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-3" style="margin-top: 5%">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <form action="{{ route('tahun-akademik.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('tahun') is-invalid @enderror"
                                                id="tahun" name="tahun" value="{{ old('tahun') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="term" class="col-sm-3 col-form-label">Term</label>
                                        <div class="col-sm-9">
                                            <select class="form-select @error('term') is-invalid @enderror"
                                                aria-label="Default select example" name="term">
                                                <option selected disabled>Term</option>

                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
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
