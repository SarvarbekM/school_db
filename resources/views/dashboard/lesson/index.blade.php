@extends('layouts.default')

@section('title', 'Darslar')

@section('content')
    @include('includes.errors')

    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">
                Darslar ro'yxati
            </h4>
            <div class="panel-heading-btn">
                <button class="btn btn-xs btn-success m-l-10"
                        data-record-id="0"
                        data-record-title=""
                        data-toggle="modal" data-target="#add_edit_modal">
                    <i class="fa fa-plus"></i> Qo'shish
                </button>

                <a href="javascript:;" class="m-l-10 btn btn-xs btn-icon btn-circle btn-warning"
                   data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->

        <!-- begin panel-body -->
        <div class="panel-body">
            <!-- begin Search panel -->
            <form class="m-b-20" method="get" name="search_form" action="{{route('dashboard.lesson.index')}}">
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" id="name" name="name" value="{{$search['name']}}"
                               placeholder="Nom"/>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-info">Qidirish</button>
                    </div>
                </div>
            </form>
            <!-- end Search panel -->

            <table id="data-table-fixed-columns2"
                   class="table table-striped table-hover table-bordered table-td-valign-middle">
                <thead>
                <tr>
                    <th width="1%" class="bg-light-darker">№</th>
                    <th class="text-nowrap bg-light-darker">Nom</th>
                    <th class="text-nowrap bg-light-darker">Sinflar</th>
                    <th style="width: 130px;" data-orderable="false" class="bg-light-darker"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($objects as $item)
                    <tr>
                        <td width="1%" class="f-s-600 text-inverse">{{$loop->index+1}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            <ul>
                                @foreach($item->classes as $class)
                                    <li>
                                        <a href="{{route('dashboard.class.arcade',['id'=>$class->id])}}">{{$class->code}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td style="text-align: center;">

                            <button title="Tahrirlash"
                                    class="btn btn-icon btn-primary mr-1 edit"
                                    data-record-id="{{$item->id}}"
                                    data-record-title="{{$item->name}}"
                                    data-toggle="modal" data-target="#add_edit_modal"
                            >
                                <i class="fa fa-edit"></i>
                            </button>
                            <button
                                title="O'chirish" type="button"
                                class="btn btn-icon btn-danger delete_button delete infoU"
                                data-record-id="{{$item->id}}"
                                data-record-title="{{$item->name}}"
                                data-toggle="modal" data-target="#confirm-delete"
                            >
                                <i class="fas fa-trash  text-white"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>


            {{trans('content.pagination', ['start_index'=>($objects->currentpage()-1)*$objects->perpage() + ($objects->total()==0?0:1),
    'end_index'=>($objects->currentpage()-1)*$objects->perpage() + count($objects->items()),'total'=>$objects->total()])}}
            <div class="float-right">{{$objects->withQueryString()->links()}}</div>
        </div>
        <!-- end panel-body -->
    </div>
    @include('includes.lesson.add_edit_modal')
    @include('includes.lesson.delete_modal')
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

        $('#add_edit_modal').on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            document.getElementById('add_edit_id').value = data.recordId;
            document.getElementById('add_edit_name').value = data.recordTitle;
        });
    </script>
@endpush
