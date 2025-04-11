@extends('layouts.master')

@section('title', 'Hospitals')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Hospitals</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('hospitals.create') }}" class="btn btn-primary">
                            Create Hospital
                        </a>

                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Rumah Sakit</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hospitals as $key => $hospital)
                                    <tr data-id="{{ $hospital->id }}">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $hospital->nama_rumah_sakit }}</td>
                                        <td>{{ $hospital->alamat }}</td>
                                        <td>{{ $hospital->email }}</td>
                                        <td>{{ $hospital->telepon }}</td>
                                        <td>
                                            <a href="{{ route('hospitals.edit', $hospital->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <button class="btn btn-danger delete-hospital"
                                                data-id="{{ $hospital->id }}">Hapus</button>
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
    <script>
        $(document).ready(function() {
            $('.delete-hospital').click(function() {
                let id = $(this).data('id');
                if (confirm('Yakin hapus data?')) {
                    $.ajax({
                        url: "{{ route('hospitals.destroy', ':id') }}".replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(result) {
                            if (result.status) {

                                $('tr[data-id="' + id + '"]').remove();
                            } else {
                                alert('Gagal dihapus');
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
