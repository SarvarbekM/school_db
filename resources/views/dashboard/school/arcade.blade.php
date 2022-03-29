@extends('layouts.default')

@section('title', $object->name)

@section('content')
    @include('includes.errors')

    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">
                {{$object->name}}
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
            <form action="{{route('dashboard.school.add_edit')}}" method="post" name="add_edit_form">
                @csrf
                <input type="hidden" name="id" id="id" value="{{$object->id}}">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="number">Raqam</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="number" required
                               name="number" value="{{$object->number}}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="name">Nom</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" required
                               name="name" value="{{$object->name}}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="address">Manzil</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="address" required
                               name="address" value="{{$object->address}}">
                    </div>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
            </form>
        </div>
        <!-- end panel-body -->
    </div>

    @if($object->id>0)
    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">
                Sinflar
            </h4>
            <div class="panel-heading-btn">

                    <button data-toggle="modal" data-target="#add_class_modal"
                            class="btn btn-xs btn-success m-l-10"
                    ><i class="fa fa-plus"></i> Qo'shish
                    </button>

                <a href="javascript:;" class="m-l-10 btn btn-xs btn-icon btn-circle btn-warning"
                   data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->

        <!-- begin panel-body -->
        <div class="panel-body">
            <table id="data-table-fixed-columns2"
                   class="table table-striped table-hover table-bordered table-td-valign-middle">
                <thead>
                <tr>
                    <th width="1%" class="bg-light-darker">№</th>
                    <th class="text-nowrap bg-light-darker">Raqam</th>
                    <th class="text-nowrap bg-light-darker">Nom</th>
                    <th style="width: 130px;" data-orderable="false" class="bg-light-darker"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($object->classes as $item)
                    <tr>
                        <td width="1%" class="f-s-600 text-inverse">{{$loop->index+1}}</td>
                        <td>{{$item->number}}</td>
                        <td>{{$item->code}}</td>
                        <td style="text-align: center;">
                            <button
                                title="O'chirish" type="button"
                                class="btn btn-icon btn-danger delete_button delete infoU"
                                data-record-id="{{$item->class_id}}"
                                data-record-title="{{$item->code}}"
                                data-toggle="modal" data-target="#remove_class_modal"
                            >
                                <i class="fas fa-trash  text-white"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
        <!-- end panel-body -->
    </div>
    @endif
    @include('includes.school.add_class_modal')
    @include('includes.school.remove_class_modal')
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

        $('#remove_class_modal').on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            document.getElementById('class_id').value = data.recordId;
        });
    </script>
@endpush
