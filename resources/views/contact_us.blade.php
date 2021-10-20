@extends('front_layout.layout')
@section('title')
شتلة | تواصل معنا
@endsection
@push('css')
<style>
    .title {
        font-size: 1.5em;
    }

    @media (max-width: 767px) {
        label {
            font-size: 0.8em;
            font-weight: 600;
            margin-top: 0.5em;
        }
    }
</style>
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-12 text-right mt-5 title">
            تواصل معنا
        </div>
        <div class="col-sm-12 col-12">
            <div class="help-title"></div>
        </div>
        <form class="col-sm-12 col-12 row" id="contact_us">
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
    $(document).ready(function() {
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }});

        $("#savebtncontact").click(function(event) {
          event.preventDefault();
        $('#email').text('');
        $('#message').text('');
        
        let formData = new FormData($('#contact_us')[0]);
        
        $.ajax({
            type: 'POST',
            url: "{{route('contact.store')}}",
            data:formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
            if (response.status == 200) {
            toastr.success(response.success);
            }
            $("#contact_us").trigger('reset');//to clear the form
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
@endsection