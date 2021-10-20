@extends('front_layout.layout')
@section('content')
    <main class="container-fluid mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 text-center font-weight-bold title-page text-right" style="">
                تعديل الحساب
            </div>
            <div class="col-sm-5 col-10 mt-5">
                <form  id="profile" class="col-sm-12 row d-flex flex-column">
                    @csrf
                    <div class="form-group text-right" {{$errors->has('name') ? 'has-error' : ''}}>
                        <label for="">
                            الاسم
                        </label>
                        <input type="text" name="name" value="{{$user->name}}" class="form-control input-customize">
                    </div>
                    <input type="hidden" name="profile_id" id="profile_id" value="{{ $user->id }}">
                    <div class="form-group text-right" {{$errors->has('email') ? 'has-error' : ''}}>
                        <label for="">
                            الايميل
                        </label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control input-customize">
                    </div>
                    <div class="form-group text-right">
                        <label for="">
                            كلمة السر
                        </label>
                        <input type="password" class="form-control input-customize">

                        <div class="form-group col-sm-12 mt-5" style="padding-right: 0px!important;padding-left: 0px!important;">
                            <a  id="EditsaveBtn" class="btn btn-checkout w-100">تعديل</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </main>

@endsection