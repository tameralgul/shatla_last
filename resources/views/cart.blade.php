@extends('front_layout.layout')
@section('content')

    <div id="pageRoot"></div>


<div class="row">
    <div class="col-sm-8 content-box ">
        <div class="row my-cart-box">
            <div class="col-sm-11 col-12 text-right"> <span class="my-cart">مجموع السلة الخاصة بي </span><span
                    class="num-items"> ({{ " ".count((array) session('cart')) ." "}})</span></div>
            <div class="col-sm-11 col-12">
                <div class="row box-product">
                    <table id="cart" class="table table-hover table-condensed table-responsive">
                        <thead>
                            <tr>
                                <th> صورة المنتج</th>
                                <th style="width:20%" class="text-center">المنتج</th>
                                <th style="width:15%">سعر المنتج</th>
                                <th style="width:15%;text-align: center;">الكمية</th>
                                <th style="width:15%;text-align: center;">الخصم</th>
                                <th style="width:22%" class="text-center">المجموع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @php $discount = 0 @endphp
                            @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['available_in_stock'] @endphp
                            <tr data-id="{{ $id }}">
                                <td>
                                    <img
                                            src="{{ asset('images/products/cover_images/'.$details['cover_image'])  }}"
                                            width="100" height="100" class="img-responsive" />
                                </td>
                                <td class="text-center" data-th="Product">
                                            <h4 class="nomargin">{{ $details['title'] }}</h4>
                                </td>
                                <td data-th="Price">{{ $details['price'] }}{{" "."رس"}}</td>
                                <td data-th="available_in_stock" class="d-flex justify-content-center">
                                    <input type="number" style="width: 50px"
                                        value="{{ $details['available_in_stock'] }}"
                                        class="form-control available_in_stock update-cart" />
                                </td>
                                <td data-th="Subtotal" class="text-center">
                                 <?php
                                   $num =  ( ($details['product_discount_id'] * $details['price'])/100);
                                   $result = $num * $details['available_in_stock'];
                                    $discount +=$result;
                                    ?>

                                    {{$result." ". "رس"}}
                                </td>
                                <td data-th="Subtotal" class="text-center">
                                    {{ $details['price'] * $details['available_in_stock'] }}{{" "."رس"}}
                                    <div class="text-danger remove-from-cart text-center"><i
                                                class="fas fa-trash-alt"></i></div>
                                </td>

                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-right pr-3">
                                    <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                                        متابعة التسوق</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="row order-box">
            <div class="col-sm-12">
                <div class="row ">
                    <div class="col-sm-12 order-word text-right">
                        ملخص الطلب
                    </div>
                </div>

            </div>
            <div class="col-sm-12">
                <div class="row total-box">
                    <div class="col-sm-6 col-6 total text-right">
                        مجموع الطلب
                    </div>
                    <div class="col-sm-6 col-6 text-right">
                        @php $total = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['available_in_stock'] @endphp
                        @endforeach
                        {{ $total ."" }}  
                            </span>
                        <span class="nis-result">  رس</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row shipping-box">
                    <div class="col-sm-6 col-6 shipping text-right">
                        الخصم </div>
                    <div class="col-sm-6 col-6 text-right">
                        <span class="price-result">
                                {{$discount}}
                           </span>
                        <span class="nis-result"> رس</span>
                    </div>
                </div>
            </div>

            <hr class="col-sm-10 line-hr" style="margin-bottom: 1em">
            <div class="col-sm-12">
                <div class="row mb-3">
                    <div class="col-sm-6 col-6 shipping text-right">
                        المجموع الكلي </div>
                    <div class="col-sm-6 col-6 text-right">
                        <span class="price-result">{{  $total-$discount  }}</span>
                        <span class="nis-result"> رس</span>
                    </div>
                </div>
            </div>
			<button id="openLightBox" class="col-sm-12 btn btn-checkout mb-3 font-weight-bold " onclick="goSell.openLightBox()">
                تأكيد الطلب	
            </button>

        </div>

    </div>
</div>

    <div id="pageRoot"></div>

