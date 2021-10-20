@extends('front_layout.layout')
@section('content')

        <div>
    @if ($ads->count() > 0)
            <div class="swiper-container-main" style="   width: 100%;height: 550px;overflow-x: hidden">

                <!-- swiper slides -->
                <div class="swiper-wrapper">
                    @if (isset($ads))
                        @foreach ($ads as $ad)

                            <div class="swiper-slide " style="background-image: url({{ asset('images/ads/' . $ad->image) }});   background-size: 100% 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;">
                                <h2  class="text-white" style="margin-top: 20%">{{$ad->title}}</h2>
                            </div>
                        @endforeach
                    @endif


                </div>
                <!-- !swiper slides -->

                <!-- next / prev arrows -->
            </div>

    @endif
</div>
<!--     <div>
        <div class="container">
            <div class="grid-container">
                <div class="mx-auto">
                    <div class="product-category">
                        <div style="width: 60px; height: 60px" class="mx-auto">
                            <img src="./assets/img/gift-box.svg"
                                class="w-100 h-100" alt="" />
                        </div>
                        <div class="box-text text-center primary-font">
                            <p>هدايا</p>
                        </div>
                    </div>
                </div>
                <div class="mx-auto">
                    <div class="product-category">
                        <div style="width: 60px; height: 60px" class="mx-auto">
                            <img src="./assets/img/gift-box.svg"
                                class="w-100 h-100" alt="" />
                        </div>
                        <div class="box-text text-center primary-font">
                            <p>النياتات الخارجية</p>
                        </div>
                    </div>
                </div>
                <div class="mx-auto">
                    <div class="product-category">
                        <div style="width: 60px; height: 60px" class="mx-auto">
                            <img src="./assets/img/gift-box.svg"
                                class="w-100 h-100" alt="" />
                        </div>
                        <div class="box-text text-center primary-font">
                            <p>الأدوات والاكسسورات</p>
                        </div>
                    </div>
                </div>
                <div class="mx-auto">
                    <div class="product-category">
                        <div style="width: 60px; height: 60px" class="mx-auto">
                            <img src="./assets/img/gift-box.svg"
                                class="w-100 h-100" alt="" />
                        </div>
                        <div class="box-text text-center primary-font">
                            <p>النباتات الداخلية</p>
                        </div>
                    </div>
                </div>
                <div class="mx-auto">
                    <div class="product-category">
                        <div style="width: 60px; height: 60px" class="mx-auto">
                            <img src="./assets/img/gift-box.svg"
                                class="w-100 h-100" alt="" />
                        </div>
                        <div class="box-text text-center primary-font">
                            <p>تربة وأسمدة</p>
                        </div>
                    </div>
                </div>
                <div class="mx-auto">
                    <div class="product-category">
                        <div style="width: 60px; height: 60px" class="mx-auto">
                            <img src="./assets/img/gift-box.svg"
                                class="w-100 h-100" alt="" />
                        </div>
                        <div class="box-text text-center primary-font">
                            <p>احواض النباتات</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<div class="space-30"></div>
