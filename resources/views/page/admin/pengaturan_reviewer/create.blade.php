@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 4%">
                <h3 class="mb-3" style="color: #5D7DCF">Pengaturan Reviewer</h3>

                <div class="row">
                    <div class="col-md-7">
                        <div class="card bg-light">
                            <div class="card-body">
                                <form action="{{ route('pengaturan-reviewer.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="dosen" class="col-sm-3 col-form-label">Nama Dosen</label>
                                        <div class="col-sm-9">
                                            <select class="form-select @error('dosen') is-invalid @enderror"
                                                aria-label="Default select example" name="dosen">
                                                <option selected disabled>Pilih Dosen</option>

                                                @foreach ($data_dosen as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
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