@endsection
@push('css')
    <link href="{{asset('assets/css/sweetalert.css')}}" rel="stylesheet" >
    <style>
       .swal2-confirm{
           background-color:#FFD600!important; ;
       }


       .swal2-cancel{
           background-color: #EF5350!important;
       }
       .swal2-title{
           font-size: 1.2em;
       }
       .swal2-popup{
           width: 30em!important;
       }
       body,html{
           overflow-x: hidden;
       }
    </style>
@endpush
@section('js')
    <script src="{{asset('assets/js/sweetalert.js')}}"></script>

    <script type="text/javascript">
	goSell.config({
  containerID: "pageRoot",
  gateway: {
    publicKey: "pk_test_dROwugnX02QMLCBaSt7zY85y",
    merchantId: null,
    language: "en",
    contactInfo: true,
    supportedCurrencies: "all",
    supportedPaymentMethods: "all",
    saveCardOption: false,
    customerCards: true,
    notifications: "standard",
    callback: (response) => {
      console.log("response", response);
    },
    onClose: () => {
      console.log("onClose Event");
    },
    backgroundImg: {
      url: "imgURL",
      opacity: "0.5",
    },
    labels: {
      cardNumber: "Card Number",
      expirationDate: "MM/YY",
      cvv: "CVV",
      cardHolder: "Name on Card",
      actionButton: "Pay",
    },
    style: {
      base: {
        color: "#535353",
        lineHeight: "18px",
        fontFamily: "sans-serif",
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
          color: "rgba(0, 0, 0, 0.26)",
          fontSize: "15px",
        },
      },
      invalid: {
        color: "red",
        iconColor: "#fa755a ",
      },
    },
  },
  customer: {
    id: null,
    first_name: "First Name",
    middle_name: "Middle Name",
    last_name: "Last Name",
    email: "demo@email.com",
    phone: {
      country_code: "965",
      number: "99999999",
    },
  },
  order: {
    amount: <?php 
		$x = $total-$discount;
		echo $x ; 
	?>,
    currency: "SAR",
    items: [
	<?php 
		foreach(session('cart') as $id => $details){
			$t =  $details['available_in_stock'] * (((100 - $details['product_discount_id']) * $details['price'])/100);
			echo '{
				id: 1,
				name: "'.$details['title'].'",
				description: "",
				quantity: "'.$details['available_in_stock'].'",
				amount_per_unit: "'.$details['price'].'",
				discount: {
				  type: "P",
				  value: "'.$details['product_discount_id'].'%",
				},
				total_amount: "'.$t.'",
			},';
		}
	?>
    ],
    shipping: null,
    taxes: null,
  },
  transaction: {
    mode: "charge",
    charge: {
      saveCard: false,
      threeDSecure: true,
      description: "فاتورة شراء",
      statement_descriptor: "Sample",
      reference: {
        transaction: "txn_0001", //here you should put transaction id 
        order: "ord_0001", //here you should put order id 
      },
      hashstring:"",
      metadata: {},
      receipt: {
        email: false,
        sms: true,
      },
      redirect: "https://shtlah.com/cart", //here you should type url to receive payment response.
      post: null,
    },
  },
});

	</script>

	<script type="text/javascript">
    $(".update-cart").change(function (e) {
            e.preventDefault();
       
            var ele = $(this);
       
            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id"), 
                    available_in_stock: ele.parents("tr").find(".available_in_stock").val()
                },
                success: function (response) {
                   window.location.reload();
                }
            });
        });
       
       $(".remove-from-cart").click(function (e) {
            e.preventDefault();
    
        var ele = $(this);
           Swal.fire({
               title: 'هل أنت متأكد من الحذف؟',

               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'نعم !',
               cancelButtonText: "لأ"
           }).then((result) => {
               if (result.isConfirmed) {
                   $.ajax({
                       url: '{{ route("remove.from.cart") }}',
                       method: "DELETE",
                       data: {
                           _token: '{{ csrf_token() }}',
                           id: ele.parents("tr").attr("data-id")
                       },
                       success: function (response) {
                           ele.closest("tr").remove();
                           Swal.fire(
                               'تم الحذف بنجاح!',
                               '',
                               'success'
                           )
                           window.location.reload();
                       }
                   });

               }
           })
    });
     
       
</script>
@endsection