<section>
    <div class="row d-flex flex-row mx-2">
        {{-- @foreach ($random_product as $rand_product)
               
           @endforeach --}}
        <div class="col-12 col-md-3 col-lg-3 my-3 ">
            @if(isset($rand1))
            <div class="part part1">
                <div class="imgpart data-link" data-link="{{ route('show-product',$rand1->id) }}">
                    @if (isset($rand1))
                    <img style="border-radius:15px"
                        src="{{ URL::asset('/images/products/cover_images/'.$rand1->cover_image) }}" alt="part"
                        class="w-100 h-100" />
                    @endif
                </div>
                <div class="">
                    <div class="titlepart d-flex flex-column">
                        <a href="{{ route('show-product',$rand1->id) }}"><span> {{ $rand1->title }}</span></a>
                        <span> {{ $rand1->price ."ر.س " }}</span>
                        <div class="btnaddtocart">
                            {{-- <p class="btn-holder"> --}}
                            <a href="#" id="btnsave" data-id="{{ $rand1->id }}" class="button cartbtn px-4 py-2">

                                أضف للسلة
                                <span class="fas fa-shopping-cart" data-toggle="dropdown"></span>
                            </a>
                            {{-- </p> --}}
                        </div>
                    </div>
                </div>
            </div>
            @endif
                <div class="space-15"></div>
                @if(isset($rand2))
            <div class="part part2">
                <div class="imgpart data-link" data-link="{{ route('show-product',$rand2->id) }}">
                    <img style="border-radius:15px"
                        src="{{ URL::asset('/images/products/cover_images/'.$rand2->cover_image) }}" alt="part"
                        class="w-100 h-100" />
                </div>
                <div class="">
                    <div class="titlepart d-flex flex-column">
                        <a href="{{ route('show-product',$rand2->id) }}"> <span> {{ $rand2->title }}</span></a>
                        <span>{{ $rand2->price }} ر.س</span>
                        <div class="btnaddtocart">
                            <a href="#" id="btnsave" data-id="{{ $rand2->id }}" class="button cartbtn px-4 py-2">

                                أضف للسلة
                                <span class="fas fa-shopping-cart" data-toggle="dropdown"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @if(isset($rand3))
        <div class="col-12 col-md-6 col-lg-6 my-3">
            <div class="part part3">
                <div class="imgpart data-link" data-link="{{ route('show-product',$rand3->id) }}">
                    <img style="border-radius:15px"
                        src="{{ URL::asset('/images/products/cover_images/'.$rand3->cover_image) }}" alt="part"
                        class="w-100 h-100" />
                </div>
                <div class="">
                    <div class="titlepart d-flex flex-column">
                        <a href="{{ route('show-product',$rand3->id) }}"><span> {{ $rand3->title }}</span></a>
                        <span>{{ $rand3->price }} ر.س</span>
                        <div class="btnaddtocart  text-center">

                            <a href="#" id="btnsave" data-id="{{ $rand3->id }}" class="button cartbtn px-4 py-2">
                                أضف للسلة
                                <span class="fas fa-shopping-cart" data-toggle="dropdown"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      @endif
        @if(isset($rand4))
        <div class="col-12 col-md-3 col-lg-3 my-3">
            <div class="part part4">
                <div class="imgpart data-link" data-link="{{ route('show-product',$rand4->id) }}">
                    <img style="border-radius:15px"
                        src="{{ URL::asset('/images/products/cover_images/'.$rand4->cover_image) }}" alt="part"
                        class="w-100 h-100" />
                </div>
                <div class="">
                    <div class="titlepart d-flex flex-column">
                        <a href="{{ route('show-product',$rand4->id) }}"><span> {{ $rand4->title }}</span></a>
                        <span> {{$rand4->price}} ر.س</span>
                        <div class="btnaddtocart">

                            <a href="#" id="btnsave" data-id="{{ $rand4->id }}" class="button cartbtn px-4 py-2">

                                أضف للسلة
                                <span class="fas fa-shopping-cart" data-toggle="dropdown"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<section id="gifts">
    <div class="container">
        <div class="font-weight-bold">
            <span class="giftstitle">اخر العروض</span>
        </div>
        <div>
            <div class="swiper-container mySwiper my-5">
                <div class="swiper-wrapper ">
                    @foreach ($new_product as $new_pro)

                    <div class="swiper-slide ">
                        <div>
                            <div class="bg-white br-16 pb-2 card border-0 poiner">
                                  @if (isset($new_pro->discount->value))
                                <div class="badge">
                                     {{ $new_pro->discount->discount_type() }}

                                  
                                </div>
                                @endif
                                <a href="{{ route('show-product',$new_pro->id) }}" class="w-100">
                                    <img style="height: 263px;border-radius:15px"
                                        src="{{ URL::asset('/images/products/cover_images/'.$new_pro->cover_image) }}"
                                        class="w-100 br-img" alt="" />
                                    <div data-toggle="modal" data-id="{{$new_pro->id}}"  class="speed-show">
                                        عرض سريع
                                    </div>
                                </a>
                                <div class="space-15"></div>
                                <div style="line-height: 1.3" class="p-2">
                                    <p class="primary-font h-60">
                                        <a href="{{ route('show-product',$new_pro->id) }}"
                                            class="color-6">{{$new_pro->title}}</a>
                                    </p>
                                    <p class="primary-font font-weight-bold  mt-3">
                                        <span>{{ $new_pro->price }} ر.س</span>
                                    </p>
                                    @if (isset($new_pro->discount->value))
                                    <span class="last primary-font line-throught"> {{$new_pro->discount->value}}ر.س</span>
                                    @else
                                    <span class="last primary-font" style="visibility: hidden">لا يوجد خصم</span>
                                    @endif
                                    <p class="primary-font  mt-3">
                                        <span> {{$new_pro->vendor_name}}</span>
                                    </p>
                                    <!--    <div class="cardadd">
                                            <button class="btn">اضافة للسلة</button>
                                        </div> -->
                                    {{-- <div
                                        class="color-6 primary-font cardadd bg-color-8 rounded py-2 my-2 px-3 d-flex justify-content-around"> --}}

                                    {{-- اضافة للسلة --}}
                                    <a href="#" id="btnsave" data-id="{{ $new_pro->id }}"
                                        class="color-6 primary-font cardadd bg-color-8 rounded py-2 my-2 px-3 d-flex justify-content-around button cartbtn">أضف
                                        للسلة
                                        <div style="width: 20px; height: 20px">
                                            <img src="assets/img/cart.svg" class="w-100 h-100 image-main" alt="">
                                            <img src="assets/img/shopping-hover.svg" class="w-100 h-100 image-hover"
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
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
        {{-- <div class="text-center">
                <div class="loadmore">
                    <a href="#">شاهد المزيد</a>
                </div>
            </div> --}}
    </div>
