@extends('layouts.app')

@section('bar_title')
    تعديل الاعدادات
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">الإعدادات
                            <span class="d-block text-muted pt-2 font-size-sm">تعديل الإعدادات &amp; الإعدادات</span>
                        </h3>
                    </div>
    
                </div>
                <div class="modal-body pb-2">
                   <form class="form" id="setting_form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>العنوان :</label>
                                        <div class="input-icon input-icon-right">
                                            <input name="title" type="text" id="title" class="form-control" value="{{ $setting->title }}" placeholder="" />
                                        </div>
                              <input name="setting_id" type="hidden" id="setting_id" class="form-control" value="{{ $setting->id }}" placeholder="" />                    
                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>رقم التواصل :</label>
                                        <div class="input-icon input-icon-right">
                                            <input name="contact_number" value="{{ $setting->contact_number }}" type="text" id="contact_number" class="form-control"
                                                placeholder="" />
                                        </div>
                    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الأنستقرام :</label>
                                        <div class="input-icon input-icon-right">
                                            <input name="instagram_url" type="text" value="{{ $setting->instagram_url }}" id="instagram_url" class="form-control"
                                                placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>التويتر :</label>
                                        <div class="input-icon input-icon-right">
                                            <input name="twitter_url" type="text" value="{{ $setting->twitter_url }}" id="twitter_url" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الفيسبوك :</label>
                                        <div class="input-icon input-icon-right">
                                            <input name="facebook_url" type="text" value="{{ $setting->facebook_url }}" id="facebook_url" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleFormControlFile1">اللوجو</label>
                                <div id="thumb-output"></div><br>
                                <input type="file" name="logo" class="form-control-file" id="file-image">
                                <img id="logo" src="{{ asset('images/logo/' . $setting->logo) }}" width="130px" style="border-radius: 30px" >
                            </div>
                    
                        </div>
                    <div class="card-toolbar" style="text-align: left">
                        <a id="saveBtn" class="btn btn-success mr-2">حفظ البيانات</a>
                        <button type="reset" class="btn btn-secondary">إلغاء</button>
                    </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
    
        </div>
    </div>
@endsection

@push('js')
    
<script>
    $(function () {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
         var SITEURL = '{{URL::to('')}}';
        $(document).on('click','#saveBtn',function() {
           let setting_form = document.getElementById('setting_form');
           let form_data = new FormData(setting_form);
           $.ajax({
            url:"/dashboard/settings/update",
            method:'post',
            data:form_data,
            dataType:'json',
            success:function (response){
            if (response.status == 504){
            Swal.fire({
            icon: 'error',
            title: 'خطأ',
            text: response.error,
            confirmButtonText:"حسناً"
            })
            }
            else if (response.status == 200) {
            Swal.fire({
            icon: 'success',
            title: 'تم',
            text: response.success,
            timer: 2000,

            showCancelButton: false,
            showConfirmButton: false
            })
            var oTable = $('#settings_datatable').dataTable();
            oTable.fnDraw(false);
            $('#thumb-output').html("");
            $("#logo").html("");
            $('#logo').attr('src',"/images/logo/"+response.data.logo);
            $("#file-image").val("");
            }
            },
            contentType: false,
            cache: false,
            processData: false,
            })
          })
    });
</script>

@endpush