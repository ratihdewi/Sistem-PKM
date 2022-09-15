@extends('layout.main')

@section('container')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4" style="margin-top: 180px">
            <form>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Jenis PKM</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Jenis PKM</option>
                        <option value="1">PKM 8 Bidang</option>
                        <option value="2">PKM Artikel Ilmiah</option>
                        <option value="3">PKM Gagasan Futuristik Tertulis</option>
                    </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Skema PKM</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Skema PKM 8 Bidang</option>
                        <option value="1">PKM Karsa Cipta</option>
                        <option value="2">PKM Karya Inovatif</option>
                        <option value="3">PKM Kewirausahaan</option>
                        <option value="3">PKM Penerapan IPTEK</option>
                        <option value="3">PKM Pengabdian Kepada Masyarakat</option>
                        <option value="3">PKM Riset Eksakta</option>
                        <option value="3">PKM Riset Sosial Humaniora</option>
                        <option value="3">PKM Video Gagasan Konstruktif</option>
                        </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Judul Proposal</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputPassword">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Anggota 1</label>
                <div class="col-sm-3">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Anggota 1</option>
                    </select>
                </div>
                <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Anggota 2</label>
                <div class="col-sm-3">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Anggota 2</option>
                    </select>
                </div>
                <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Anggota 3</label>
                <div class="col-sm-3">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Anggota 3</option>
                    </select>
                </div>
                <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Anggota 4</label>
                <div class="col-sm-3">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Anggota 4</option>
                    </select>
                </div>
                <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Dosen Pendamping</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Dosen Pendamping</option>
                    </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Sumber Pendanaan DIKTI</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Sumber Pendanaan PT</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Luaran Proposal</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputPassword">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="formFile" class="col-sm-2 col-form-label">Upload Files</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                  </div>
              </div>
              <div class="mt-4 text-center">
                <a href="#">
                <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Submit</button>
                </a>
            </div>
            </form>
        </div>
    </main>
</div>

@endsection
