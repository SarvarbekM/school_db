@extends('layouts.default')

@section('title', '')

@section('content')
    @include('includes.errors')

    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">
                {{--                {{$object->name}}--}}
            </h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="m-l-10 btn btn-xs btn-icon btn-circle btn-warning"
                   data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->

        <!-- begin panel-body -->
        <div class="panel-body">
            <form action="{{route('dashboard.user.add_edit')}}" method="post" name="add_edit_form">
                @csrf
                <input type="hidden" name="id" id="id" value="{{$user->id}}">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="first_name">Ism</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="first_name" required
                               name="first_name" value="{{$user->first_name}}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="last_name">Familiya</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="last_name" required
                               name="last_name" value="{{$user->last_name}}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="bio">Bio</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="bio"
                               name="bio" value="{{$user->bio}}">
                    </div>
                </div>

                <hr/>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" required
                               name="email" value="{{$user->email}}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="password">Parol</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="password" {{$user->id==0?'required':''}}
                        name="password" value="">
                    </div>
                </div>

                <div class="float-right">
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
            </form>
        </div>
        <!-- end panel-body -->
    </div>

@endsection

@push('scripts')
    <script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/demo/table-manage-fixed-columns.demo.js"></script>
    <script>
        $('#confirm-delete').on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            document.getElementById('id').value = data.recordId;
        });
    </script>
@endpush
