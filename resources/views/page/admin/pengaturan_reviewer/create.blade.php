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
                                <form action="#" method="post">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="nama_dosen" class="col-sm-3 col-form-label">Nama Dosen</label>
                                        <div class="col-sm-9">
                                            <select class="form-select @error('nama_dosen') is-invalid @enderror"
                                                aria-label="Default select example" name="nama_dosen">
                                                <option>A</option>
                                                <option>E</option>
                                                <option>I</option>
                                                <option>O</option>
                                                <option>U</option>
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
