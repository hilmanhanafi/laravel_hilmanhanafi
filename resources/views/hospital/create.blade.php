@extends('layouts.master')

@section('title', 'Create Hospital')

@section('content')
    <div class="container mt-3 mx-auto px-4 py-8">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-3xl">Create Hospital</h4>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('hospitals.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Rumah Sakit</label>
                                <input type="text" class="form-control" id="nama_rumah_sakit" name="nama_rumah_sakit"
                                    value="{{ old('nama_rumah_sakit') }}">
                                @error('nama_rumah_sakit')
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
                                <label for="name" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="mb-3">
                                <label for="name" class="form-label">Telepon</label>
                                <input type="number" class="form-control" id="telepon" name="telepon"
                                    value="{{ old('telepon') }}">
                                @error('telepon')
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
