@extends('layout.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-3" style="margin-top: 180px">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <form action="{{ route('skema-pkm.update', $skema_pkm->id) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="jenis_pkm" class="col-sm-3 col-form-label">Jenis PKM</label>
                                        <div class="col-sm-9">
                                            <select class="form-select @error('jenis_pkm') is-invalid @enderror"
                                                aria-label="Default select example" name="jenis_pkm">
                                                <option selected disabled>Jenis PKM</option>

                                                @foreach ($jenis_pkm as $item)
                                                    @if ($skema_pkm->jenis_pkm->id == $item->id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="skema_pkm" class="col-sm-3 col-form-label">Skema PKM</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('skema_pkm') is-invalid @enderror" id="skema_pkm"
                                                name="skema_pkm" value="{{ old('skema_pkm', $skema_pkm->name) }}">
                                        </div>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <a href="#">
                                            <button type="submit" class="btn"
                                                style="background-color: #5D7DCF; color: #fff">Submit</button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
