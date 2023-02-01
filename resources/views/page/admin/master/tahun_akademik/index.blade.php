@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 5%">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-n3" role="alert"
                        style="width: 40%; margin-left: auto; margin-right: 0;">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>
                @endif

                <h3 class="mb-3" style="color: #5D7DCF">Tahun Akademik</h3>

                <div>
                    <a href="{{ route('tahun-akademik.create') }}">
                        <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Tambah Tahun
                            Akademik <i class="fa fa-plus"></i></button>
                    </a>
                </div>

                <div class="card mb-4 mt-3">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Akademik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Akademik</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($tahun_akademik as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ "{$item->tahun}-{$item->term}" }}</td>
                                        <td style="padding: 0">
                                            <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                                href="{{ route('tahun-akademik.edit', $item->id) }}"><i
                                                    class="fa fa-pencil"></i></a>
                                            <form action="{{ route('tahun-akademik.destroy', $item->id) }}" method="post"
                                                class="d-inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-datatable btn-icon btn-transparent-dark"
                                                    type="submit"><i class="ml-2 fa fa-trash"></i></button>
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
