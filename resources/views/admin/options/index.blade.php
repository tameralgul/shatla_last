@extends('layouts.app')

@section('bar_title')
الخصائص
@endsection
@section('sub-header')
<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-2">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">لوحة التحكم</h5>
        <!--end::Page Title-->
        <!--begin::Actions-->
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200">
        </div>
        <span class="text-muted font-weight-bold mr-4">الخصائص</span>
        <!--end::Actions-->
    </div>
</div>

@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">الخصائص
                        <span class="d-block text-muted pt-2 font-size-sm">عرض جميع &amp; الخصائص</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="" id="btn_show_modal" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <i class="ki ki-plus icon-sm"></i>
                        </span> خاصية جديدة </a>
                    <!--end::Button-->

                    <!--begin::Button-->

                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-bordered" id="options_datatable">
                                    <thead>
                                        <tr>
                                            <th width="3%">#</th>
                                            <th width="13%">الإسم</th>
                                            <th width="13%">الإيقونة</th>
                                            <th width="10%">التاريخ</th>
                                            <th width="10%">الإجراء</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="optionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editmodelHeading"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <form class="form" id="options_form">
                    <div class="card-body">
                        <div class="form-group">
                            <label>الخاصية :</label>
                            <div class="input-icon input-icon-right">
                                <input name="name" type="text" id="name" class="form-control" placeholder="" />
                                <small id="name_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=""> :الإيقونة</label>
                            {{-- <div class="dropdown bootstrap-select form-control dropup"> --}}
                            <select name="icon_id" id="icon_id" class="form-control">
                                <option disabled selected>الإيقونة:</option>
                                @foreach($icons as $icon)
                                <option value="{{$icon->id}}">{{$icon->name}}</option>
                                @endforeach
                            </select>
                            {{-- <small id="category_id_error" class="form-text text-danger"></small> --}}
                        </div>
                    </div>

                    <!--end::Form-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" id="saveBtn" class="btn btn-primary">حفظ</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editOptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <form class="form" id="edit_option_form">
                    <div class="card-body">
                        <div class="form-group">
                            <label>الخاصية :</label>
                            <div class="input-icon input-icon-right">
                                <input name="name" type="text" id="Editname" class="form-control" placeholder="" />
                                <small id="name_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <input type="hidden" id="option_id" name="option_id">
                        <div class="form-group">
                            <label class=""> :الإيقونة</label>
                            {{-- <div class="dropdown bootstrap-select form-control dropup"> --}}
                            <select name="icon_id" id="edit_icon_id" class="form-control">
                                <option disabled selected>الإيقونة:</option>

                            </select>
                            {{-- <small id="category_id_error" class="form-text text-danger"></small> --}}
                        </div>
                    </div>

                </form>
                <!--end::Form-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" id="EditsaveBtn" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push("js")

<script>
    var oTable;
    $(function(){
    
    BindDataTable();
    });
    function BindDataTable() {
    oTable = $('#options_datatable').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "responsive": true,
    serverSide: true,
    // select: true,
    "bDestroy": true,
    "bSort": true,
    visible: true,
    "iDisplayLength": 10,
    "sPaginationType": "full_numbers",
    "bAutoWidth":false,
    "bStateSave": true,
    columnDefs: [ {
    // targets: 0,
    visible: true
    } ],
    "language": {
    
    emptyTable:"لا يوجد بيانات لعرضها",
    "sProcessing": "جارٍ التحميل...",
    "sLengthMenu": "أظهر _MENU_ مدخلات",
    "sZeroRecords": "لم يعثر على أية سجلات",
    "sInfo": "إظهار _START_ إلى _END_ ",
    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
    "sInfoPostFix": "",
    "sSearch": "بحث:",
    'selectedRow': 'مجمل المحدد',
    "sUrl": "",
    "oPaginate": {
    "sFirst": "الأول",
    "sPrevious": "السابق",
    "sNext": "التالي",
    "sLast": "الأخير",
    }
    },
    "order": [[ 0, "asc" ]],
    ajax: {
    type: "GET",
    contentType: "application/json",
    url: '/dashboard/options',
    
    },
    columns: [
    
    { data: 'option_id', name: 'option_id' },
    { data: 'name', name: 'name'},
    { data: 'icon_name', name: 'icon_name' },
    { data: 'Date', name: 'Date' },
    {data: 'actions', name: 'actions',orderable:false,serachable:false,sClass:'text-center'},
    ],
    fnDrawCallback: function () {
    }
    });
    }
