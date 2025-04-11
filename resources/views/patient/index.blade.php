@extends('layouts.master')

@section('title', 'Pasien')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Pasien</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('patients.create') }}" class="btn btn-primary mb-2">
                            Create Pasien
                        </a>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-1">
                                    <span class="input-group-text" id="basic-addon1">Filter Rumah sakit</span>
                                    <select class="form-control" id="filter_rumah_sakit">
                                        <option value="">-- Semua Rumah Sakit --</option>
                                        @foreach ($hospital as $h)
                                            <option value="{{ $h->id }}">{{ $h->nama_rumah_sakit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <table class="table table-bordered mt-3" id="tabel_pasien">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama pasien</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                    <th>Nama rumah sakit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $key => $p)
                                    <tr data-id="{{ $p->id }}">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $p->nama_pasien }}</td>
                                        <td>{{ $p->alamat }}</td>
                                        <td>{{ $p->no_telepon }}</td>
                                        <td>{{ $p->hospital->nama_rumah_sakit }}</td>
                                        <td>
                                            <a href="{{ route('patients.edit', $p->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <button class="btn btn-danger delete-pasien"
                                                data-id="{{ $p->id }}">Hapus</button>
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
            $('.delete-pasien').click(function() {
                let id = $(this).data('id');
                if (confirm('Yakin hapus data?')) {
                    $.ajax({
                        url: "{{ route('patients.destroy', ':id') }}".replace(':id', id),
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

        $('#filter_rumah_sakit').on('change', function() {
            var rskId = $(this).val();

            $.ajax({
                url: "{{ url('filter-pasien') }}",
                type: 'GET',
                data: {
                    rsk_id: rskId
                },
                success: function(data) {
                    let rows = '';


                    data.forEach(function(pasien, index) {
                        const editUrl = `/patients/${pasien.id}/edit`;

                        const deleteBtn =
                            `<button class="btn btn-danger delete-pasien" data-id="${pasien.id}">Hapus</button>`;
                        rows += `<tr>
                    <td>${index + 1}</td>
                    <td>${pasien.nama_pasien}</td>
                    <td>${pasien.alamat}</td>
                    <td>${pasien.no_telepon}</td>
                    <td>${pasien.hospital.nama_rumah_sakit}</td>
                    <td>
                        <a href="${editUrl}" class="btn btn-sm btn-primary">Edit</a>
                        ${deleteBtn}
                    </td>
                </tr>`;
                    });
                    $('#tabel_pasien tbody').html(rows);
                }
            });
        });
    </script>
@endsection
