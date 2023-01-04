@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 2%">
                <div class="col">
                <div class="card">
                    <div class="card-header">
                      <h6>Pengusul Program Kreativitas Mahasiswa </h6>
                    </div>
                    <div class="card-body">
                      {{-- <h5 class="card-title">Special title treatment</h5> --}}
                      <div class="mb-1 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                        </div>
                      </div>
                      <div class="mb-1 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="1052110000">
                        </div>
                      </div>
                      <div class="mb-1 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Program Studi</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Ilmu Komputer">
                        </div>
                      </div>
                      <div class="mb-1 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Peran</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Ketua">
                        </div>
                      </div>
                      {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    </div>
                  </div>
                </div>


                  {{-- <div class="mt-4 card text-center">
                    <div class="card-header">
                      <h6>Informasi dan Pengumuman</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Pengumuman 1 <span class="badge bg-primary">New</span> </li>
                        <li class="list-group-item">Pengumuman 2</li>
                        <li class="list-group-item">Pengumuman 3</li>
                      </ul>
                  </div> --}}

                  <div class="col mt-4">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            <h6>Informasi dan Pengumuman</h6>
                        </div>
                        <div class="card-body">
                            <div class="timeline timeline-xs">
                                <!-- Timeline Item 1-->
                                <div class="timeline-item">
                                    <div class="timeline-item-marker">
                                        <div class="timeline-item-marker-text">1 min</div>
                                        <div class="timeline-item-marker-indicator bg-primary"></div>
                                    </div>
                                    <div class="timeline-item-content">
                                        New order placed!
                                        <a class="fw-bold text-dark" href="#!">Order #2912</a>
                                        has been successfully placed. <span class="badge bg-primary">New</span>
                                    </div>
                                </div>
                                <!-- Timeline Item 2-->
                                <div class="timeline-item">
                                    <div class="timeline-item-marker">
                                        <div class="timeline-item-marker-text">58 min</div>
                                        <div class="timeline-item-marker-indicator bg-primary"></div>
                                    </div>
                                    <div class="timeline-item-content">
                                        Your
                                        <a class="fw-bold text-dark" href="#!">weekly report</a>
                                        has been generated and is ready to view.
                                    </div>
                                </div>
                                <!-- Timeline Item 3-->
                                <div class="timeline-item">
                                    <div class="timeline-item-marker">
                                        <div class="timeline-item-marker-text">2 hrs</div>
                                        <div class="timeline-item-marker-indicator bg-primary"></div>
                                    </div>
                                    <div class="timeline-item-content">
                                        New user
                                        <a class="fw-bold text-dark" href="#!">Valerie Luna</a>
                                        has registered
                                    </div>
                                </div>
                                <!-- Timeline Item 4-->
                                <div class="timeline-item">
                                    <div class="timeline-item-marker">
                                        <div class="timeline-item-marker-text">1 day</div>
                                        <div class="timeline-item-marker-indicator bg-primary"></div>
                                    </div>
                                    <div class="timeline-item-content">Server activity monitor alert</div>
                                </div>
                                <!-- Timeline Item 5-->
                                <div class="timeline-item">
                                    <div class="timeline-item-marker">
                                        <div class="timeline-item-marker-text">1 day</div>
                                        <div class="timeline-item-marker-indicator bg-primary"></div>
                                    </div>
                                    <div class="timeline-item-content">
                                        New order placed!
                                        <a class="fw-bold text-dark" href="#!">Order #2911</a>
                                        has been successfully placed.
                                    </div>
                                </div>
                                <!-- Timeline Item 6-->
                                <div class="timeline-item">
                                    <div class="timeline-item-marker">
                                        <div class="timeline-item-marker-text">1 day</div>
                                        <div class="timeline-item-marker-indicator bg-primary"></div>
                                    </div>
                                    <div class="timeline-item-content">
                                        Details for
                                        <a class="fw-bold text-dark" href="#!">Marketing and Planning Meeting</a>
                                        have been updated.
                                    </div>
                                </div>
                                <!-- Timeline Item 7-->
                                <div class="timeline-item">
                                    <div class="timeline-item-marker">
                                        <div class="timeline-item-marker-text">2 days</div>
                                        <div class="timeline-item-marker-indicator bg-primary"></div>
                                    </div>
                                    <div class="timeline-item-content">
                                        New order placed!
                                        <a class="fw-bold text-dark" href="#!">Order #2910</a>
                                        has been successfully placed.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
