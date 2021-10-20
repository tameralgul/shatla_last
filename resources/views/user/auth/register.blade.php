@extends('front_layout.layout')
        @section('content')
            <main class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-sm-12 d-flex justify-content-center font-weight-bold title-page" style="">
                        تسجيل جديد
                    </div>

                    <div class="col-sm-5 col-10 mt-4">
                    
                        <form action="{{ route('user.store') }}" method="POST" class="col-sm-12 row d-flex flex-column">
                            @csrf
                            <div class="form-group text-right">
                                <label for="">
                                    الاسم
                                </label>
                                <input value="{{old('name')}}" type="text" name="name" class="form-control input-customize">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                               @enderror
                            </div>
                            <div class="form-group text-right">
                                <label for="">
                                    الايميل
                                </label>
                                <input value="{{old('email')}}" type="email" name="email" class="form-control input-customize" autocomplete="off">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                               @enderror
                            </div>
                            <div class="form-group text-right">
                                <label for="">
                                    كلمة السر
                                </label>
                                <input type="password" name="password" class="form-control input-customize" autocomplete="off">
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                               @enderror
                            </div>
                            <div class="form-group text-right">
                                <label for="">
                                    تأكيد كلمة السر
                                </label>
                                <input type="password" name="password_confirmation" class="form-control input-customize">
                                @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                               @enderror
                            </div>
                            <div class="form-group col-sm-12" style="padding-right: 0px!important;padding-left: 0px!important;">
                                <button type="submit" class="btn btn-checkout w-100">تسجيل</button>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="col-sm-12 text-center login-link">
                        هل لديك حساب ؟ <a href="{{URL::to('/')}}" class="login-href">تسجيل دخول</a>
                    </div> --}}
                </div>

            </main>

        @endsection
@push('css')
    <style>
        .navlist {
            display: none!important;
        }
    .search-field{
        display: none!important;
    }
    .header-nav{
        display: none!important;
    }
    .hide-lg{
        display: none!important;
    }
    .navbar-toggler{
        display: none!important;
    }
    .input-customize {
            border-top-color: white !important;
            border-right-color: white !important;
            border-left-color: white !important;

        }

        .input-title {
            font-size: 1.2vw;
            color: #373A3C;
            font-family: Roboto, Sans-Serif;
            margin-top: 0.5em;
        }

        .input-margin {
            margin-top: 0.5em;
        }

        .create-account {
            font-size: 1.9vw;
            margin-bottom: 1em;
        }

        .first-input {
            margin-top: 0.5em;
        }

        .second-input-margin {
            margin-left: 0.2em;
        }

        .btn-submit {
            background-color: #FFD600;
            margin-top: 1em;
            width: 125%;
            color: white;
            font-weight: 400;
            font-family: Roboto, Sans-Serif;
            margin-bottom: 4em;
        }

        .title-page {
            font-size: 1.5em
        }

        .login-link {
            font-size: 1.1em;
        }

        .login-href {
            color: #FFD600 !important;
        }

        /**********











        ****************/
        @media (max-width: 450px) {
            .navbar-img {
                margin-left: 0em;
                height: 26px;
            }

            .already-have-account {
                font-size: 2.5vw;
                margin-right: 3em;
            }

            .language {
                right: 0em;
            }

            .sign-in {
                font-size: 2.5vw;
            }

            .create-account {
                margin-left: 4em;
                font-size: 4.5vw;
                font-weight: bold;
            }

            .input-customize {

                border-top-color: white !important;
                border-right-color: white !important;
                border-left-color: white !important;
            }

            .input-title {
                font-size: 3.5vw;
            }
        }

        @media (max-width: 350px) {
            .already-have-account {
                font-size: 2.5vw;
                margin-right: 2em;
            }

            .language {
                font-size: 3vw;
            }

            .navbar-img {
                height: 20px;
            }

            .content-custom {
                margin-top: 2em;
            }

            .create-account {
                margin-left: 6em;
            }

        }
    </style>
@endpush
