<!-- Sidebar -->
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu" style="margin-top: 170px">
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
                                <a class="nav-link" href="#">Data Mahasiswa</a>
                                <a class="nav-link" href="#">Dosen Pendamping</a>
                                <a class="nav-link" href="{{ route('pengaturan-reviewer.index') }}">Pengaturan Reviewer</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"></div>
                            Dokumen
                        </a>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"></div>
                            Pengaturan Konten
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapsePengaturan" aria-expanded="false" aria-controls="collapsePengaturan">
                            <div class="sb-nav-link-icon"></div>
                            Pengaturan
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePengaturan" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('jenis-pkm.index') }}">Jenis PKM</a>
                                <a class="nav-link" href="{{ route('skema-pkm.index') }}">Skema PKM</a>
                            </nav>
                        </div>
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
                                <a class="nav-link" href="{{ route('laporan-kemajuan.index') }}">Laporan Kemajuan</a>
                                <a class="nav-link" href="{{ route('laporan-akhir.index') }}">Laporan Akhir</a>
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
        </nav>
    </div>
    <!-- End of Sidebar -->
