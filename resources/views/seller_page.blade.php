
@extends('front_layout.layout')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-sm-6 row text-right">
            <a class="col-sm-4 col-12 info-seller mobile-seller font-weight-bold">
               <span class="border-seller">
                معلومات التواصل
                <span class="far fa-address-card"></span>
               </span>
            </a>
            <a class="col-sm-4 col-12 seller-products mobile-seller font-weight-bold">
               <span class="border-seller">
                منتجات البائع
             <span class="fa fa-shopping-cart"></span>

               </span>
            </a>
            <a class="col-sm-3 col-12 mobile-seller font-weight-bold">
               <span class="border-seller">
                التقييم
                <span class="far fa-star"></span>
               </span>
            </a>
        </div>
    </div>
    <div class="row content-load col-sm-12 mt-4">
        @include('seller.info')
    </div>
</div>
@endsection
@push('css')
    <style>
        .border-seller{
            border-bottom: 2px solid #FFCA28;
            font-size: 1.1em;
        }
        .mobile-seller{
            color: #FFCA28;
        }
        @media (max-width: 767px) {

            .mobile-seller{
                margin-top: 1em;
            }
        }
    </style>
@endpush
@section('js')
    <script>
        $(document).on('click','.seller-products',function (){
            $.ajax({
                url:"/seller_products/"+'{{$id}}',
                'method':'get',
                data:{},
                success:function (res){
                    $('.content-load').html("")
                    $('.content-load').html(res);
                }
            })
        })
        $(document).on('click','.info-seller',function (){
            $.ajax({
                url:"/seller/info/"+'{{$id}}',
                'method':'get',
                data:{},
                success:function (res){
                    $('.content-load').html("")
                    $('.content-load').html(res);
                }
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click','.btnsave',function(event) {
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

            $(document).on('click','.btnsave_modal',function(event) {
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


    </script>
@endsection