</section>
{{-- <section id="threesection">
        <div class="container">
            <div class="row py-4">
                <div class="col-6">
                    <div class="responise-img-size">
                        <img src="https://nabataty.com/store/wp-content/uploads/2021/07/CerPots-800x800.jpg"
                             class="w-100 h-100" alt="">
                    </div>
                </div>
                <div class="col-6 text-right d-flex align-items-center bx-shadow">
                    <div>
                        <div class="primary-font font-weight-bold">
                            <p class="title3 font-weight-bold">احواض سيراميك تجعل مكانك اكثر جمالاً</p>
                        </div>
                        <div class="my-sm-1 my-lg-5 primary-font ">
                            <p class="content3">اطقم واحواض سيراميك للنباتات منوعة الاحجام والاشكال والالوان </p>
                        </div>
                        <div class="">
                            <div class="loadmore ">
                                <a href="#">شاهد المجموعة</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
<section id="foursection">
    <div class="container">
        <div class="font-weight-bold">
            <span class="giftstitle">أخر المنتجات </span>
        </div>
        <div>
            <div class="swiper-container mySwiper my-5">
                <div class="swiper-wrapper ">
                    @foreach ($last_product as $last_pro)
                    <div class="swiper-slide ">
                        <div>
                            <div class="bg-white br-16 pb-2 card border-0 poiner">
                                <div class="badge">
                                    @if (isset($last_pro->discount->value))
                                    {{ $last_pro->discount->discount_type() }}
                                    @else
                                    Hot
                                    @endif
                                </div>
                                <a href="{{ route('show-product',$last_pro->id) }}" class="w-100">
                                    <img style="height: 263px;!important;border-radius:15px"
                                        src="{{ URL::asset('/images/products/cover_images/'.$last_pro->cover_image) }}"
                                        class="w-100 br-img" alt="" />
                                    <div data-toggle="modal" data-id="{{$new_pro->id}}"  class="speed-show">
                                        عرض سريع
                                    </div>
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
                                        <span class="last primary-font line-throught"> {{$last_pro->discount->value}}ر.س</span>
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
                                            <img src="assets/img/cart.svg" class="w-100 h-100 image-main" alt="">
                                            <img src="assets/img/shopping-hover.svg" class="w-100 h-100 image-hover"
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
<section id="fifesection">
    <div class="container">
        <div class="row d-flex flex-row mx-2">
            @foreach ($categories->take(3) as $category)
                @if($category->image == null)
                @continue
                @endif
            <div class="col-12 col-md-4 col-lg-4 my-3">
                <div class="part part1">
                    <div class="imgpart">
                        <img style="border-radius: 15px" src="{{ asset('images/category/'. $category->image) }}"
                            alt="part" class="w-100 h-100" />
                    </div>
                    <div class="">
                        <div class="titlepart py-3">
                            <span>{{$category->name}} </span>
                            <div class="btnshow">
                                <a href="{{ route('product.category',$category->id) }}" class="button"> عرض</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<section id="sixsection">
    <div class="container">
        <div class="w-100 text-center primary-font">
            <p>كن بالجوار</p>
            <p>اضف بريدك الالكتروني للاطلاع على جديدنا من المنتجات والعروض</p>
        </div>
        <div id="custom-search-input" class="rounded-pill">
            <div class="input-group col-md-12 rounded-pill d-flex justify-content-center" style="margin-right: 10%;width: 80%!important;">
                <input type="text" class="form-control input-lg rounded-pill"
                    placeholder="اكتب بريدك الالكتروني هنا " />
                <span class="input-group-btn">
                    <button class="btn btn-info bg-main-color rounded-pill px-sm-3 px-md-4 px-lg-5" type="button">
                        اشتراك
                    </button>
                </span>
            </div>
        </div>
    </div>
</section>
<div class="container">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @yield('content')
</div>
<div class="modal fade" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-custom modal-content-customize  modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-content-customize modal-inside rounded-0">
            <div class="modal-body py-0 row" style="padding: 0px!important;">
                <div class="bg-image promo-img col-12 col-sm-5" style="background-image: url('images/img_1.jpg');">
                </div>
                <div class="content-text p-4 px-5 align-item-stretch col-12 col-sm-6">
                    <div class=" text-right">
                        <a href="#" class="share"><span class="icon-share"></span></a>
                        <h3 class="text-center mb-3 line product-name-modal">Grand Prix 4000</h3>
                        <p class="mb-3">
                            <span class="icon-star text-warning"></span>
                            <span class="icon-star text-warning"></span>
                            <span class="icon-star text-warning"></span>
                            <span class="icon-star text-warning"></span>
                            <span class="icon-star"></span>
                        </p>
                        <div class="price-box">
                             السعر:
                        <span class="price">$2000</span>
                        </div>
                        <div class="mt-3">
                            البائع:
                            <span class="vendor-name"> </span>
                        </div>
                        <p class="mb-5 mt-4 product-modal-descritpion">All their equipment and instruments are alive. The sky was this is cloudless and of a deep dark blue. A shining crescent far beneath the flying vessel.</p>
                       <div class="w-100 text-center">
                           <button class=" btn btn-checkout w-75 mt-4" id="btnsave_modal" data-id="">
                               @csrf
                               {{-- <input type="hidden" name="id" value="{{$rand1->id}}"> --}}
                               <input type="hidden" id="quantity" name="quantity" value="1">
                               <input type="hidden" id="product_id" name="product_id" value="}">
                               {{-- <input type="hidden" name="user_id" value="1"> --}}
                               <a class="button cartbtn" ><i class="fa fa-shopping-cart"></i>
                                   اضافة للسلة</a>
                           </button>
                       </div>

                    </div>


                </div>



            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
    <style>

        .price-box{
            font-size: 1.3em;
        }
        .price{
            font-weight: 600;
        }
        .modal-custom{
            max-width:837px!important
        }
        a {
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease; }
        a, a:hover {
            text-decoration: none !important; }

        .content {
            height: 100vh; }

        .modal {

            overflow: hidden;
            background-color: transparent; }

        .modal-content-customize{
            height: 70% !important;
        }





        .bg-image {
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat; }

        .logo img {
            width: 70px; }

        .line {
            position: relative;
            padding-bottom: 20px; }
        .line:after {
            left: 50%;
            bottom: 0;
            -webkit-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
            position: absolute;
            content: "";
            width: 70px;
            height: 1px;
            background: rgba(241,203,78,1); }

        .custom-note {
            color: #999; }
        .custom-note a {
            color: #555;
            font-weight: 900 !important; }

        .social a {
            font-size: 14px;
            color: #b3b3b3; }
        .social a .heart {
            color: #dc3545; }

        .social .like .icon {
            color: #dc3545; }

        .social .message .icon {
            color: #007bff; }

        .social .add .icon {
            color: #007bff; }

        .share {
            position: absolute;
            right: 20px;
            color: #ccc;
            z-index: 4; }
        .share:hover {
            color: #000; }
        .modal-inside{
            height: 73% !important;
        }
        .titlepart a{

            color: #212529 !important;
            opacity: 0.8;
        }
        .titlepart span{
            font-weight: 300!important;
            color: #212529 !important;

            margin-bottom: 0.3em;

        }
        @media (max-width: 767px) {
            .bg-image{
                background-size: 93% 100%;
                padding-top:16em!important;

            }
            #btnsave_modal{
                margin-top: 0px!important;
            }
            .modal-inside{
                height: 80%!important;
            }
            .swiper-container-main{
                height: 400px!important;
            }
        }
        .btnaddtocart a.button{
            background-color: rgba(241,203,78,0.4);
        }
    </style>
@endpush

@section('js')

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script> --}}

<script>
    $('.dropdown-content').hide()
    $('.dropdown ').click(function (event){

        $(this).find('.dropdown-content').toggle()
    })
</script>

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

        $(document).on('click','#btnsave_modal',function(event) {
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

        var Swipes = new Swiper('.swiper-container-main', {
            loop: true,
            autoplay: {
                enabled: true,
                delay: 4000,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
            },
        });
        });


    $(document).on('mouseover','.swiper-slide',function (){
        $(this).find('.speed-show').attr('style','display: block !important');
    })
    $(document).on('mouseout','.swiper-slide',function (){
        $(this).find('.speed-show').attr('style','display: none !important');
    })
    $(document).on('click','.speed-show',function (event){
        event.preventDefault()
       var id=  $(this).attr('data-id')
        $.ajax({
            url:'/show-modal-product/'+id,
            method:'get',
            data:{},
            success:function (data){
            $('.bg-image').attr('style','background-image:url('+"'"+"/images/products/cover_images/"+data.data.cover_image+"'"+");padding-top:0.5em;font-size:1.2em;");
            $('.product-name-modal').html(data.data.title)
            $('.product-modal-descritpion').html(data.data.description)
                $('#product_id').val(data.data.id)
            $('#btnsave_modal').attr('data-id',data.data.id)
                $('.price').html(data.data.price+" رس ")
                $('.vendor-name').html(data.data.vendor_name)
                $('#product_modal').modal('show')
            }
        })
    })


</script>
<script>
    $(document).ready(function (){
        @if(session()->has("message"))
        $('#exampleModalCenter').modal('show')
        toastr.info("تم تغيير كلمة السر بنجاح");
        @endif
    })


</script>
<script>
    $(document).on('click','.data-link',function (){
       let link=  $(this).attr('data-link')
        window.location.href =link;
    })
</script>
@endsection()