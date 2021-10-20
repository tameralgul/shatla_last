@extends('front_layout.layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-5 product-left mb-5 mb-lg-0">
            <div class="swiper-container product-slider mb-3">
                <div class="swiper-wrapper">
                    <a href="{{ asset('images/products/cover_images/' . $product->cover_image) }}"
                        data-fancybox="images" data-caption="{{$product->name}}" class="swiper-slide">
                        <img src="{{ asset('images/products/cover_images/' . $product->cover_image) }}" alt="..."
                            class="img-fluid">
                    </a>
                    @foreach ($product->media as $item)

                    <a href="{{ asset('images/products/' . $item->image_name) }}" data-fancybox="images"
                        data-caption="{{$product->name}}" class="swiper-slide">
                        <img src="{{ asset('images/products/' . $item->image_name) }}" alt="..." class="img-fluid">
                    </a>

                    @endforeach

                </div>

            </div>

            <div class="swiper-container product-thumbs" style="height: 80px!important;">
                <div class="swiper-wrapper">
                    <div class="swiper-slide zoomArea">
                        <img id="NZoomImg" src="{{ asset('images/products/cover_images/' . $product->cover_image) }}"
                            alt="..." class="img-fluid">
                    </div>
                    @foreach ($product->media as $item)

                    <div class="swiper-slide">
                        <img src="{{ asset('images/products/' . $item->image_name) }}" alt="..." class="img-fluid">
                    </div>

                    @endforeach

                </div>
            </div>

        </div>

        <div class="col-sm-5 box-detail">
            <div class="row name-product">
                <div class="col-md-12 text-right">{{ $product->title }}</div>
            </div>

            <div class="help-title"></div>
            <div class="container">
                <div class="row ">
                    <div class="price w-25 text-right"> رمز المنتج:</div>
                    <div class="price-content w-75 text-right">{{ $product->product_code }}</div>
                </div>
                <div class="row ">
                    <div class="price w-25 text-right"> السعر:</div>
                    <div class="price-content font-weight-bold w-75 text-right"> {{ $product->price }} رس</div>
                </div>
                <div class="row">
                    <div class="price  w-25 text-right"> الخصم:</div>
                    <div class="price-content w-75 text-right">
                        @if (isset($product->discount->value))
                        {{ $product->discount->value }} %
                        @else
                        لا يوجد
                        @endif
                    </div>
                </div>
                <div class="row ">
                    <div class="price w-25 text-right"> الإجمالي:</div>
                    <div class="price-content font-weight-bold w-75 text-right">
                        @if (isset($product->discount->value))
                        {{ $product->price - $product->discount->value }}
                        @else
                        لا يوجد
                        @endif
                        رس
                    </div>
                </div>
            </div>

            <hr class="row line-hr">
            {{-- <div class="row city"><div  class="deliver-to col-md-6 col-6">Deliver to: <span class="city-name"> Gaza</span> </div>&ensp; <div class="ml-auto change-area">change area</div></div> --}}

            <div class="row form-submit">
                <form class="col-md-12 row" id="cart-form">

                    <div class="d-flex flex-column col-sm-4 col-5 mobile-padding">
                        <div class="quant text-center" style="margin-right: -2em">الكمية</div>
                        <div style="padding-right: 0px!important;padding-left: 0px!important;"
                            class=" col-12 col-sm-12 row d-flex flex-row mobile-padding">


                            <span class="input-number-increment col-4 col-sm-2">+</span>

                            <input class="input-number col-4 col-sm-5" id="quantity" type="text" value="1" min="0"
                                max="{{$product->available_in_stock}}">
                            <span class="input-number-decrement col-4 col-sm-2">–</span>
                        </div>
                    </div>
                    <div class="col-sm-7 col-6 mobile-padding">
                        <button class=" btn btn-checkout w-100 mt-4 cartbtn" id="btnsave" data-id="{{ $product->id }}">
                            @csrf
                            {{-- <input type="hidden" name="id" value="{{$rand1->id}}"> --}}

                            <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}">
                            {{-- <input type="hidden" name="user_id" value="1"> --}}
                            <a class="button cartbtn"><i class="fa fa-shopping-cart"></i>
                                اضافة للسلة</a>
                        </button>
                    </div>
                </form>
            </div>
            <hr>
            <div class="product_meta text-right">
                <span class="posted_in d-flex flex-row">
                    <span>
                        البائع :
                    </span>
                    <div class="hashtag">
                        <a href="#" class="font-weight-bold">
                            {{ " ".$product->vendor->name." " }}
                        </a>
                    </div>

                </span>
            </div>
            <div class="product_meta text-right mt-2">
                <span class="posted_in">التصنيف: {{ $product->category->name }}</span>
            </div>
            <div class="container mt-2" style="padding-right: 0px!important;">
                <div class="row ">
                    <div class="col-12 d-flex flex-column text-right">
                        <div class="primary-font">
                            <p class="primary-font text-color-black "> وسوم المنتج</p>

                        </div>
                        <div class="hashtag">
                            @foreach ($product->tags as $item)
                            <a href="{{ route('product.tag',$item->id) }}">{{$item->name}}</a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <hr class="row line-hr mt-4">
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 shatla-options">
                خصائص الشتلة
            </div>
            @if($options->isEmpty())
            <div class="col-sm-12 col-12 mt-4 text-right">
                لا يوجد خصائص
            </div>
            @else
            @foreach ($options as $item)
            <div class="col-sm-12 col-12 row mt-4">
                <div class="col-sm-1 col-3 text-center">
                    <img width="60px" height="60px" src="{{asset('images/icons/'.$item->icon)}}">
                </div>
                <p class="col-sm-10 col-9 text-right mt-1 option-value">{{$item->name}}</p>

            </div>

            @endforeach
            @endif
        </div>
        <div class="row mt-5">
            <div class="col-sm-12 text-right product-descritpion"> وصف المنتج:</div>
        </div>
        <div class="row  mt-3">
            <p class="col-md-12 text-right description-content">{{ $product->description }}</p>
        </div>
    </div>

    {{-- @if($errors->any())
    <div class="alert alert-danger" style="text-align: left">
        <ul>
            @foreach($errors->all() as $error)
            <li style="">{{ $error }} </li>
            @endforeach
        </ul>
    </div>
    @endif --}}

    <div class="row" id="comments">
        <div class="col-md-12">
            <div class="card text-left">
                <div class="card-header card-header-rose" style="background-color: #f1cb4e">
                    @php $comments = $product->comments @endphp
                    <i class="fa fa-comments"></i>
                    <h5 style="float: right;">التعليقات ({{count($comments)}})</h5>
                </div>
                <div class="card-body">
                    @foreach($comments as $comment)
                    <div class="row" style="float: left;">
                        {{-- <div class="col-sm-5"> --}}
                        {{-- <i class="nc-icon nc-chat-33"></i> --}}
                        @if(!empty(auth()->user()->id) && auth()->user()->id == $comment->user->id)
                        <a href="{{ route('front-profile',['id' => auth()->user()->id]) }}" class="d-flex ">
                            <h6 id="user-comment">{{ $comment->user->name }}</h6>
                        </a>
                        @else
                        <h6 style="text-decoration: underline">
                            {{ $comment->user->name }}
                        </h6>
                        @endif

                        {{-- </div> --}}
                        <div class="col-md-4 text-right">
                            {{-- <span> <i class="nc-icon nc-calendar-60"></i> --}}
                            {{-- {{ $comment->date()}}</span> --}}

                        </div>
                    </div>
                    <li class="pl-2" style="float: right">{{$comment->comment}} </li>
                    @if(auth()->user())
                    @if(auth()->user()->id == $comment->user->id)
                    <a class="pb-2" id="editbtn" href="" onclick="$(this).next('div').slideToggle(0.5000);return false;"
                        style="float: right">تعديل</a>
                    @endif
                    <div style="display: none; margin-top: 50px!important" class="pt-2">
                        <form action="{{ route('comment.update',['id' => $comment->id]) }}" method="post">
                            @csrf
                            {{csrf_field()}}
                            <div class="form-group">
                                <textarea name="comment" rows="4" class="form-control ">{{$comment->comment}}</textarea>
                                <span
                                    class="text-danger">{{ $errors->has('comment') ? $errors->first('comment') : ''}}</span>
                            </div>
                            <button type="submit" class="btn btn-primary">تعديل التعليق</button>
                        </form>
                    </div>
                    @endif

                    @if(!$loop->last)
                    <br><br>
                    <hr>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div><br>
    @if(auth()->user())
    <form action="{{ route('commentStore',['id' =>$product->id ]) }}" method="post">
        @csrf
        {{csrf_field()}}
        <div class="form-group text-right">
            <label for="comment">اضافة تعليق</label>
            <textarea name="comment" rows="4" class="form-control @error('comment') is-invalid @enderror" id="comment-text"></textarea>
            <span class="text-danger comment-error">{{ $errors->has('comment') ? $errors->first('comment') : ''}}</span>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary add-comment"
                style="text-align: center !important">تعليق</button>
        </div>
    </form>
    @else
    <div class="alert alert-warning text-center">
        <h5>سجل دخولك لكي تتمكن من التعليق</h5>
    </div>
    @endif

