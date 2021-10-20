@extends('layouts.app')

@section('bar_title')
المنتجات
@endsection


<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-2">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">لوحة التحكم</h5>
        <!--end::Page Title-->
        <!--begin::Actions-->
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200">
        </div>
        <span class="text-muted font-weight-bold mr-4">المنتجات</span>
        <!--end::Actions-->
    </div>
</div>

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">المنتجات
                        <span class="d-block text-muted pt-2 font-size-sm">عرض جميع &amp; المنتجات</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('products.create') }}" id="btn_show_modal"
                        class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <i class="ki ki-plus icon-sm"></i>
                        </span>منتج جديد </a>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-bordered" id="products_datatable">
                                    <thead>
                                        <tr>
                                            <th width="3%">#</th>
                                            <th width="13%">الإسم</th>
                                            <th width="13%">إسم المزود</th>
                                            <th width="13%">رمز المنتج</th>
                                            <th width="13%">التصنيف</th>

                                            <th width="13%">صورة الغلاف</th>
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

<div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form class="form" id="product_option_form">
                    <div class="card-body">
                        <div class="form-group">
                            <label>الخاصية :</label>
                            <div class="input-icon input-icon-right">
                                <select name="option_id" id="option_id" class="form-control">
                                    <option disabled selected>إختر الخاصية</option>
                                    @foreach ($options as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>النص :</label>
                            <div class="input-icon input-icon-right">
                                <textarea type="text" cols="6" rows="5" id="option" name="option"
                                    class="form-control summernote"></textarea>
                            </div>
                        </div>
                        <input type="hidden" id="product_id" name="product_id">
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
    oTable = $('#products_datatable').DataTable({
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
    url: '/dashboard/products',
    
    },
    columns: [
    
    { data: 'product_id', name: 'product_id' },
    { data: 'title', name: 'title' },
    { data: 'vendor_name', name: 'vendor_name' },
    { data: 'product_code', name: 'product_code' },
    { data: 'category', name: 'category' },
    
    { data: 'cover_image', name: 'cover_image' },
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
    product_name = $(this).data('name');
    Swal.fire({
    title: 'هل أنت متأكد ؟',
    text: "هل أنت متأكد من حذف المنتج " + product_name,
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
    url: SITEURL + "/dashboard/products/delete/" + deleteID,
    success: function (response) {
    if (response.status == 200) {
        toastr.success(response.success);
    }
    var oTable = $('#products_datatable').dataTable();
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
    $(function () {
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $(document).on('click', '.addOption', function (event) {
                var product_id = $(this).data('id');
                // alert(category_id);
                $.ajax({
                url:'/dashboard/products/product_option/' + product_id,
                method:'get',
                success:function(data) {
                $('#editmodelHeading').html("تعديل منتج");
                $('#EditsaveBtn').val("edit-tag");
                $('#optionModal').modal('show');
                $('#product_id').val(data.result.id);
                   
                  }
                })
            });
                $(document).on('click','#EditsaveBtn',function() {
                   let pro_option_form = document.getElementById('product_option_form');
                   let form_data = new FormData(pro_option_form);
                   $.ajax({
                    url:"/dashboard/products/update-product-option",
                    method:'post',
                    data:form_data,
                    dataType:'json',
                    success:function (response){
                    if (response.status == 504){
                       toastr.error("حدث خطأ ما!");
                    }
                    else if (response.status == 200) {
                     toastr.success(response.success);
                        $("#product_option_form").trigger('reset');
                    $('#optionModal').modal('hide');
                    } },
                    contentType: false,
                    cache: false,
                    processData: false,
                    })
                  })
        });
</script>


@endpush