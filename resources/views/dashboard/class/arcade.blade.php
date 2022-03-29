@extends('layouts.default')

@section('title', $object->code)

@section('content')
    @include('includes.errors')

    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">
                {{$object->code}}
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
            <form action="{{route('dashboard.class.add_edit')}}" method="post" name="add_edit_form">
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
                        <input type="text" class="form-control" id="code" required
                               name="code" value="{{$object->code}}">
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
                    Darslar
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
                <form class="m-b-20" method="post" name="add_form" action="{{route('dashboard.class.add_lesson')}}">
                    @csrf
                    <input type="hidden" name="class_id" value="{{$object->id}}">
                    <div class="form-row">
                        <div class="col">
                            <select class="form-control" name="lesson_id" id="selected_lesson_id">
                                @foreach($lessons as $item)
                                    <option value="{{$item->id}}">
                                        {{$item->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="teacher_id" id="teacher_id">
                                @foreach($teachers as $item)
                                    <option value="{{$item->id}}">
                                        {{$item->full_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-info">Qo'shish</button>
                        </div>
                    </div>
                </form>


                <table id="data-table-fixed-columns2"
                       class="table table-striped table-hover table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th width="1%" class="bg-light-darker">№</th>
                        <th class="text-nowrap bg-light-darker">Nom</th>
                        <th class="text-nowrap bg-light-darker">O'qituvchi</th>
                        <th style="width: 130px;" data-orderable="false" class="bg-light-darker"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($object->lessons as $item)
                        <tr>
                            <td width="1%" class="f-s-600 text-inverse">{{$loop->index+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                @foreach($item->teachers as $teach)
                                    <p>{{$teach->full_name}}</p>
                                @endforeach
                            </td>
                            <td style="text-align: center;">
                                <button
                                    title="O'chirish" type="button"
                                    class="btn btn-icon btn-danger delete_button delete infoU"
                                    data-record-id="{{$item->id}}"
                                    data-record-title="{{$item->name}}"
                                    data-toggle="modal" data-target="#remove_lesson_modal"
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
    @include('includes.class.remove_lesson_modal')
@endsection

@push('scripts')
    <script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/demo/table-manage-fixed-columns.demo.js"></script>
    <script>
        $('#confirm-delete').on('show.bs.modal', function (e) {
            let data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            document.getElementById('id').value = data.recordId;
        });

        $('#remove_lesson_modal').on('show.bs.modal', function (e) {
            let data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            document.getElementById('lesson_id').value = data.recordId;
        });
    </script>
@endpush
