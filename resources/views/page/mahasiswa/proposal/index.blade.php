@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 180px">
                <div>
                    <a href="{{ route('proposal.create') }}">
                        <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Pengajuan Proposal
                            <i class="fa fa-plus"></i></button>
                    </a>
                </div>
                <div>
                    <button type="button" class="btn mt-3" style="background-color: #5D7DCF; color: #fff">Sort By <i
                            class="fa fa-caret-down"></i></button>
                </div>

                <div class="card mb-4 mt-3">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Skema</th>
                                    <th>Judul Pengajuan</th>
                                    <th>Peran</th>
                                    <th>Dana PT</th>
                                    <th>Dana Dikti</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Skema</th>
                                    <th>Judul Pengajuan</th>
                                    <th>Peran</th>
                                    <th>Dana PT</th>
                                    <th>Dana Dikti</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($documents as $document)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $document->created_at->format('Y') }}</td>
                                        <td>{{ $document->skema_pkm->name }}</td>
                                        <td>{{ $document->title }}</td>
                                        <td>Ketua/Anggota</td>
                                        <td>Rp. {{ number_format($document->pendanaan_pt, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($document->pendanaan_dikti, 0, ',', '.') }}</td>
                                        <td></td>
                                        <td>
                                            <a href="{{ route('proposal.edit', $document->id) }}"><i
                                                    class="fa fa-pencil"></i></a>
                                            <form action="{{ route('proposal.destroy', $document->id) }}" method="post"
                                                class="d-inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"><i class="ml-2 fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
