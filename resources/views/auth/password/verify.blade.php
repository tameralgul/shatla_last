<hmtl>
    <head>
        <style>
            .card-header{
                text-align: right;
                margin-right: 2em;
                font-size: 2em;
                margin-top: 1em;
            }
            .card-body{
                text-align: right;
            }
            .btn-success{
                text-align: right;margin-top: 2em;margin-right: 2.5em;font-size: 1.5em;text-decoration: none!important;color: #f1cb4e!important;
            }
            footer{
                font-size: 0.9em;text-align: right;font-weight: 600;margin-right: 5em;
            }
            hr{
                margin-top: 2em

            }
            @media (max-width: 767px) {
                .btn-success{
                    margin-right: 1.3em;
                }
                .card-header{
                    margin-right: 1em;
                }
                footer{
                    margin-right: 3em;
                }
            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="color: black!important;">تأكيد البريد الإلكتروني</div>
                    <div class="card-body" style="">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <a
                                style="" class="btn btn-success" href="{{ url('/reset-password/'.$token) }}">اضغط هنا </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr style="">
    <footer style="color: black!important;">
        {{date("Y")}} متجر شتلة
    </footer>
    </body>
</hmtl>
    
        

