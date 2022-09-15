<!-- Sidebar -->
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu" style="margin-top: 170px">
                <div class="nav">
                    <a class="nav-link" href="/">
                        <div class="sb-nav-link-icon"></div>
                        Beranda
                    </a>
                    <a class="nav-link" href="/proposal">
                        <div class="sb-nav-link-icon"></div>
                        Pengajuan Proposal
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"></div>
                        Pelaksanaan Kegiatan
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="layout-static.html">Laporan Kemajuan</a>
                            <a class="nav-link" href="layout-sidenav-light.html">Laporan Akhir</a>
                        </nav>
                    </div>
                </div>
                <div class="mt-4 text-center">
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
