@extends('front_layout.layout')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-right font-weight-bold">
                الرجاء الاختيار
            </div>
            <div class="col-sm-3 mt-3" style="margin-left: 3em;">
                <select name="" id="payment" class="form-control">
                    <option value="cash">مقدم خدمة</option>
                    <option value="credit"> صاحب حرفة</option>
                </select>
            </div>
        </div>
    </div>
    <div class="container form-inverse">
        <div class="row">
            <div class="col-sm-12 col-12 text-right mt-5 title">
                مقدم خدمة
            </div>
            <div class="col-sm-12 col-12">
                <div class="help-title"></div>
            </div>
            <form class="col-sm-12 col-12 row" id="contact_us">
                <div class="col-sm-12 row mt-4">
                    <label for="" class="col-sm-2 col-5 text-right">اسم المتجر</label>
                    <input type="email" class="form-control col-sm-5 col-7" name="email">
                    <small id="email_error" class="form-text text-danger"></small>
                </div>
                <div class="col-sm-12 row mt-4">
                    <label for="" class="col-sm-2 col-5 text-right">رقم التواصل</label>
                    <input type="email" class="form-control col-sm-5 col-7" name="email">
                    <small id="email_error" class="form-text text-danger"></small>
                </div>
                <div class="col-sm-12 row mt-4">
                    <label for="" class="col-sm-2 col-5 text-right">البريد الالكتروني</label>
                    <input type="email" class="form-control col-sm-5 col-7" name="email">
                    <small id="email_error" class="form-text text-danger"></small>
                </div>

                <div class="col-sm-12 col-12 row mt-4">
                    <label for="" class="col-sm-2 col-5 text-right">الرسالة</label>
                    <textarea rows="6" id="message" class="form-control col-sm-5 col-7" name="message"></textarea>
                    <small id="message_error" class="form-text text-danger"></small>
                </div>
                <div class="col-sm-9 col-12 text-center mt-4">
                    <button type="button" id="savebtncontact" class="btn btn-primary">ارسال</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container form-credit ">
        <div class="row">
            <div class="col-sm-12 col-12 text-right mt-5 title">
                صاحب الحرفة
            </div>
            <div class="col-sm-12 col-12">
                <div class="help-title"></div>
            </div>
            <form class="col-sm-12 col-12 row" id="contact_us">
                <div class="col-sm-12 row mt-4">
                    <label for="" class="col-sm-2 col-5 text-right">اسم الحرفة</label>
                    <input type="email" class="form-control col-sm-5 col-7" name="email">
                    <small id="email_error" class="form-text text-danger"></small>
                </div>
                <div class="col-sm-12 row mt-4">
                    <label for="" class="col-sm-2 col-5 text-right">رقم التواصل</label>
                    <input type="email" class="form-control col-sm-5 col-7" name="email">
                    <small id="email_error" class="form-text text-danger"></small>
                </div>
                <div class="col-sm-12 row mt-4">
                    <label for="" class="col-sm-2 col-5 text-right">البريد الالكتروني</label>
                    <input type="email" class="form-control col-sm-5 col-7" name="email">
                    <small id="email_error" class="form-text text-danger"></small>
                </div>

                <div class="col-sm-12 col-12 row mt-4">
                    <label for="" class="col-sm-2 col-5 text-right">الرسالة</label>
                    <textarea rows="6" id="message" class="form-control col-sm-5 col-7" name="message"></textarea>
                    <small id="message_error" class="form-text text-danger"></small>
                </div>
                <div class="col-sm-9 col-12 text-center mt-4">
                    <button type="button" id="savebtncontact" class="btn btn-primary">ارسال</button>
                </div>
            </form>
        </div>
    </div>


@endsection
@section('js')
    <script>
        $('.form-credit').fadeOut();
        $('#payment').change(function() {
            if ($(this).val() === 'cash') {
                $('.form-inverse').fadeIn();
                $('.form-credit').fadeOut();
            }
            else {
                $('.form-credit').fadeIn();
                $('.form-inverse').fadeOut();
            }
        });
    </script>
@endsection