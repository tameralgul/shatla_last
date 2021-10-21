
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}" />
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}} ">
    <link rel="stylesheet" href="{{asset("/assets/css/style.css")}}" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" rel="stylesheet">
    <link rel="icon" href="{{asset("assets/img/logo/logo.png")}}">
    <link rel="stylesheet" href="{{asset('assets/css/style_modal.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/ionicons.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://use.fontawesome.com/e5ae5ff4d3.js"></script>
    <script type="text/javascript" src="https://goSellJSLib.b-cdn.net/v1.6.0/js/gosell.js"></script>
    
    <title>@yield('title',"متجر شتلة")</title>
    <link href="{{asset('assets/css/cart.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .navbar-toggler{
            fill: #4950;
        }
    </style>
    @stack('css')
</head>

<body>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content container">
                <div class="modal-header text-center mt-2 mr-3">
                    <h5 class="modal-title" id="exampleModalLabel">الرجاء اختيار المدينة</h5>
                </div>
                <div class="modal-body container">
                    <div class="row mr-3 ml-3">
                        <select name="city" id="city" class="form-control city">
                            <option value="">اختر من هنا</option>
                            @foreach($cities as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid outer-box-loader" style="">
        <div class="container-fluid inner-box-loader" style="">
            <div class="row  d-flex flex-column content-box-loader" style="">
                <div class="col-12 text-center">
                    <img src="{{ asset('images/logo/'.  $setting->logo) }}" class="image-loader" alt="logo" />
                </div>
                <div class="col-12  text-center">
                    <div class="lds-ripple">
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-2 sticky-top" style="padding-bottom: 0px!important;">
        <div class="container" >
            <a class="navbar-brand mr-0" href="{{ route('home.index') }}">
                <div class="logo">
                    <img src="{{ asset('images/logo/'.  $setting->logo) }}" class="w-100 h-100" alt="logo" />
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <svg style="fill: #616161;" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav mx-auto" style="flex: 1">
                    <div class="search-form">
                        <form class="searchform" method="GET" action="{{route('product.search')}}">
                            <div class="d-flex w-100 justify-content-center align-items-center h-100"
                                style="position: relative">
                                <div class="w-100">
                                    <input type="text" name="title" value="{{app('request')->get('title')}}"
                                        class="search-field w-100 py-2 px-4 primary-font" placeholder="ابحث في المتجر"
                                        id="" />
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="form-inline my-2 my-lg-0">
                    <ul class="d-flex navlist mt-3">
                        @guest
                        <li class=" " data-toggle="modal" data-target="#exampleModalCenter">تسجيل الدخول</li>
                        @else
                        <li class="dropdown">
                            <div style="color:rgba(102,102,102,.85);" class=" dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ auth()->user()->name }}
                                <span class="fa fa-user"></span>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="nav-link " title="Your Profile"
                                    href="{{route('front-profile',['id'=> Auth::id()])}}" aria-haspopup="true"
                                    aria-expanded="false">
                                    {{ Auth::user()->name }} {{" "}} <span class="fa fa-user"></span>
                                </a>
                                <a class="nav-link " href="{{ route('user.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ "تسجيل خروج"." " }}<span class="fa fa-share-square-o primary-font"></span>
                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </a>

                            </div>
                        </li>
                        @endguest

                        <li class="header-divider"></li>
                        <li>
                            <div class="dropdown" id="cart_box">
                                @include('front_layout.cart_content')
                            </div>
                        </li>
                    </ul>
                    <select  name="city" style="border: none;appearance: none;" id="city" class="form-control city" >
                        <option value="">اختر من هنا</option>
                        @foreach($cities as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="hide-lg">
                    <div>
                        <ul class="d-flex flex-column text-right navlist text-white pt-2">
                            @foreach ($categories->take(10) as $category)
                            <li style="width: 50%" class="dropdown pt-2">
                                <p class="dropbtn">{{ $category->name ." "}}@if(!$category->subCategory->isEmpty())<span
                                        style="color: #f1cb4e;" class="fas fa-chevron-circle-down"></span> @endif</p>
                                <div class="dropdown-content text-right">
                                    @foreach($category->subCategory as $item)
                                    <a href="/sub_category/{{$item->id}}">{{$item->name}}</a>
                                    @endforeach
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </nav>

    <!--    -->
    <div class="header-nav hide-for-sm">
        <div class="row d-flex w-100">
            <div class="mx-auto">
                <ul class="d-flex navlist text-white pt-2" style="margin-bottom: 0px">
                    @foreach ($categories->take(10) as $category)

                    @if($category->subCategory->isEmpty())
                    <a href="{{ route('product.category',$category->id) }}" class="dropdown pt-2 a-navlink">
                        <p class="dropbtn">{{ $category->name }}</p>
                    </a>
                    @else
                    <li class="dropdown pt-2 mt-1">
                        <p class="dropbtn">{{ $category->name }}</p>
                        <div class="dropdown-content text-center" style="border-radius: 10px;z-index:500;">
                            @foreach($category->subCategory as $item)
                            <a href="/sub_category/{{$item->id}}">{{$item->name}}</a>
                            @endforeach
                        </div>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
<main>

    @yield('content')
</main>
    <footer class="text-right">
        <div class="container">
            <div class="row d-flex align-items-baseline mb-3">
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="footerlogo">
                        <img src="{{ asset('images/logo/'.  $setting->logo) }}" alt="logo" class="w-100 h-100">
                    </div>
                    <div>
                        <p class="primary-font text-color-7 font-size-16">نهدف لتكون تجربتكم في شراء النباتات
                            ومستلزماتها عبر متجر شتلة تجربة سهلة ومميزة </p>
                    </div>
                    <div class="socailicon">
                        <a href="{{URL::to($setting->facebook_url)}}" class="icon facebookicon">
                            <i class="fa fa-facebook-f "></i>
                        </a>
                        <div href="{{URL::to($setting->instagram_url)}}" class="icon">
                            <i class="fab fa-instagram"></i>
                        </div>
                        <a href="{{URL::to($setting->twitter_url)}}" class="icon">
                            <i class="fab fa-twitter"></i>
                        </a>

                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="primary-font">
                        <p class="primary-font text-color-black help-title">روابط سريعة</p>
                        <div>
                            @foreach ($pages_data_2->take(3) as $page)
                            <ul class="list-group text-color-7 footer-list">
                                <li><a href="{{ route('show.pages',['id' => $page->id]) }}">{{ $page->title }}</a></li>
                            </ul>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 col-lg-3">
                    <div class="primary-font">
                        <p class="primary-font text-color-black help-title">صفحات تهمك</p>
                        <div>
                            <ul class="list-group text-color-7 footer-list">
                                <li><a href="{{URL::to('/contact_us')}}"> تواصل معنا</a></li>
                                @foreach ($pages_data->take(2) as $page)
                                <li><a href="{{ route('show.pages',['id' => $page->id]) }}">{{ $page->title }}</a> </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-3 mb-3">
                    <div class="primary-font">
                        <p class="primary-font text-color-black help-title">وسائل دفع معتمدة</p>
                    </div>
                    <div class="payment-icons inline-block">

                        <div class="payment-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 32">
                                <path
                                    d="M10.781 7.688c-0.251-1.283-1.219-1.688-2.344-1.688h-8.376l-0.061 0.405c5.749 1.469 10.469 4.595 12.595 10.501l-1.813-9.219zM13.125 19.688l-0.531-2.781c-1.096-2.907-3.752-5.594-6.752-6.813l4.219 15.939h5.469l8.157-20.032h-5.501l-5.062 13.688zM27.72 26.061l3.248-20.061h-5.187l-3.251 20.061h5.189zM41.875 5.656c-5.125 0-8.717 2.72-8.749 6.624-0.032 2.877 2.563 4.469 4.531 5.439 2.032 0.968 2.688 1.624 2.688 2.499 0 1.344-1.624 1.939-3.093 1.939-2.093 0-3.219-0.251-4.875-1.032l-0.688-0.344-0.719 4.499c1.219 0.563 3.437 1.064 5.781 1.064 5.437 0.032 8.97-2.688 9.032-6.843 0-2.282-1.405-4-4.376-5.439-1.811-0.904-2.904-1.563-2.904-2.499 0-0.843 0.936-1.72 2.968-1.72 1.688-0.029 2.936 0.314 3.875 0.752l0.469 0.248 0.717-4.344c-1.032-0.406-2.656-0.844-4.656-0.844zM55.813 6c-1.251 0-2.189 0.376-2.72 1.688l-7.688 18.374h5.437c0.877-2.467 1.096-3 1.096-3 0.592 0 5.875 0 6.624 0 0 0 0.157 0.688 0.624 3h4.813l-4.187-20.061h-4zM53.405 18.938c0 0 0.437-1.157 2.064-5.594-0.032 0.032 0.437-1.157 0.688-1.907l0.374 1.72c0.968 4.781 1.189 5.781 1.189 5.781-0.813 0-3.283 0-4.315 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="payment-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 32">
                                <path
                                    d="M42.667-0c-4.099 0-7.836 1.543-10.667 4.077-2.831-2.534-6.568-4.077-10.667-4.077-8.836 0-16 7.163-16 16s7.164 16 16 16c4.099 0 7.835-1.543 10.667-4.077 2.831 2.534 6.568 4.077 10.667 4.077 8.837 0 16-7.163 16-16s-7.163-16-16-16zM11.934 19.828l0.924-5.809-2.112 5.809h-1.188v-5.809l-1.056 5.809h-1.584l1.32-7.657h2.376v4.753l1.716-4.753h2.508l-1.32 7.657h-1.585zM19.327 18.244c-0.088 0.528-0.178 0.924-0.264 1.188v0.396h-1.32v-0.66c-0.353 0.528-0.924 0.792-1.716 0.792-0.442 0-0.792-0.132-1.056-0.396-0.264-0.351-0.396-0.792-0.396-1.32 0-0.792 0.218-1.364 0.66-1.716 0.614-0.44 1.364-0.66 2.244-0.66h0.66v-0.396c0-0.351-0.353-0.528-1.056-0.528-0.442 0-1.012 0.088-1.716 0.264 0.086-0.351 0.175-0.792 0.264-1.32 0.703-0.264 1.32-0.396 1.848-0.396 1.496 0 2.244 0.616 2.244 1.848 0 0.353-0.046 0.749-0.132 1.188-0.089 0.616-0.179 1.188-0.264 1.716zM24.079 15.076c-0.264-0.086-0.66-0.132-1.188-0.132s-0.792 0.177-0.792 0.528c0 0.177 0.044 0.31 0.132 0.396l0.528 0.264c0.792 0.442 1.188 1.012 1.188 1.716 0 1.409-0.838 2.112-2.508 2.112-0.792 0-1.366-0.044-1.716-0.132 0.086-0.351 0.175-0.836 0.264-1.452 0.703 0.177 1.188 0.264 1.452 0.264 0.614 0 0.924-0.175 0.924-0.528 0-0.175-0.046-0.308-0.132-0.396-0.178-0.175-0.396-0.308-0.66-0.396-0.792-0.351-1.188-0.924-1.188-1.716 0-1.407 0.792-2.112 2.376-2.112 0.792 0 1.32 0.045 1.584 0.132l-0.265 1.451zM27.512 15.208h-0.924c0 0.442-0.046 0.838-0.132 1.188 0 0.088-0.022 0.264-0.066 0.528-0.046 0.264-0.112 0.442-0.198 0.528v0.528c0 0.353 0.175 0.528 0.528 0.528 0.175 0 0.35-0.044 0.528-0.132l-0.264 1.452c-0.264 0.088-0.66 0.132-1.188 0.132-0.881 0-1.32-0.44-1.32-1.32 0-0.528 0.086-1.099 0.264-1.716l0.66-4.225h1.584l-0.132 0.924h0.792l-0.132 1.585zM32.66 17.32h-3.3c0 0.442 0.086 0.749 0.264 0.924 0.264 0.264 0.66 0.396 1.188 0.396s1.1-0.175 1.716-0.528l-0.264 1.584c-0.442 0.177-1.012 0.264-1.716 0.264-1.848 0-2.772-0.924-2.772-2.773 0-1.142 0.264-2.024 0.792-2.64 0.528-0.703 1.188-1.056 1.98-1.056 0.703 0 1.274 0.22 1.716 0.66 0.35 0.353 0.528 0.881 0.528 1.584 0.001 0.617-0.046 1.145-0.132 1.585zM35.3 16.132c-0.264 0.97-0.484 2.201-0.66 3.697h-1.716l0.132-0.396c0.35-2.463 0.614-4.4 0.792-5.809h1.584l-0.132 0.924c0.264-0.44 0.528-0.703 0.792-0.792 0.264-0.264 0.528-0.308 0.792-0.132-0.088 0.088-0.31 0.706-0.66 1.848-0.353-0.086-0.661 0.132-0.925 0.66zM41.241 19.697c-0.353 0.177-0.838 0.264-1.452 0.264-0.881 0-1.584-0.308-2.112-0.924-0.528-0.528-0.792-1.32-0.792-2.376 0-1.32 0.35-2.42 1.056-3.3 0.614-0.879 1.496-1.32 2.64-1.32 0.44 0 1.056 0.132 1.848 0.396l-0.264 1.584c-0.528-0.264-1.012-0.396-1.452-0.396-0.707 0-1.235 0.264-1.584 0.792-0.353 0.442-0.528 1.144-0.528 2.112 0 0.616 0.132 1.056 0.396 1.32 0.264 0.353 0.614 0.528 1.056 0.528 0.44 0 0.924-0.132 1.452-0.396l-0.264 1.717zM47.115 15.868c-0.046 0.264-0.066 0.484-0.066 0.66-0.088 0.442-0.178 1.035-0.264 1.782-0.088 0.749-0.178 1.254-0.264 1.518h-1.32v-0.66c-0.353 0.528-0.924 0.792-1.716 0.792-0.442 0-0.792-0.132-1.056-0.396-0.264-0.351-0.396-0.792-0.396-1.32 0-0.792 0.218-1.364 0.66-1.716 0.614-0.44 1.32-0.66 2.112-0.66h0.66c0.086-0.086 0.132-0.218 0.132-0.396 0-0.351-0.353-0.528-1.056-0.528-0.442 0-1.012 0.088-1.716 0.264 0-0.351 0.086-0.792 0.264-1.32 0.703-0.264 1.32-0.396 1.848-0.396 1.496 0 2.245 0.616 2.245 1.848 0.001 0.089-0.021 0.264-0.065 0.529zM49.69 16.132c-0.178 0.528-0.396 1.762-0.66 3.697h-1.716l0.132-0.396c0.35-1.935 0.614-3.872 0.792-5.809h1.584c0 0.353-0.046 0.66-0.132 0.924 0.264-0.44 0.528-0.703 0.792-0.792 0.35-0.175 0.614-0.218 0.792-0.132-0.353 0.442-0.574 1.056-0.66 1.848-0.353-0.086-0.66 0.132-0.925 0.66zM54.178 19.828l0.132-0.528c-0.353 0.442-0.838 0.66-1.452 0.66-0.707 0-1.188-0.218-1.452-0.66-0.442-0.614-0.66-1.232-0.66-1.848 0-1.142 0.308-2.067 0.924-2.773 0.44-0.703 1.056-1.056 1.848-1.056 0.528 0 1.056 0.264 1.584 0.792l0.264-2.244h1.716l-1.32 7.657h-1.585zM16.159 17.98c0 0.442 0.175 0.66 0.528 0.66 0.35 0 0.614-0.132 0.792-0.396 0.264-0.264 0.396-0.66 0.396-1.188h-0.397c-0.881 0-1.32 0.31-1.32 0.924zM31.076 15.076c-0.088 0-0.178-0.043-0.264-0.132h-0.264c-0.528 0-0.881 0.353-1.056 1.056h1.848v-0.396l-0.132-0.264c-0.001-0.086-0.047-0.175-0.133-0.264zM43.617 17.98c0 0.442 0.175 0.66 0.528 0.66 0.35 0 0.614-0.132 0.792-0.396 0.264-0.264 0.396-0.66 0.396-1.188h-0.396c-0.881 0-1.32 0.31-1.32 0.924zM53.782 15.076c-0.353 0-0.66 0.22-0.924 0.66-0.178 0.264-0.264 0.749-0.264 1.452 0 0.792 0.264 1.188 0.792 1.188 0.35 0 0.66-0.175 0.924-0.528 0.264-0.351 0.396-0.879 0.396-1.584-0.001-0.792-0.311-1.188-0.925-1.188z">
                                </path>
                            </svg>
                        </div>

                        <div class="payment-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 32">
                                <path
                                    d="M16.398 13.428c0.034 3.535 3.201 4.71 3.236 4.726-0.027 0.083-0.506 1.676-1.668 3.322-1.005 1.423-2.048 2.84-3.692 2.87-1.615 0.029-2.134-0.927-3.98-0.927s-2.422 0.898-3.951 0.956c-1.586 0.058-2.794-1.539-3.807-2.956-2.070-2.9-3.653-8.194-1.528-11.768 1.055-1.775 2.942-2.899 4.989-2.927 1.558-0.029 3.027 1.015 3.98 1.015s2.738-1.255 4.616-1.071c0.786 0.032 2.993 0.308 4.41 2.317-0.114 0.068-2.633 1.489-2.605 4.444zM13.363 4.749c0.842-0.987 1.409-2.362 1.254-3.729-1.213 0.047-2.682 0.783-3.552 1.77-0.78 0.874-1.464 2.273-1.279 3.613 1.353 0.101 2.735-0.666 3.577-1.654zM25.55 3.058c0.624-0.105 1.313-0.2 2.065-0.284s1.581-0.126 2.485-0.126c1.291 0 2.404 0.152 3.339 0.457s1.704 0.741 2.307 1.308c0.517 0.504 0.92 1.103 1.21 1.796s0.435 1.492 0.435 2.395c0 1.092-0.199 2.049-0.596 2.868s-0.941 1.507-1.629 2.064c-0.688 0.557-1.506 0.972-2.452 1.245s-1.979 0.41-3.098 0.41c-1.011 0-1.86-0.073-2.548-0.22v9.076h-1.517v-20.989zM27.068 13.648c0.366 0.104 0.774 0.178 1.226 0.22s0.935 0.063 1.451 0.063c1.936 0 3.436-0.441 4.501-1.323s1.597-2.174 1.597-3.876c0-0.819-0.14-1.534-0.42-2.143s-0.677-1.108-1.193-1.497c-0.516-0.388-1.129-0.683-1.839-0.882s-1.495-0.3-2.356-0.3c-0.688 0-1.28 0.027-1.774 0.079s-0.893 0.11-1.193 0.173l0.001 9.487zM49.452 20.454c0 0.61 0.010 1.219 0.032 1.828s0.086 1.197 0.194 1.765h-1.42l-0.225-2.143h-0.065c-0.194 0.294-0.441 0.588-0.742 0.882s-0.65 0.562-1.048 0.803c-0.398 0.242-0.85 0.436-1.355 0.583s-1.059 0.22-1.662 0.22c-0.753 0-1.414-0.121-1.985-0.362s-1.038-0.557-1.403-0.946c-0.366-0.389-0.64-0.836-0.822-1.339s-0.274-1.008-0.274-1.513c0-1.786 0.769-3.162 2.307-4.129s3.855-1.429 6.953-1.387v-0.41c0-0.399-0.038-0.856-0.113-1.371s-0.242-1.003-0.5-1.465c-0.258-0.462-0.645-0.851-1.161-1.166s-1.215-0.473-2.097-0.473c-0.666 0-1.328 0.1-1.983 0.299s-1.253 0.478-1.791 0.835l-0.484-1.103c0.688-0.462 1.399-0.793 2.13-0.992s1.495-0.3 2.29-0.3c1.076 0 1.952 0.178 2.63 0.536s1.21 0.819 1.597 1.387c0.387 0.567 0.651 1.202 0.791 1.906s0.21 1.402 0.21 2.096l-0.001 5.957zM47.936 15.948c-0.818-0.021-1.673 0.010-2.566 0.094s-1.715 0.268-2.468 0.552c-0.753 0.284-1.377 0.699-1.871 1.245s-0.742 1.271-0.742 2.175c0 1.072 0.312 1.859 0.935 2.364s1.323 0.757 2.097 0.757c0.624 0 1.182-0.084 1.677-0.252s0.925-0.394 1.291-0.677c0.366-0.283 0.672-0.603 0.919-0.961s0.436-0.725 0.565-1.103c0.108-0.421 0.161-0.726 0.161-0.915l0.001-3.277zM52.418 8.919l3.935 9.833c0.215 0.547 0.42 1.108 0.613 1.686s0.366 1.108 0.516 1.591h0.065c0.15-0.462 0.322-0.982 0.516-1.56s0.409-1.171 0.645-1.781l3.679-9.77h1.613l-4.484 11.094c-0.452 1.177-0.877 2.243-1.275 3.199s-0.801 1.817-1.21 2.585c-0.409 0.767-0.822 1.445-1.242 2.033s-0.887 1.103-1.404 1.544c-0.602 0.525-1.156 0.908-1.661 1.151s-0.844 0.394-1.016 0.457l-0.517-1.229c0.387-0.168 0.818-0.388 1.291-0.662s0.936-0.63 1.387-1.072c0.387-0.378 0.812-0.877 1.274-1.497s0.876-1.371 1.242-2.254c0.13-0.336 0.194-0.557 0.194-0.662 0-0.147-0.065-0.367-0.194-0.662l-5.582-14.025h1.614z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="lastfooter">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center flex-sm-column flex-md-row flex-lg-row">
                    <div class="text-white primary-font"> الحقوق محفوظة {{date("Y")}} &copy; شتلة </div>
                    <div class="text-white primary-font">
                        <a href="#">سياسة الاستخدام</a> |
                        <a href="#"> الشروط والأحكام</a>
                    </div>
                </div>
            </div>

        </div>
    </footer>



    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i
            class="fas fa-chevron-up"></i></a>
    @include('front_layout.sign_in_modal')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="{{asset("assets/js/jquery.min.js")}}"></script>


    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <!--     <script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false
        },
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        }
    });
