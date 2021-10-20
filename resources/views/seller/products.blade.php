<div class="col-sm-12 row mt-4 col-10">
    @foreach ($products as $product)
        <div class="bg-white br-16 pb-2 card border-0 poiner col-sm-3 mb-3">

            <a href="{{ route('show-product',$product->id) }}" class="w-100 a-custom">
                <img style="max-height: 263px;border-radius:15px"
                     src="{{ URL::asset('/images/products/cover_images/'.$product->cover_image) }}"
                     class="w-100 br-img  br-img-custom" alt="" />
            </a>
            <div class="space-15"></div>
            <div style="line-height: 1.3" class="p-2 text-right">
                <p class="primary-font h-60 text-right">
                    <a href="{{ route('show-product',$product->id) }}" class="color-6">{{$product->title}}</a>
                </p>
                <p class="primary-font font-weight-bold  mt-3 text-right">
                    <span>{{ $product->price }} ر.س</span>
                </p>
                @if (isset($product->discount->value))
                    <span class="last primary-font line-throught"> {{$product->discount->value}}ر.س</span>
                @else
                    <span class="last primary-font" style="visibility: hidden">لا يوجد خصم</span>
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
                   class="color-6 primary-font btnsave cardadd bg-color-8 rounded py-2 my-2 px-3 d-flex justify-content-around button">أضف
                    للسلة
                    <div style="width: 20px; height: 20px">
                        <img src="{{ asset('assets/img/cart.svg') }}" class="w-100 h-100 image-main" alt="">
                        <img src="{{ asset('assets/img/shopping-hover.svg') }}" class="w-100 h-100 image-hover"
                             alt="">

                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>