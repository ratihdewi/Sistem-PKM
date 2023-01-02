@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 5%">
                <h3 class="mb-3" style="color: #5D7DCF">Jenis PKM</h3>

                <div class="card mb-4 mt-3">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis PKM</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis PKM</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($jenis_pkm as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        {{-- <td>
                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                            <form action="#" method="post" class="d-inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"><i class="ml-2 fa fa-trash"></i></button>
                                            </form>
                                        </td> --}}
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
