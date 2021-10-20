@extends('front_layout.layout')

@section('content')
<div class="container" style="padding-top: 20px;padding-bottom: 10px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header  " style="text-align: right;background-color: #f1cb4e;color: white">تغيير كلمة المرور
                </div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger" style="text-align: right" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form method="POST" action="/reset-password">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group row" style="display: none">
                            <label for="email" class="col-md-3 col-form-label text-md-right text-right">البريد الإلكتروني</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" style="text-align: right" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right text-right">كلمة المرور</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" style="text-align: right" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-right text-right">تاكيد كلمة المرور   </label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 col-12 text-center offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    تغير الكلمة
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