@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <!-- Add your content here -->
    <div class="container mt-2 mx-auto px-4 py-8">
        <h4 class="text-3xl">Welcome, {{ auth()->user()->name }}!</h4>
    </div>
@endsection
