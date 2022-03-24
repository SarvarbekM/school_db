@extends('layouts.default')

@section('title', 'O\'qituvchilar')

@section('content')
    @include('includes.errors')

    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">
                O'qituvchilar ro'yxati
            </h4>
            <div class="panel-heading-btn">
                <button class="btn btn-xs btn-success m-l-10"
                        data-record-id="0"
                        data-record-speciality=""
                        data-record-fullname=""
                        data-record-address=""
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
            <form class="m-b-20" method="get" name="search_form" action="{{route('dashboard.teacher.index')}}">
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" id="full_name" name="full_name"
                               value="{{$search['full_name']}}"
                               placeholder="FIO"/>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="address" name="address"
                               value="{{$search['address']}}"
                               placeholder="Manzil"/>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="speciality" name="speciality"
                               value="{{$search['speciality']}}"
                               placeholder="Mutaxassislik"/>
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
                    <th class="text-nowrap bg-light-darker">FIO</th>
                    <th class="text-nowrap bg-light-darker">Manzil</th>
                    <th class="text-nowrap bg-light-darker">Mutaxassislik</th>
                    <th style="width: 130px;" data-orderable="false" class="bg-light-darker"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($objects as $item)
                    <tr>
                        <td width="1%" class="f-s-600 text-inverse">{{$loop->index+1}}</td>
                        <td>{{$item->full_name}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->speciality}}</td>
                        <td style="text-align: center;">

                            <button title="Tahrirlash"
                                    class="btn btn-icon btn-primary mr-1 edit"
                                    data-record-id="{{$item->id}}"
                                    data-record-speciality="{{$item->speciality}}"
                                    data-record-fullname="{{$item->full_name}}"
                                    data-record-address="{{$item->address}}"
                                    data-toggle="modal" data-target="#add_edit_modal"
                            >
                                <i class="fa fa-edit"></i>
                            </button>
                            <button
                                title="O'chirish" type="button"
                                class="btn btn-icon btn-danger delete_button delete infoU"
                                data-record-id="{{$item->id}}"
                                data-record-title="{{$item->full_name}}"
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
    @include('includes.teacher.delete_modal')
    @include('includes.teacher.add_edit_modal')
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

        $('#add_edit_modal').on('show.bs.modal', function (e) {
            let data = $(e.relatedTarget).data();
            document.getElementById('add_edit_id').value = data.recordId;
            document.getElementById('add_edit_full_name').value = data.recordFullname;
            document.getElementById('add_edit_address').value = data.recordAddress;
            document.getElementById('add_edit_speciality').value = data.recordSpeciality;
        });
    </script>
@endpush
