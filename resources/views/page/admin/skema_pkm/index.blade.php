@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 180px">
                <div>
                    <a href="{{ route('skema-pkm.create') }}">
                        <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Tambah Skema PKM
                            <i class="fa fa-plus"></i></button>
                    </a>
                </div>

                <div class="card mb-4 mt-3">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Skema PKM</th>
                                    <th>Jenis PKM</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Skema PKM</th>
                                    <th>Jenis PKM</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($skema_pkm as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->jenis_pkm->name }}</td>
                                        <td>
                                            <a href="{{ route('skema-pkm.edit', $item->id) }}"><i
                                                    class="fa fa-pencil"></i></a>
                                            <form action="{{ route('skema-pkm.destroy', $item->id) }}" method="post"
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
