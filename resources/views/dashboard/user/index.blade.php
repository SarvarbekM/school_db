@extends('layouts.default')

@section('title', 'Foydalanuvchilar')

@section('content')
    @include('includes.errors')

    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">
                Foydalanuvchilar ro'yxati
            </h4>
            <div class="panel-heading-btn">
                <a class="btn btn-xs btn-success m-l-10"
                   href="{{route('dashboard.user.arcade',['id'=>0])}}"
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
            <form class="m-b-20" method="get" name="search_form" action="{{route('dashboard.user.index')}}">
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               value="{{$search['first_name']}}"
                               placeholder="Ism"/>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="last_name" name="last_name"
                               value="{{$search['last_name']}}"
                               placeholder="Familiya"/>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="bio" name="bio"
                               value="{{$search['bio']}}"
                               placeholder="bio"/>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="email" name="email"
                               value="{{$search['email']}}"
                               placeholder="Email"/>
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
                    <th class="text-nowrap bg-light-darker">Ism</th>
                    <th class="text-nowrap bg-light-darker">Familiya</th>
                    <th class="text-nowrap bg-light-darker">Bio</th>
                    <th class="text-nowrap bg-light-darker">Email</th>
                    <th style="width: 130px;" data-orderable="false" class="bg-light-darker"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($objects as $item)
                    <tr>
                        <td width="1%" class="f-s-600 text-inverse">{{$loop->index+1}}</td>
                        <td>{{$item->first_name}}</td>
                        <td>{{$item->last_name}}</td>
                        <td>{{$item->bio}}</td>
                        <td>{{$item->email}}</td>
                        <td style="text-align: center;">
                            <a title="Tahrirlash"
                               class="btn btn-icon btn-primary mr-1 edit"
                               href="{{route('dashboard.user.arcade',['id'=>$item->id])}}"
                            >
                                <i class="fa fa-edit"></i>
                            </a>
                            <button
                                title="O'chirish" type="button"
                                class="btn btn-icon btn-danger delete_button delete infoU"
                                data-record-id="{{$item->id}}"
                                data-record-title="{{$item->first_name.' '.$item->last_name}}"
                                data-toggle="modal" data-target="#confirm-delete"
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
    @include('includes.user.delete_modal')
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
    </script>
@endpush
