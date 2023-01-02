<!-- Sidebar -->
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu mt-3">
                <div class="nav">
                    <a class="nav-link" href="{{ route('index') }}">
                        <div class="sb-nav-link-icon"></div>
                        Beranda
                    </a>
                    @can('admin')
                        <a class="nav-link" href="{{ route('daftar-usulan.index') }}">
                            <div class="sb-nav-link-icon"></div>
                            Daftar Usulan
                        </a>
                        <a class="nav-link" href="{{ route('daftar-usulan.index') }}">
                            <div class="sb-nav-link-icon"></div>
                            Daftar Usulan Didanai
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseDataPendukung" aria-expanded="false"
                            aria-controls="collapseDataPendukung">
                            <div class="sb-nav-link-icon"></div>
                            Data Pendukung
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseDataPendukung" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('data-mahasiswa.index') }}">Data Mahasiswa</a>
                                <a class="nav-link" href="{{ route('data-dosen-pendamping.index') }}">Dosen Pendamping</a>
                                <a class="nav-link" href="{{ route('pengaturan-reviewer.index') }}">Pengaturan Reviewer</a>
                                <a class="nav-link" href="{{ route('pengaturan-dokumen.create') }}">Pengaturan Dokumen</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapsePengaturan" aria-expanded="false" aria-controls="collapsePengaturan">
                            <div class="sb-nav-link-icon"></div>
                            Pengaturan
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePengaturan" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('prodi.index') }}">Prodi</a>
                                <a class="nav-link" href="{{ route('tahun-akademik.index') }}">Tahun Akademik</a>
                                <a class="nav-link" href="{{ route('jenis-surat.index') }}">Jenis Surat</a>
                                <a class="nav-link" href="{{ route('jenis-pkm.index') }}">Jenis PKM</a>
                                <a class="nav-link" href="{{ route('skema-pkm.index') }}">Skema PKM</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"></div>
                            Pengaturan Konten
                        </a>
                    @endcan
                    @can('dosen')
                        <a class="nav-link" href="{{ route('review.index') }}">
                            <div class="sb-nav-link-icon"></div>
                            Review Proposal
                        </a>
                    @endcan
                    @can('mahasiswa')
                        <a class="nav-link" href="{{ route('proposal.index') }}">
                            <div class="sb-nav-link-icon"></div>
                            Pengajuan Proposal
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapsePelaksanaanKegiatan" aria-expanded="false"
                            aria-controls="collapsePelaksanaanKegiatan">
                            <div class="sb-nav-link-icon"></div>
                            Pelaksanaan Kegiatan
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePelaksanaanKegiatan" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('laporan.index') }}">Laporan Kemajuan</a>
                                <a class="nav-link" href="{{ route('laporan.index') }}">Laporan Akhir</a>
                            </nav>
                        </div>
                    @endcan
                </div>
                <div class="mt-4 mb-5 text-center">
                    <form action="{{ route('logout.post') }}" method="post">
                        @csrf
                        <button type="submit" class="btn" style="background-color: #5D7DCF; color: #fff">Sign
                            Out</button>
                    </form>
                </div>
            </div>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 bg-white" id="sidebarToggle"
                href="#!" style="position: absolute; left: 220px;"><i class="fa fa-chevron-right"></i></button>
        </nav>
    </div>
    <!-- End of Sidebar -->
