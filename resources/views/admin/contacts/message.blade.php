@if (is_null($contact_us->message))
لا توجد رسالة
@else
<button data-toggle="modal" data-target="#contact_{{$contact_us->id}}" class="btn btn-success btn-sm"
    id="notbtn">عرض الرسالة</button>
@endif

<div class="modal fade" id="contact_{{$contact_us->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">عرض الرسالة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body " style=" text-align: right!important;font-size: 1.3em!important;">
                {{$contact_us->message}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>