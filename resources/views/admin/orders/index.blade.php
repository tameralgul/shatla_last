@extends('layouts.app')

@section('bar_title')
الطلبات
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
        <span class="text-muted font-weight-bold mr-4">الطلبات</span>
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
                    <h3 class="card-label">الطلبات
                        <span class="d-block text-muted pt-2 font-size-sm">عرض جميع &amp; الطلبات</span>
                    </h3>
                </div>
                
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-bordered" id="orders_datatable">
                                    <thead>
                                        <tr>
                                            <th width="3%">#</th>
                                            <th width="13%">الإيميل</th>
                                            <th width="13%">رقم الهاتف</th>
                                            <th width="13%">حالة الطلب</th>
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


@endsection

@push('js')

<script>
    var oTable;
    $(function(){
    
    BindDataTable();
    });
    function BindDataTable() {
    oTable = $('#orders_datatable').DataTable({
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
    url: '/dashboard/orders',
    
    },
    columns: [
    
    { data: 'id', name: 'id' },
    { data: 'email', name: 'email' },
    { data: 'phone', name: 'phone' },
    { data: 'order_status', name: 'order_status' },
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
        $(document).on('click', '.editTag', function (event) {
        var tag_id = $(this).data('id');
        // alert(category_id);
           $.ajax({
               url:'/dashboard/tags/edit/' + tag_id,
               method:'get',
               success:function(data) {
                   $('#editmodelHeading').html("تعديل الوسم");
                    $('#saveBtn').val("edit-tag");
                    $('#edit_tag_Modal').modal('show');
                    $('#tag_id').val(data.result.id);
                    $('#EditName').val(data.result.name);
               }
           })
            });
            $(document).on('click','#EditsaveBtn',function() {
               let tag_form = document.getElementById('edit_tag_form');
               let form_data = new FormData(tag_form);
               $.ajax({
                url:"/dashboard/tags/update",
                method:'post',
                data:form_data,
                dataType:'json',
                success:function (response){
                if (response.status == 504){
                   toastr.error("حدث خطأ ما!");
                }
                else if (response.status == 200) {
    
                 toastr.success(response.success);
                var oTable = $('#tags_datatable').dataTable();
                    oTable.fnDraw(false);
                    $('#edit_tag_Modal').modal('hide');
    
                } },
                contentType: false,
                cache: false,
                processData: false,
                })
              })
    });
</script>

{{-- 
<script>
    var deleteID;
    var category_name;
    var SITEURL = '{{URL::to('')}}';
    $('body').on('click', '#getDeleteId', function(){
    deleteID = $(this).data('id');
    tag_name = $(this).data('name');
    Swal.fire({
    title: 'هل أنت متأكد ؟',
    text: "هل أنت متأكد من حذف الوسم " + tag_name,
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
    url: SITEURL + "/dashboard/tags/delete/" + deleteID,
    success: function (response) {
    if (response.status == 200) {
        toastr.success(response.success);
    }
    var oTable = $('#tags_datatable').dataTable();
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
</script> --}}
@endpush