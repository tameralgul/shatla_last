@extends('layouts.app')

@section('bar_title')
الخصومات
@endsection
@push('css')
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
@endpush

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
        <span class="text-muted font-weight-bold mr-4">الخصومات</span>
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
                    <h3 class="card-label">الخصومات
                        <span class="d-block text-muted pt-2 font-size-sm">عرض جميع &amp; الخصومات</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="" id="btn_show_modal" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <i class="ki ki-plus icon-sm"></i>
                        </span>خصم جديد </a>
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
                                <table class="table table-hover text-nowrap table-bordered" id="discounts_datatable">
                                    <thead>
                                        <tr>
                                            <th width="3%">#</th>
                                            <th width="13%">قيمة الخصم</th>
                                            <th width="10%">نوع الخصم</th>
                                            <th width="10%">تاريخ النهاية</th>
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

<div class="modal fade" id="discountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form class="form" id="discount_form">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-12 row">
                                <div class="dropdown bootstrap-select form-control col-sm-8">
                                    <select name="type" id="type" class="form-control selectpicker" data-size="7"
                                        data-live-search="true" tabindex="null">
                                        <option disabled selected>نسبة الخصم:</option>
                                        <option value="1">قيمة رقمية</option>
                                        <option value="0">نسبة</option>
                                    </select>
                                    <small id="type_error" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 row d-flex flex-column" style="margin-right: 6px">
                                <label>تاريخ النهاية :</label>
                                <div class="input-icon input-icon-right">
                                    <input name="expired_date" type="date" id="expired_date" autocomplete="off"
                                        class="datepicker form-control expired-date">
                                    <small id="expired_date_error" class="form-text text-danger"></small>
                                </div>

                            </div>
                            <div class="form-group col-sm-12 ">
                                <label>قيمة الخصم :</label>
                                <div class="input-icon input-icon-right col-sm-8">
                                    <input name="value" type="text" id="value" class="form-control" placeholder="" />
                                    <small id="value_error" class="form-text text-danger"></small>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
                <!--end::Form-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" id="saveBtn" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit_discount_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form class="form" id="edit_discount_form">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-8 row">
                                {{-- <div class="form-control col-sm-8"> --}}
                                <select name="type" id="edit_type" class="form-control">
                                    <option disabled selected>نسبة الخصم:</option>
                                    <option value="1">قيمة رقمية</option>
                                    <option value="0">نسبة</option>
                                </select>
                                <small id="type_error" class="form-text text-danger"></small>
                                {{-- </div> --}}
                            </div>
                            <div class="form-group col-sm-12 row d-flex flex-column" style="margin-right: 6px">
                                <label>تاريخ النهاية :</label>
                                <div class="input-icon input-icon-right">
                                    <input name="expired_date" type="date" id="edit_expired_date" autocomplete="off"
                                        class="datepicker form-control expired-date">
                                    <small id="expired_date_error" class="form-text text-danger"></small>
                                </div>
                                <input type="hidden" name="discount_id" id="discount_id">
                            </div>
                            <div class="form-group col-sm-12 ">
                                <label>قيمة الخصم :</label>
                                <div class="input-icon input-icon-right col-sm-8">
                                    <input name="value" type="text" id="editValue" class="form-control"
                                        placeholder="" />
                                    <small id="edit_value_error" class="form-text text-danger"></small>
                                </div>
                            </div>
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

@push('js')
<script>
    var oTable;
    $(function(){
    
    BindDataTable();
    });
    function BindDataTable() {
    oTable = $('#discounts_datatable').DataTable({
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
    url: '/dashboard/discounts',
    
    },
    columns: [
    
    { data: 'id', name: 'id' },
    { data: 'value', name: 'value' },
    { data: 'type', name: 'type' },
    { data: 'expired_date', name: 'expired_date' },
    { data: 'Date', name: 'Date' },
    {data: 'actions', name: 'actions',orderable:false,serachable:false,sClass:'text-center'},
    ],
    
    fnDrawCallback: function () {
    }
    });
    }
</script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $('#btn_show_modal').on('click',function(event) {
        event.preventDefault();
       $("#modelHeading").html("أضافة وسم جديد");
        $("#discount_form").trigger('reset');//to clear the form
        $("#discountModal").modal('show');   
    });
    $(document).on('click','#saveBtn',function() {
    
    $('#type_error').text(''); 
    $('#value_error').text('');
    $('#expired_date_error').text('');
    
    let formData = new FormData($('#discount_form')[0]);
    $.ajax({
    type: 'POST',
    url: "{{route('discounts.store')}}",
    data:formData,
    processData: false,
    contentType: false,
    cache: false,
    
    success: function (response) {
    if (response.status == 200) {
    toastr.success(response.success);
    }else if(response.status == 504){
    toastr.error(response.error);
    }
    var oTable = $('#discounts_datatable').dataTable();
    oTable.fnDraw(false);
    $("#discountModal").modal('hide');
    $("#discount_form").trigger('reset');//to clear the form
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
        $(document).on('click', '.editDiscount', function (event) {
        var discount_id = $(this).data('id');
           $.ajax({
               url:'/dashboard/discounts/edit/' + discount_id,
               method:'get',
               success:function(data) {
                   $('#editmodelHeading').html("تعديل الخصم");
                    $('#EditsaveBtn').val("edit-discount");
                    $('#edit_discount_Modal').modal('show');
                    $('#discount_id').val(data.result.id);
                    $('#editValue').val(data.result.value);
                    $('#edit_expired_date').val(data.result.expired_date);
                    $("#edit_type").val(data.result.type);
               }
           })
            });
            $(document).on('click','#EditsaveBtn',function() {
               let discount_form = document.getElementById('edit_discount_form');
               let form_data = new FormData(discount_form);
               $.ajax({
                url:"/dashboard/discounts/update",
                method:'post',
                data:form_data,
                dataType:'json',
                success:function (response){
                if (response.status == 504){
                   toastr.error("حدث خطأ ما!");
                }
                else if (response.status == 200) {
    
                 toastr.success(response.success);
                var oTable = $('#discounts_datatable').dataTable();
                    oTable.fnDraw(false);
                    $('#edit_discount_Modal').modal('hide');
    
                } },
                contentType: false,
                cache: false,
                processData: false,
                })
              })
    });
</script>

<script>
    var deleteID;
    var category_name;
    var SITEURL = '{{URL::to('')}}';
    $('body').on('click', '#getDeleteId', function(){
    deleteID = $(this).data('id');
    Swal.fire({
    title: 'هل أنت متأكد ؟',
    text: "هل أنت متأكد من الحذف ",
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
    url: SITEURL + "/dashboard/discounts/delete/" + deleteID,
    success: function (response) {
    if (response.status == 200) {
        toastr.success(response.success);
    }
    var oTable = $('#discounts_datatable').dataTable();
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
@endpush