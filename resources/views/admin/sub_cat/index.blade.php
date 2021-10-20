@extends('layouts.app')

@section('bar_title')
التصنيفات الفرعية
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
        <span class="text-muted font-weight-bold mr-4">التصنيفات الفرعية</span>
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
                    <h3 class="card-label">التصنيفات الفرعية
                        <span class="d-block text-muted pt-2 font-size-sm">عرض جميع &amp; التصنيفات الفرعية</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="" id="btn_show_modal" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <i class="ki ki-plus icon-sm"></i>
                        </span>تصنيف فرعي جديد </a>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-bordered"
                                    id="subsubcategories_datatable">
                                    <thead>
                                        <tr>
                                            <th width="3%">#</th>
                                            <th width="13%">التصنيف الفرعي</th>
                                            <th width="13%">التصنيف الأب</th>
                                            <th width="10%">التاريخ</th>
                                            <th width="10%">الإجراء</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="subcategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form class="form" id="subcategory_form">
                    <div class="card-body">
                        <div class="form-group">
                            <label>التصنيف :</label>
                            <div class="input-icon input-icon-right">
                                <input name="name" type="text" id="name" class="form-control" placeholder="" />
                                <small id="name_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=""> :التصنيف الأب</label>
                            {{-- <div class="dropdown bootstrap-select form-control dropup"> --}}
                            <select name="category_id" id="category_id" class="form-control">
                                <option disabled selected>التصنيف:</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
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

<div class="modal fade" id="editsubModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form class="form" id="edit_sub_form">
                    <div class="card-body">
                        <div class="form-group">
                            <label>الصنف الفرعي :</label>
                            <div class="input-icon input-icon-right">
                                <input name="name" type="text" id="Editname" class="form-control" placeholder="" />
                                <small id="name_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <input type="hidden" id="subcategory_id" name="subcategory_id">
                        <div class="form-group">
                            <label class=""> :الصنف الأب</label>
                            {{-- <div class="dropdown bootstrap-select form-control dropup"> --}}
                            <select name="category_id" id="edit_category_id" class="form-control">
                              
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
    oTable = $('#subsubcategories_datatable').DataTable({
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
    url: '/dashboard/subcategories',
    
    },
    columns: [
    
    { data: 'sub_id', name: 'sub_id' },
    { data: 'name', name: 'name' },
    { data: 'category_name', name: 'category_name' },
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
    category_name = $(this).data('name');
    Swal.fire({
    title: 'هل أنت متأكد ؟',
    text: "هل أنت متأكد من حذف تصنيف؟ " + category_name,
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
    url: SITEURL + "/dashboard/subcategories/delete/" + deleteID,
    success: function (response) {
    if (response.status == 200) {
        toastr.success(response.success);
        var oTable = $('#subcategories_datatable').dataTable();
        oTable.fnDraw(false);
    }else if(response.status == 504){
        toastr.error(response.error);
    }
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
    $("#modelHeading").html("أضافة تصنيف جديد");
    $("#subcategory_form").trigger('reset');//to clear the form
     $("#subcategoryModal").modal('show');
   });
    $(document).on('click','#saveBtn',function() {
       
        $('#name').text('');
        // $("#category_id").text('');
       let subCat_form = document.getElementById('subcategory_form');
       let form_data = new FormData(subCat_form);
        $.ajax({
        type: 'POST',
        url: "{{route('subcategories.store')}}",
        data:form_data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
            if (response.status == 200) {
              toastr.success(response.success);
            }
        var oTable = $('#subsubcategories_datatable').dataTable();
        oTable.fnDraw(false);
        $("#subcategoryModal").modal('hide');
        $("#subcategory_form").trigger('reset');//to clear the form
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
            $(document).on('click', '.editSub', function (event) {
                event.preventDefault();
                var sub_id = $(this).data('id');
                // alert(option_id);
                $.ajax({
                url:'/dashboard/subcategories/edit/' + sub_id,
                method:'get',
                success:function(data) {
                $('#editmodelHeading').html("تعديل الصنف");
                $('#EditsaveBtn').val("edit-tag");
                $('#editsubModal').modal('show');
                $('#subcategory_id').val(data.result.id);
                $('#Editname').val(data.result.name);
                $('#edit_category_id').html(" ")
                $.each(data.categories,function(index,value){
                  $('#edit_category_id').append('<option value="'+ value.id +'">'+value.name+'</option>')
                    })
                    $('#edit_category_id').val(data.category_id.id)
                    }
                    })
            });
                $(document).on('click','#EditsaveBtn',function() {
                   let sub_form = document.getElementById('edit_sub_form');
                   let form_data = new FormData(sub_form);
                   $.ajax({
                    url:"/dashboard/subcategories/update",
                    method:'post',
                    data:form_data,
                    dataType:'json',
                    success:function (response){
                    if (response.status == 504){
                       toastr.error("حدث خطأ ما!");
                    }
                    else if (response.status == 200) {
                     toastr.success(response.success);
                    var oTable = $('#subsubcategories_datatable').dataTable();
                    oTable.fnDraw(false);
                    $('#editsubModal').modal('hide');
                    } },
                    contentType: false,
                    cache: false,
                    processData: false,
                    })
                  })
        });
</script>
@endpush