@extends('layouts.master')

@section('title', 'Create Pasien')

@section('content')
    <div class="container mt-3 mx-auto px-4 py-8">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-3xl">Create Pasien</h4>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('patients.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control" id="nama_pasien" name="nama_pasien"
                                    value="{{ old('nama_pasien') }}">
                                @error('nama_pasien')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">No telepon</label>
                                <input type="number" class="form-control" id="no_telepon" name="no_telepon"
                                    value="{{ old('no_telepon') }}">
                                @error('no_telepon')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Rumah Sakit</label>
                                <select class="form-control" id="rumah_sakit" name="rumah_sakit">
                                    <option value="">PILIH</option>
                                    @foreach ($hospital as $h)
                                        <option value="{{ $h->id }}">{{ $h->nama_rumah_sakit }}</option>
                                    @endforeach
                                </select>
                                @error('rumah_sakit')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <button type="submit" class="btn btn-primary w-100">Create</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
