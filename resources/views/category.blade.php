@extends('front_layout.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-right category-name">
              {{$category->name}}
            </div>
            <div class="help-title divider-margin "></div>
            <div class="col-sm-12 row mt-4 col-10">
                 @foreach ($products as $product)
                <div class="bg-white br-16 pb-2 card border-0 poiner col-sm-3  mb-3">

                    <a href="{{ route('show-product',$product->id) }}" class="w-100 a-custom">
                        <img style="max-height: 263px;border-radius:15px"
                             src="{{ URL::asset('/images/products/cover_images/'.$product->cover_image) }}"
                             class="w-100 br-img br-img-custom" alt="" />
                    </a>
                    <div class="space-15"></div>
                    <div style="line-height: 1.3" class="p-2 text-right">
                        <p class="primary-font h-60 text-right">
                            <a href="{{ route('show-product',$product->id) }}"
                               class="color-6">{{$product->title}}</a>
                        </p>
                        <p class="primary-font font-weight-bold  mt-3 text-right">
                            <span>{{ $product->price }} ر.س</span>
                        </p>
                        @if (isset($product->discount->value))
                        <span class="last primary-font line-throught"> {{$product->discount->value}}ر.س</span>
                        @else
                        <span class="last primary-font">لا يوجد خصم</span>
                        @endif
                        <p class="primary-font  mt-3 text-right">
                            <span> {{$product->vendor_name}}</span>
                        </p>
                        <!--    <div class="cardadd">
                                <button class="btn">اضافة للسلة</button>
                            </div> -->
                        {{-- <div
                            class="color-6 primary-font cardadd bg-color-8 rounded py-2 my-2 px-3 d-flex justify-content-around"> --}}

                        {{-- اضافة للسلة --}}
                        <a href="#" id="btnsave" data-id="{{ $product->id }}"
                           class="color-6 primary-font cardadd bg-color-8 rounded py-2 my-2 px-3 d-flex justify-content-around button cartbtn">أضف
                            للسلة
                            <div style="width: 20px; height: 20px">
                                <img src="{{ asset('assets/img/cart.svg') }}" class="w-100 h-100 image-main" alt="">
                                <img src="{{ asset('assets/img/shopping-hover.svg') }}" class="w-100 h-100 image-hover"
                                     alt="">

                            </div>
                        </a>
                        {{-- <div style="width: 20px; height: 20px"> --}}
                        {{-- <img src="assets/img/cart.svg" class="w-100 h-100 image-main" alt="" />
                                <img src="assets/img/shopping-hover.svg" class="w-100 h-100 image-hover"
                                    alt="" /> --}}

                        {{-- </div> --}}
                    </div>
                </div>
               @endforeach
            </div>
        </div>

        <section id="foursection">
            <div class="container">
                <div class="font-weight-bold">
                    <span class="giftstitle">منتجات مشابهة </span>
                </div>
                <div>
                    <div class="swiper-container mySwiper my-5">
                        <div class="swiper-wrapper ">
                            @foreach ($last_product as $last_pro)
                            <div class="swiper-slide ">
                                <div>
                                    <div class="bg-white br-16 pb-2 card border-0 poiner">

                                        <a href="{{route('show-product',$last_pro->id)}}" class="w-100">
                                            <img style="max-height: 263px;!important;border-radius:15px"
                                                src="{{ URL::asset('/images/products/cover_images/'.$last_pro->cover_image) }}"
                                                class="w-100 br-img" alt="" />
                                        </a>
                                        <div class="space-15"></div>
                                        <div style="line-height: 1.3" class="p-2">
                                            <p class="primary-font h-60">
                                                <a href="{{ route('show-product',$last_pro->id) }}"
                                                    class="color-6">{{$last_pro->title}}</a>
                                            </p>
                                            <p class="primary-font font-weight-bold  mt-3">
                                                <span>{{$last_pro->price}} ر.س</span>
                                            </p>
                                            @if (isset($last_pro->discount->value))
                                            <span class="last primary-font line-throught">
                                                {{$last_pro->discount->value}}ر.س</span>
                                            @else
                                            <span class="last primary-font">لا يوجد خصم</span>
                                            @endif
        
                                            <p class="primary-font  mt-3">
                                                <span> {{$last_pro->vendor_name}}</span>
                                            </p>
                                            <!--    <div class="cardadd">
                                                    <button class="btn">اضافة للسلة</button>
                                                </div> -->
                                            {{-- <div class="color-6 primary-font cardadd bg-color-8 rounded py-2 my-2 px-3 d-flex justify-content-around"> --}}
                                            <a href="#" id="btnsave" data-id="{{ $last_pro->id }}"
                                                class="color-6 primary-font cardadd bg-color-8 rounded py-2 my-2 px-3 d-flex justify-content-around button cartbtn">أضف
                                                للسلة
                                                <div style="width: 20px; height: 20px">
                                                    <img src="{{ asset('assets/img/cart.svg') }}" class="w-100 h-100 image-main" alt="">
                                                    <img src="{{ asset('assets/img/shopping-hover.svg') }}" class="w-100 h-100 image-hover"
                                                        alt="">
        
                                                </div>
                                            </a>
        
                                            {{-- <div style="width: 20px; height: 20px">
                                                    <img src="assets/img/cart.svg" class="w-100 h-100 image-main" alt="" />
                                                    <img src="assets/img/shopping-hover.svg" class="w-100 h-100 image-hover"
                                                        alt="" />
        
                                                </div> --}}
                                            {{-- </div> --}}
                                        </div>
                                    </div>
        
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- <div class="text-center mt-n5">
                    <div class="loadmore">
                        <a href="#">شاهد المزيد</a>
                    </div>
                </div> --}}
                <div class="space-30"></div>
        
            </div>
        </section>
    </div>
@endsection
@push('css')
    <style>
        .category-name{
            font-size: 1.5em;
            font-weight: 600;
            margin-right: 1em;
            margin-top: 2em;
        }
        .divider-margin{
            margin-right: 2.5em;
            margin-top: 1em;
            margin-bottom: 1em;
        }
    </style>
@endpush
@push('css')
    <style>
        @media (max-width: 676px) {
            .br-img-custom{
                max-width: 80%!important;
            }
            .a-custom{
                text-align: right!important;
            }
        }

    </style>
@endpush
@section('js')
    <script>
        $(document).ready(function() {
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $(document).on('click','.cartbtn',function(event) {
                event.preventDefault();
            // let formData = new FormData($('#cartForm')[0]);
            var product_id = $(this).data("id");
            $.ajax({
            type: 'POST',
            url: "/add-to-cart/" + product_id,
            data:product_id,
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
            if (response.status == 200) {
                $.ajax({
                    type: 'get',
                    url: "/update_cart" ,
                    data:{},
                    success:function (data){
                        $('#cart_box').html('');
                        $('#cart_box').html(data);
    
                    },
                    processData: false,
                    contentType: false,
                    cache: false,
                })
            toastr.success(response.success);
            }
            // $("#cartForm").trigger('reset');//to clear the form
            },
            });
            });
            });
    
            // toastr.options =
            // {
            // "closeButton" : true,
            // "progressBar" : true,
            // "positionClass": "bottom-right",
            // }
    </script>
@endsection
