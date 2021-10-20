@extends('layouts.app')
@section('bar_title')
البروفايل | {{ $adminProfile->name }}
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
        <span class="text-muted font-weight-bold mr-4">الحساب الشخصي</span>
        <!--end::Actions-->
    </div>
</div>

@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="flex-row-fluid ml-lg-8">
            <!--begin::Card-->
            <div class="card card-custom card-stretch">
                <!--begin::Header-->
                <div class="card-header py-3">
                    <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark"> المعلومات الشخصية |
                            {{ $adminProfile->name }}</h3>
                        <span class="text-muted font-weight-bold font-size-sm mt-1">تعديل المعلومات الشخصية</span>
                    </div>

                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form class="form" id="profile_form">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row">
                            <label class="col-xl-3"></label>
                            <div class="col-lg-9 col-xl-6">
                                <h5 class="font-weight-bold mb-6">معلومات المالك</h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">الصورة</label>
                            <div class="form-group">
                                {{-- <label for="exampleFormControlFile1">أختيار</label> --}}
                                <input type="file" name="image" class="form-control-file" id="file-image">
                                <img id="image_porfile" src="{{asset('images/admin/'. $adminProfile->image) }}"
                                    style="width:150px; border-radius: 10px;" class="file-image mt-2">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">الإسم</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control form-control-lg form-control-solid" id="name"
                                    placeholder="الإسم" type="text" name="name" value="{{ $adminProfile->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">البريد الإلكتروني</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group input-group-lg input-group-solid">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="la la-at"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="email" id="email"
                                        class="form-control form-control-lg form-control-solid"
                                        value="{{ $adminProfile->email }}" placeholder="البريد">
                                </div>
                                <input type="hidden" name="admin_id" id="admin_id" value="{{ $adminProfile->id }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">كلمة المرور</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group input-group-lg input-group-solid">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="كلمة المرور">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">تأكيد كلمة المرور</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group input-group-lg input-group-solid">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        </span>
                                    </div>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="تأكيد كلمة المرور">
                                </div>
                            </div>
                        </div>

                       
                        <div class="card-toolbar" style="text-align: left">
                            <a id="EditsaveBtn" class="btn btn-success mr-2">حفظ البيانات</a>
                            <button type="reset" class="btn btn-secondary">إلغاء</button>
                        </div>
                    </div>
                    <!--end::Body-->
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
            $(document).on('click','#EditsaveBtn',function() {
               let user_form = document.getElementById('profile_form');
               let form_data = new FormData(user_form);
               $.ajax({
                url:"/dashboard/admin/update-profile",
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
               $('#image_porfile').attr('src',"/images/admin/"+response.data.image)
               $("#file-image").val("")
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