</script>

<script>
    var deleteID;
    var category_name;
    var SITEURL = '{{URL::to('')}}';
    $('body').on('click', '#getDeleteId', function(){
    deleteID = $(this).data('id');
    name = $(this).data('name');
    Swal.fire({
    title: 'هل أنت متأكد ؟',
    text: "هل أنت متأكد من حذف خاصية؟ " + name,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonText: 'إلغاء',
    cancelButtonColor: '#d33',
    confirmButtonText: 'نعم , إحذف'
    }).then((result) => {
    if (result.isConfirmed) {
    $.ajax({
    type: "get",
    url: SITEURL + "/dashboard/options/delete/" + deleteID,
    success: function (response) {
    if (response.status == 200) {
        toastr.success(response.success);
    }
    var oTable = $('#options_datatable').dataTable();
    oTable.fnDraw(false);
    },
    error: function (response) {
    if (response.status == 504) {
        toastr.error("حدث خطأ ما!");
    }
    }
    });
    }
    })
    });
</script>
<script>
    $(document).ready(function() {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

   $("#btn_show_modal").click(function(event) {
       event.preventDefault();
    $("#modelHeading").html("أضافة خاصية جديد");
    $("#options_form").trigger('reset');//to clear the form
     $("#optionsModal").modal('show');
   });
    $(document).on('click','#saveBtn',function() {

        $('#option').text('');

        let formData = new FormData($('#options_form')[0]);
        $.ajax({
        type: 'POST',
        url: "{{route('options.store')}}",
        data:formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
            if (response.status == 200) {
              toastr.success(response.success);
            }
        var oTable = $('#options_datatable').dataTable();
        oTable.fnDraw(false);
        $("#optionsModal").modal('hide');
        $("#options_form").trigger('reset');//to clear the form
        },
        error: function (reject){
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
            $("#" + key + "_error").text(val[0]); //# معناها اختار لي اسم الايررور
        });
        },
        });
    });
});
</script>

<script>
    $(function () {
         $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $(document).on('click', '.editOption', function (event) {
                event.preventDefault();
                var option_id = $(this).data('id');
                // alert(option_id);
                $.ajax({
                url:'/dashboard/options/edit/' + option_id,
                method:'get',
                success:function(data) {
                $('#editmodelHeading').html("تعديل الخاصية");
                $('#EditsaveBtn').val("edit-tag");
                $('#editOptionModal').modal('show');
                $('#option_id').val(data.result.id);
                $('#Editname').val(data.result.name);
                $('#edit_icon_id').html(" ")
                $.each(data.icons,function(index,value){
                  $('#edit_icon_id').append('<option value="'+ value.id +'">'+value.name+'</option>')
                    })
                    $('#edit_icon_id').val(data.icon_id.id)
                    }
                    })
            });
                $(document).on('click','#EditsaveBtn',function() {
                   let option_form = document.getElementById('edit_option_form');
                   let form_data = new FormData(option_form);
                   $.ajax({
                    url:"/dashboard/options/update",
                    method:'post',
                    data:form_data,
                    dataType:'json',
                    success:function (response){
                    if (response.status == 504){
                       toastr.error("حدث خطأ ما!");
                    }
                    else if (response.status == 200) {
                     toastr.success(response.success);
                    var oTable = $('#options_datatable').dataTable();
                    oTable.fnDraw(false);
                    $('#editOptionModal').modal('hide');
                    } },
                    contentType: false,
                    cache: false,
                    processData: false,
                    })
                  })
        });
</script>
@endpush