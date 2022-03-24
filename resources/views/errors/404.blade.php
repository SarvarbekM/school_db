@extends('layouts.default')

@section('title', 'Maktab topilmadi')

@section('content')

    <div class="container mt-5 pt-5">
        <div class="alert alert-danger text-center">
            <h2 class="display-3">404</h2>
            <p class="display-5">Oops! Something is wrong.</p>
            <a href="{{route('dashboard.school.index')}}" class="btn btn-info">Maktablar ro'yxati</a>
        </div>
    </div>

@endsection

