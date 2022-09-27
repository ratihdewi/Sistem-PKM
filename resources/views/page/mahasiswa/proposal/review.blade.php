@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 180px">
                <h3 class="mb-3" style="color: #5D7DCF">Review Proposal</h3>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card" style="height: 39rem;">
                            <div class="card-header">
                                <div class="row mb-3">
                                    <div class="col">
                                        <h5>{{ $document->judul_proposal }}</h5>
                                    </div>
                                    <div class="col text-right"><i class="ml-2 fa fa-file-arrow-down fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <embed id="file_proposal" name="file_proposal"
                                    src="{{ asset("documents/{$document->berkas->proposal->file_proposal}") }}"
                                    type="application/pdf" width="100%" height="100%" readonly="">
                                </embed>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card" style="height: 38rem;">
                            <div class="card-header">
                                <h5>Riwayat Review</h5>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-3">
                    <a href="{{ route('proposal.index') }}">
                        <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Kembali
                        </button>
                    </a>
                </div>
            </div>
        </main>
    </div>
@endsection
