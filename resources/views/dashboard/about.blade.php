@extends('layouts.default')

@section('title', 'Dastur haqida')

@section('content')

    @include('includes.errors')

    <div class="panel panel-inverse m-t-20">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">
                <div class="panel-heading-btn">

                </div>
            </h4>
            <div class="panel-heading-btn">

            </div>
        </div>
        <!-- end panel-heading -->

        <!-- begin panel-body -->
        <div class="panel-body" style="font-size: 1rem;">
            <p>Mazkur <u><b>SCHOOL</b>DB</u> dasturi quyidagi texnologiyalar asosida yaratildi: </p>
            <ul>
                <li>Ma'lumotlar bazasi - PostgreSQL</li>
                <li>BackEnd - PHP, Laravel framework</li>
                <li>FrontEnd - HTML5, Bootstrap 4, jQuery 3.1</li>
            </ul>
            <p>Shablon sifatida <a target="_blank" href="https://seantheme.com/color-admin/admin/html/index_v3.html">Color admin</a> templatedan foydalanildi. </p>
        </div>
        <!-- end panel-body -->
    </div>
@endsection