</div>


@endsection
@push('css')
<link rel="stylesheet" href="{{asset('assets/css/jquery.fancybox.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/product.css')}}">
<style>
    .error {
        border: solid 1px red !important;
    }

    .swiper-container {
        height: 405px !important;
        text-align: center !important;
    }

    .product-thumbs .swiper-slide img {
        border: 2px solid transparent;
        object-fit: cover;
        cursor: pointer;
    }

    .product-thumbs .swiper-slide-active img {
        border-color: #FFD600;
    }

    .product-slider .swiper-button-next:after,
    .product-slider .swiper-button-prev:after {
        font-size: 20px;
        color: #000;
        font-weight: bold;
    }

    .input-number-increment {
        border-left: none;
        border-radius: 0 4px 4px 0;
    }

    .input-number {
        width: 80px;
        padding: 0 12px;
        vertical-align: top;
        text-align: center;
        outline: none;
    }

    .input-number,
    .input-number-decrement,
    .input-number-increment {
        border: 1px solid #ccc;
        height: 40px;
        user-select: none;
    }

    .input-number-decrement,
    .input-number-increment {
        display: inline-block;
        width: 30px;
        line-height: 38px;
        background: #f1f1f1;
        color: #444;
        text-align: center;
        font-weight: bold;
        cursor: pointer;
    }


    .input-number-decrement {}

    .input-number-increment {}

    @media (max-width: 767px) {
        .mobile-padding {
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
    }

    #editbtn {
        background-color: #f1cb4e;
        border-radius: 3px;
        border: 50px;
        width: 50px;
        height: 27px;
        margin-bottom: 10px;
        padding-left: 3px;
        color: white !important
    }
