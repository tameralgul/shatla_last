@extends('layouts.app')

@section('bar_title')
تعديل منتج
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
        <span class="text-muted font-weight-bold mr-4">تعديل منتج</span>
        <!--end::Actions-->
    </div>
</div>

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
        <span class="text-muted font-weight-bold mr-4">تعديل منتج</span>
        <!--end::Actions-->
    </div>
</div>


@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">تعديل منتج
                        <span class="d-block text-muted pt-2 font-size-sm">عرض جميع &amp; تعديل منتج</span>
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <form class="form" id="product_form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>اسم المنتج :</label>
                                    <div class="input-icon input-icon-right">
                                        <input name="title" value="{{ $products->title }}" type="text" id="title"
                                            class="form-control" placeholder="" />
                                        <small id="title_error" class="form-text text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="product_id" id="product_id" value="{{ $products->id }}">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>رمز المنتج :</label>
                                    <div class="input-icon input-icon-right">
                                        <input name="product_code" value="{{ $products->product_code }}" type="text"
                                            id="product_code" class="form-control" placeholder="" />
                                        <small id="product_code_error" class="form-text text-danger"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>المزود :</label>
                                    <div class="input-icon input-icon-right ">
                                        <select name="vendor_id" id="vendor_id" class="form-control">
                                            <option disabled selected>التصنيف:</option>
                                            @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}"
                                                {{isset($products) && $products->vendor_id == $vendor->id ? 'selected' : ''}}>
                                                {{$vendor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>سعر المنتج :</label>
                                    <div class="input-icon input-icon-right">
                                        <input name="price" type="text" value="{{ $products->price }}" id="price"
                                            class="form-control" placeholder="" />
                                        <small id="price_error" class="form-text text-danger"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>المتبقي في المخزن :</label>
                                    <div class="input-icon input-icon-right">
                                        <input name="available_in_stock" value="{{ $products->available_in_stock }}"
                                            type="text" id="available_in_stock" class="form-control" placeholder="" />
                                        <small id="available_in_stock_error" class="form-text text-danger"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>المدينة :</label>
                                    <div class="input-icon input-icon-right ">
                                        <select name="city_id" id="city_id" class="form-control">
                                            <option disabled selected>المدينة:</option>
                                            @foreach($cities as $city)
                                            <option value="{{$city->id}}"
                                                {{isset($products) && $products->city_id == $city->id ? 'selected' : ''}}>
                                                {{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>وصف المنتج :</label>
                                <div class="input-icon input-icon-right">
                                    <textarea cols="10" rows="5" name="description" type="text" id="description"
                                        class="form-control">{{ $products->description }}</textarea>
                                    <small id="description_error" class="form-text text-danger"></small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>غلاف المنتج :</label>
                                <div class="input-icon input-icon-right">
                                    <input name="cover_image" type="file" id="cover_image" class="form-control"
                                        placeholder="" />
                                    <small id="cover_image_error" class="form-text text-danger"></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label col-lg-3 col-sm-12">التصنيف</label>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                {{-- <div class="dropdown bootstrap-select form-control dropup"> --}}
                                <select name="category_id" id="category_id" class="form-control">
                                    <option disabled selected>التصنيف:</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                        {{isset($products) && $products->category_id == $category->id ? 'selected' : ''}}>
                                        {{$category->name}}</option>
                                    @endforeach
                                </select>
                                {{-- <small id="category_id_error" class="form-text text-danger"></small> --}}
                            </div>
                            {{-- </div> --}}
                            <label class="col-form-label col-lg-3 col-sm-12">الخصم</label>
                            <div class="col-lg-4 col-md-9 col-sm-12">
                                {{-- <div class="dropdown bootstrap-select form-control dropup"> --}}
                                <select name="product_discount_id" id="product_discount_id" class="form-control">
                                    <option disabled selected>الخصم:</option>
                                    @foreach($discounts as $discount)
                                    <option value="{{$discount->id}}"
                                        {{isset($products) && $products->product_discount_id == $discount->id ? 'selected' : ''}}>
                                        {{$discount->discount_type()}}</option>
                                    @endforeach

                                </select>
                                <small id="product_discount_id_error" class="form-text text-danger"></small>
                                {{-- </div> --}}
                            </div>
                            <div class="form-group" data-select2-id="306">
                                <div class="col-lg-4 col-md-9 col-sm-12">
                                    <label class="col-form-label col-lg-3 col-sm-12">الوسوم:</label>
                                    <select class="tags form-control" id="tags" name="tags[]" multiple="multiple">
                                        @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" @foreach($products->tags as $tagproduct)

                                            @if($tagproduct->id == $tag->id)
                                            selected
                                            @endif
                                            @endforeach>{{ $tag->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <small id="tags_error" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-12">
                                    <label for="images">صور المنتج</label>
                                    <div class="file-loading">
                                        <input type="file" name="images[]" class="file-input-overview" multiple
                                            id="product-images">
                                        <small id="images_error" class="form-text text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-toolbar" style="text-align: left">
                                <a id="saveBtn" class="btn btn-success mr-2">حفظ البيانات</a>
                                <button type="reset" class="btn btn-secondary">إلغاء</button>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.tags').select2();
        });

</script>

<script>
    $(function () {

         $('#product-images').fileinput({
        theme: "fas",
        maxFileCount: {{ 5 -$products->media->count() }} ,
        allowedFileTypes: ['image'],
        showCancel: true,
        showRemove: false,
        showUpload: false,
        overwriteInitial: false,
        initialPreview: [
        @if($products->media->count() > 0)
        @foreach($products->media as $media)
        "{{ asset('images/products/' . $media->image_name) }}",
        @endforeach
        @endif
        ],
        initialPreviewAsData: true,
        initialPreviewFileType: 'image',
        initialPreviewConfig: [
        @if($products->media->count() > 0)
        @foreach($products->media as $media)
        {caption: "{{ $media->image_name }}",
        size: {{ $media->image_size }},
        width: "120px",
        url: "{{ route('products.media.destroy', [$media->id, '_token' => csrf_token()]) }}", key: "{{ $media->id }}"},
        @endforeach
        @endif
        ],
        
        });
        });
</script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    
        $(document).on('click','#saveBtn',function() {

    
            let formData = new FormData($('#product_form')[0]);
            
            $.ajax({
            type: 'POST',
            url: "{{route('products.update')}}",
            data:formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
    
               success: function (response) {
                if (response.status == 200) {
                   toastr.success(response.success);
                }
            // $("#product_form").trigger('reset');//to clear the form
            // $('#tags').val(null).trigger('change');
            // $('#product_discount_id').val(null).trigger('change');
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

@endpush