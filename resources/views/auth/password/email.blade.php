@extends('front_layout.layout')
@section('content')

<div class="container pt-4 pb-6" style="padding-bottom: 30px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header " style="text-align: right;background-color: #f1cb4e;color: white">تغير كلمة المرور</div>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success" style="text-align: right" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    <form method="POST" action="/forget-password">
                        @csrf
                        <div class="form-group row mt-4">

                            <label for="email" class="col-md-3 col-form-label text-right">البريد الإلكتروني</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" style="text-align: right" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group " style="text-align:-webkit-center !important;">
                            <div class="col-md-6 ">
                                <button type="submit"  class="btn btn-primary">
                                     ارساال رابط التغير
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection