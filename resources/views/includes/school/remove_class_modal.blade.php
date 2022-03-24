<div class="modal fade" id="remove_class_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{route('dashboard.school.remove_class')}}" name="delete_form">
                @csrf
                <input type="hidden" id="school_id" name="school_id" value="{{$object->id}}">
                <input type="hidden" id="class_id" name="class_id" value="">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Rostan ham <b><i class="title"></i></b>ni o'chirmoqchimisiz ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">Yopish
                    </button>
                    <button type="submit" class="btn btn-danger btn-ok">O'chirish</button>
                </div>
            </form>
        </div>
    </div>
</div>

