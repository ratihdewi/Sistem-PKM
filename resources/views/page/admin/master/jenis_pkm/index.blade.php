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
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis PKM</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($jenis_pkm as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            {{-- {{ $item->is_active }} --}}

                                            {{-- {{ $item->is_active == 1 ? 'Active' : 'Inactive' }} --}}

                                            <div class="custom-control custom-switch">
                                                <input data-id="{{ $item->id }}" type="checkbox"
                                                    class="switching-status custom-control-input" id="{{ $item->name }}"
                                                    {{ $item->is_active == 1 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="{{ $item->name }}"></label>
                                            </div>
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

@push('extra_js')
    <script>
        $(function() {
            $('.switching-status').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var item_id = $(this).data('id');

                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: "{{ route('jenis-pkm.change-status') }}",
                    data: {
                        'status': status,
                        'item_id': item_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data.success);
                    }
                })
            })
        })
    </script>
@endpush
