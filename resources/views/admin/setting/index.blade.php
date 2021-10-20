@extends('layouts.app')
@section('bar_title')
الإعدادات العامة
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
        <span class="text-muted font-weight-bold mr-4">الإعدادت</span>
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
                    <h3 class="card-label">الإعدادات
                        <span class="d-block text-muted pt-2 font-size-sm">عرض جميع &amp; الإعدادات</span>
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-body table-responsive p-0">
                                <table class="table  table-condensed table-hover text-nowrap table-bordered"
                                    id="settings_datatable">
                                    <thead>
                                        <tr>
                                            
                                            <th width="3%">#</th>
                                            <th width="13%">العنوان</th>
                                            <th width="14%">رقم التواصل</th>
                                            <th width="13%">اللوجو</th>
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
            oTable = $('#settings_datatable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                serverSide: true,
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
                }},
                 "order": [[ 0, "asc" ]],
                    ajax: {
                    type: "GET",
                    contentType: "application/json",
                    url: '/dashboard/settings',
                    },
                    columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title'},
                    { data: 'contact_number', name: 'contact_number'},
                    { data: 'logo', name: 'logo' },
                    { data: 'Date', name: 'Date' },
                    {data: 'actions', name: 'actions',orderable:false,serachable:false,sClass:'text-center'},
                    ],
                    fnDrawCallback: function () {
                    }
           });
        }

</script>

@endpush
