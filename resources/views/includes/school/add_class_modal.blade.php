<div class="modal fade" id="add_class_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{route('dashboard.school.add_class')}}" name="add_class_form">
                @csrf
                <input type="hidden" id="school_id" name="school_id" value="{{$object->id}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    {{--                                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>--}}
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="number">Sinflar</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="sinf" id="sinf">
                                @foreach($classes as $item)
                                    <option value="{{$item->id}}">
                                        {{$item->code}}
                                    </option>
                                @endforeach
                            </select>
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

