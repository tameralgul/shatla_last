<?php $i =0 ?>

@php $total = 0 @endphp
@foreach((array) session('cart') as $id => $details)
@php $total += $details['price'] * $details['available_in_stock'] @endphp
@endforeach
<span data-toggle="dropdown" style="@if($total>0){{"color:#FFCA28;font-weight:600;"}}@endif">

    {{ $total }} رس
</span>

<i class="fas fa-shopping-cart" style="@if($total>0){{"color:#FFCA28"}}@endif" data-toggle="dropdown">
</i>
<div class="dropdown-menu drop-customize">
    <div class="row total-header-section mt-2 mb-2" style="color: rgba(102,102,102,.85)!important;">
        <div class="col-lg-4 col-sm-4 col-4 pt-1 text-center" id="refresh">
            <span class="font-weight-bold" id="count">{{ count((array) session('cart')) }}
            </span>
            <i class="fas fa-shopping-cart" aria-hidden="true"></i>
        </div>
        @php $total = 0 @endphp
        @foreach((array) session('cart') as $id => $details)
        @php $total += $details['price'] * $details['available_in_stock'] @endphp
        @endforeach
        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
            <p>المجموع: <span class="font-weight-bold"> {{ $total." " }}رس </span></p>
        </div>
    </div>
    @if(session('cart'))
    @foreach(session('cart') as $id => $details)
    <?php $i++; ?>
    <div class="row cart-detail mb-4">
        <div class="col-lg-5 col-sm-5 col-5 cart-detail-img text-center">
            <img style="width: 60% ;height: 86%;border-radius: 5px"
                src="{{ asset('images/products/cover_images/'.$details['cover_image'])  }}" />
        </div>
        <div class="col-lg-7 col-sm-7 col-7 cart-detail-product text-right">
            <p class="font-weight-bold" style="margin-bottom: 0px">
                {{ $details['title'] }}</p>
            <span class="price font-weight-bold" style="">
                {{ $details['price']." " }}رس</span> <span class="count"><br>
                الكمية:{{  " ".$details['available_in_stock'] }}</span>
        </div>
    </div>
    @if($i>=4)
    <?php break; ?>
    @endif
    @endforeach
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-10 col-sm-8 col-8 text-center checkout">
            <a href="{{ route('cart') }}" class="btn btn-primary btn-block ">
                {{" "}}
                @if($i>=4)
                عرض المزيد
                @else
                عرض السلة
                @endif
                {{" "}}<span class="fas fa-shopping-cart">
                </span> </a>
        </div>
    </div>
</div>