@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" style="margin-top: 5%">
                <h3 class="mb-3" style="color: #5D7DCF">Pengumuman</h3>

                <div>
                    <a href="{{ route('pengumuman.create') }}">
                        <button type="button" class="btn" style="background-color: #5D7DCF; color: #fff">Tambah Pengumuman
                            <i class="fa fa-plus"></i></button>
                    </a>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4 mt-3">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Pengumuman</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Pengumuman</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>
                                                    <a href="{{ route('pengumuman.edit', $item->id) }}">
                                                        <button type="button" class="btn" style="background-color: #00A200; color: #fff">
                                                        <i class="fa fa-edit"></i></button>
                                                    </a>
                                                    
                                                    <div class="btn btn-xs">
                                                        <form action="{{route ('pengumuman.destroy', $item->id)}}" class="pull-left"  method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <button type="button" class="btn" style="background-color: #D91E00; color: #fff" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
