<div class="modal fade" id="add_edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{route('dashboard.teacher.add_edit')}}" name="add_class_form">
                @csrf
                <input type="hidden" id="add_edit_id" name="add_edit_id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    {{--                                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>--}}
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="add_edit_full_name">FIO</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" required class="form-control" id="add_edit_full_name" name="add_edit_full_name"
                                   value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="add_edit_address">Manzil</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="add_edit_address" name="add_edit_address"
                                   value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="add_edit_speciality">Mutaxassislik</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="add_edit_speciality" name="add_edit_speciality"
                                   value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">Yopish
                    </button>
                    <button type="submit" class="btn btn-primary btn-ok">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>

