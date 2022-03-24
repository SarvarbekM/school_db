@extends('layouts.default')

@section('title', 'Sinflar')

@section('content')

    @include('includes.errors')

    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">
                Sinflar
            </h4>
            <div class="panel-heading-btn">
                <a href="{{route('dashboard.class.arcade',['id'=>0])}}" class="btn btn-xs btn-success m-l-10"
                ><i class="fa fa-plus"></i> Qo'shish</a>

                <a href="javascript:;" class="m-l-10 btn btn-xs btn-icon btn-circle btn-warning"
                   data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->

        <!-- begin panel-body -->
        <div class="panel-body">
            <!-- begin Search panel -->
            <form class="m-b-20" method="get" name="search_form" action="{{route('dashboard.class.index')}}">
                <div class="form-row">
                    <div class="col">
                        <input type="number" class="form-control" id="number" name="number"
                               value="{{$search['number']>0?$search['number']:''}}"
                               placeholder="Raqam"/>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="code" name="code" value="{{$search['code']}}"
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
                    <th class="text-nowrap bg-light-darker">Raqam</th>
                    <th class="text-nowrap bg-light-darker">Nom</th>
                    <th style="width: 130px;" data-orderable="false" class="bg-light-darker"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($objects as $item)
                    <tr>
                        <td width="1%" class="f-s-600 text-inverse">{{$loop->index+1}}</td>
                        <td>{{$item->number}}</td>
                        <td>{{$item->code}}</td>
                        <td style="text-align: center;">

                            <a title="Tahrirlash" href="{{route('dashboard.class.arcade',['id'=>$item->id])}}"
                               class="btn btn-icon btn-primary mr-1 edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button
                                title="O'chirish" type="button"
                                class="btn btn-icon btn-danger delete_button delete infoU"
                                data-record-id="{{$item->id}}"
                                data-record-title="{{$item->code}}"
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
    @include('includes.class.delete_modal')
@endsection

@push('scripts')
    <script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/demo/table-manage-fixed-columns.demo.js"></script>
    <script>
        $('#confirm-delete').on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            document.getElementById('id').value = data.recordId;
            // document.getElementById('id').value = 10000;
        });
    </script>
@endpush