</script> -->
    <script src="{{asset("assets/js/bootstrap.min.js")}}"></script>
    <script>
        $('#back-to-top').fadeOut();
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 6,
            spaceBetween: 30,
            speed: 2800,
            autoplay: {
                enabled: true,
                delay: 1,
            },
            loop:true,
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                // when window width is >= 480px
                480: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 4,
                    spaceBetween: 20
                }
            }
            /*       pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                  }, */
            /*     navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                  }, */
        });
        $('.carousel').carousel({
            interval: 4000,
            ride: true
        })
        $(document).on('click','.join-us',function (){
            $('.join-us-link').toggle();
        })
        $(document).ready(function(){
            $('.outer-box-loader').fadeOut(2500);
            $(window).scroll(function () {
                if ($(this).scrollTop() > 60) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });
            // scroll body to 0px on click
            $('#back-to-top').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 400);
                return false;
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

            $(document).on('click','#saveBtn',function(e) {

                e.preventDefault();
                $('#password').text('');
                $('#email').text('');

                let formData = new FormData($('#loginform')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{route('user.login')}}",
                    data:formData,
                    processData: false,
                    contentType: false,
                    cache: false,

                    success: function (response) {
                        if (response.status == 504) {

                        }else{
                            // $("#exampleModalCenter").modal('hide');
                            $("#loginform").trigger('reset');//to clear the form
                            location.reload();
                        }

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
    <script>
        $(document).ready(function (){
        @if(session()->has('city'))
            let city = `{{session()->get('city')}}`;

                $('.city').val(city)
            @else
        $('#exampleModal').modal('show')
        @endif
    })
    </script>
    <script>
        $(document).on('change','.city',function (){
            let city = $(this).val();
            $.ajax({
                url:'/change_city',
                method:'get',
                data:{city},
                success:function (res){
                    if (res.status){
                        $('#exampleModal').modal('hide')
                        window.location.reload()
                    }
                }
            })
        })

    </script>
<script>
    $(document).ready(function () {
        $('main').click(function (event) {
            var click = $(event.target);
            var _open = $(".navbar-collapse").hasClass("show");
            if (_open === true && !click.hasClass("navbar-toggler")) {
                $(".navbar-toggler").click();
            }
        });
    });
</script>


@yield('js')

</body>

</html>
