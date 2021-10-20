@extends('layouts.app')

@section('bar_title')
المدن
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
        <span class="text-muted font-weight-bold mr-4">المدن</span>
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
                    <h3 class="card-label">المدن
                        <span class="d-block text-muted pt-2 font-size-sm">عرض جميع &amp; المدن</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="" id="btn_show_modal" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <i class="ki ki-plus icon-sm"></i>
                        </span>مدينة جديدة</a>
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
                                <table class="table table-hover text-nowrap table-bordered" id="cities_datatable">
                                    <thead>
                                        <tr>
                                            <th width="3%">#</th>
                                            <th width="13%">المدينة</th>
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
<div class="modal fade" id="cityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form class="form" id="city_form">
                    <div class="card-body">
                        <div class="form-group">
                            <label>المدينة :</label>
                            <div class="input-icon input-icon-right">
                                <input name="name" type="text" id="name" class="form-control" placeholder="" />
                                <small id="name_error" class="form-text text-danger"></small>
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
<div class="modal fade" id="edit_city_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form class="form" id="edit_city_form">
                    <div class="card-body">
                        <div class="form-group">
                            <label>المدينة :</label>
                            <div class="input-icon input-icon-right">
                                <input name="name" type="text" id="EditName" class="form-control" placeholder="" />
                            </div>
                            <input type="hidden" name="city_id" id="city_id">
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
    oTable = $('#cities_datatable').DataTable({
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
    url: '/dashboard/cities',
    
    },
    columns: [
    
    { data: 'id', name: 'id' },
    { data: 'name', name: 'name' },
    { data: 'Date', name: 'Date' },
    {data: 'actions', name: 'actions',orderable:false,serachable:false,sClass:'text-center'},
    ],
    
    fnDrawCallback: function () {
    }
    });
    }
</script>
<script>
    $(function () {
    
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $(document).on('click', '.editCity', function (event) {
        var city_id = $(this).data('id');
        // alert(category_id);
           $.ajax({
               url:'/dashboard/cities/edit/' + city_id,
               method:'get',
               success:function(data) {
                   $('#editmodelHeading').html("تعديل المدينة");
                    $('#saveBtn').val("edit-city");
                    $('#edit_city_Modal').modal('show');
                    $('#city_id').val(data.result.id);
                    $('#EditName').val(data.result.name);
               }
           })
            });
            $(document).on('click','#EditsaveBtn',function() {
               let city_form = document.getElementById('edit_city_form');
               let form_data = new FormData(city_form);
               $.ajax({
                url:"/dashboard/cities/update",
                method:'post',
                data:form_data,
                dataType:'json',
                success:function (response){
                if (response.status == 504){
                   toastr.error("حدث خطأ ما!");
                }
                else if (response.status == 200) {
    
                 toastr.success(response.success);
                var oTable = $('#cities_datatable').dataTable();
                    oTable.fnDraw(false);
                    $('#edit_city_Modal').modal('hide');
    
                } },
                contentType: false,
                cache: false,
                processData: false,
                })
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
    $('#btn_show_modal').on('click',function(event) {
        event.preventDefault();
       $("#modelHeading").html("أضافة مدينة جديدة");
        $("#city_form").trigger('reset');//to clear the form
        $("#cityModal").modal('show');   
    });
    $(document).on('click','#saveBtn',function() {
    
    $('#name').text('');
    
    let formData = new FormData($('#city_form')[0]);
    $.ajax({
    type: 'POST',
    url: "{{route('cities.store')}}",
    data:formData,
    processData: false,
    contentType: false,
    cache: false,
    
    success: function (response) {
    if (response.status == 200) {
    toastr.success(response.success);
    }
    var oTable = $('#cities_datatable').dataTable();
    oTable.fnDraw(false);
    $("#cityModal").modal('hide');
    $("#city_form").trigger('reset');//to clear the form
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
    var deleteID;
    var category_name;
    var SITEURL = '{{URL::to('')}}';
    $('body').on('click', '#getDeleteId', function(){
    deleteID = $(this).data('id');
    city_name = $(this).data('name');
    Swal.fire({
    title: 'هل أنت متأكد ؟',
    text: "هل أنت متأكد من حذف المدينة " + city_name,
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
    url: SITEURL + "/dashboard/cities/delete/" + deleteID,
    success: function (response) {
    if (response.status == 200) {
        toastr.success(response.success);
    }
    var oTable = $('#cities_datatable').dataTable();
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