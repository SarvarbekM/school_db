@extends('layouts.default')

@section('title', 'Sozlamalar')

@section('content')

    @include('includes.errors')

    <div class="profile-header">
        <!-- BEGIN profile-header-cover -->
        <div class="profile-header-cover"></div>
        <!-- END profile-header-cover -->
        <!-- BEGIN profile-header-content -->
        <div class="profile-header-content">
            <!-- BEGIN profile-header-img -->
{{--            <div class="profile-header-img">--}}
{{--                <a href="{{ url('storage/'.$user->avatar)}}" target="_blank">--}}
{{--                    <img src="{{ url('storage/'.$user->avatar)}}" alt="">--}}
{{--                </a>--}}
{{--            </div>--}}
            <!-- END profile-header-img -->
            <!-- BEGIN profile-header-info -->
            <div class="profile-header-info">
                <h4 class="mt-0 mb-1">{{$user->first_name.' '.$user->last_name}}</h4>
                <p class="mb-2">{{$user->bio}}</p>
                <br/>
                <br/>
                {{--                <a href="#" class="btn btn-xs btn-yellow">Edit Profile</a>--}}
            </div>
            <!-- END profile-header-info -->
        </div>
        <!-- END profile-header-content -->
        <!-- BEGIN profile-header-tab -->
        <ul class="profile-header-tab nav nav-tabs">
            <li class="nav-item nav-link active"></li>
        </ul>
    </div>


    <div class="panel panel-inverse m-t-20">
        <!-- begin panel-heading -->
        <div class="panel-heading my_sidebar_bg">
            <h4 class="panel-title">
                <div class="panel-heading-btn">
                    {{--                    {{trans('product_content.products')}}--}}
                </div>
            </h4>
            <div class="panel-heading-btn">

            </div>
        </div>
        <!-- end panel-heading -->

        <!-- begin panel-body -->
        <div class="panel-body">
            <form action="{{route('dashboard.edit_profile')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group row ">
                    <label class="col-md-4 col-sm-4 col-form-label"
                           for="first_name">Ism * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input type="text" id="first_name" name="first_name" class="form-control"
                               value="{{$user->first_name}}">
                        @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-md-4 col-sm-4 col-form-label"
                           for="last_name">Familiya * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input type="text" id="last_name" name="last_name" class="form-control"
                               value="{{$user->last_name}}">
                        @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-md-4 col-sm-4 col-form-label"
                           for="middle_name">Qisqacha ma'lumot :</label>
                    <div class="col-md-8 col-sm-8">
                        <input type="text" id="bio" name="bio" class="form-control"
                               value="{{$user->bio}}">
                    </div>
                </div>

                <hr/>
                <div class="form-group row ">
                    <label class="col-md-4 col-sm-4 col-form-label"
                           for="login">Email * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" type="text" id="email" name="email"
                               value="{{$user->email}}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('email_have')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-md-4 col-sm-4 col-form-label"
                           for="old_password">Hozirgi parol * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" type="password" id="old_password"
                               name="old_password">
                        @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('old_password_wrong')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-md-4 col-sm-4 col-form-label"
                           for="new_password">Yangi parol :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control " type="password" id="new_password"
                               name="new_password">
                        @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-sm-4 col-form-label"
                           for="confirm_new_password">Yangi parolni tasdiqlash
                        :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" type="password" id="confirm_new_password"
                               name="confirm_new_password">
                        @error('confirm_not_equal')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr/>
                <div class="float-right">
                    <button type="submit"
                            class="btn btn-primary">Saqlash</button>
                </div>
            </form>
        </div>
        <!-- end panel-body -->
    </div>
@endsection