</style>
@endpush

@section('js')
<script src="{{asset('assets/js/jquery.fancybox.min.js')}}"></script>

<script>
    $(document).ready(function(){
        (function() {

            window.inputNumber = function(el) {

                var min = el.attr('min') || false;
                var max = el.attr('max') || false;

                var els = {};

                els.dec = el.next();
                els.inc = el.prev();

                el.each(function() {
                    init($(this));
                });

                function init(el) {

                    els.dec.on('click', decrement);
                    els.inc.on('click', increment);

                    function decrement() {
                        var value = el[0].value;
                        value--;
                        if(!min || value >= min) {
                            el[0].value = value;
                        }
                    }

                    function increment() {
                        var value = el[0].value;
                        value++;
                        if(!max || value <= max) {
                            el[0].value = value++;
                        }
                    }
                }
            }
        })();

        inputNumber($('.input-number'));

            /* product left start */
            if($(".product-left").length){
                var productSlider = new Swiper('.product-slider', {
                    spaceBetween: 0,
                    centeredSlides: false,
                    loop:true,
                    direction: 'horizontal',
                    loopedSlides: 5,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    resizeObserver:true,
                });
                var productThumbs = new Swiper('.product-thumbs', {
                    spaceBetween: 0,
                    centeredSlides: true,
                    loop: true,
                    slideToClickedSlide: true,
                    direction: 'horizontal',
                    slidesPerView: 5,
                    slidesPerGroup: 1,
                    loopedSlides: 5,
                });
                productSlider.controller.control = productThumbs;
                productThumbs.controller.control = productSlider;
                $(".product-slider .swiper-slide").each(function(){
                    let $this = $( this ),
                        image = $this.find( 'img' );
                    $this.zoom({
                        url: image.attr( 'data-large_image' ),
                        touch: false
                    });
                });
            }
            /* 	product left end */
        });
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
        let formData = new FormData($('#cart-form')[0]);
        var qu = $('#quantity').val();
        //var product_qu = $('#product_quantity').val(qu);
        formData.append('quantity',qu)
        var product_id = $(this).data("id");
        $.ajax({
        type: 'POST',
        url: "/add-to-cart/" + product_id,
        data:formData,product_id,
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
                delay: 3000,
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

@endsection