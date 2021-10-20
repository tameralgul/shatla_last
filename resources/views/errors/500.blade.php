<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('errors/css/bootstrap.rtl.min.css')}}">
    <title>Internal Server error</title>
    <link rel="stylesheet" href="{{asset('errors/css/index.css')}}">
    <style>
        html{
            overflow-y: hidden!important;
        }
        body{
            overflow-y: hidden!important;
            overflow-x: hidden!important;
        }
        .lottie-player{
            width: 66%;
            height: 100%;
            margin-top: 2.5em;
            margin-left: 10em;
        }
        .title-page{
            margin-top: 2em;
            font-size: 2em;
            margin-right: 1.8em;
            font-family: Cairo,Sans-Serif;
        }
        @media (max-width: 767px) {
            .lottie-player{
                width: 90%;
                margin-left: 1em;
                margin-top: 60%;
            }
            .title-page{
                margin-top: 60%;
                font-size: 1.4em;
                margin-right: 0px;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid">

    <div class="row d-flex justify-content-center">
        <lottie-player class="lottie-player" src="{{asset('errors/lottie/server_error.json')}}"  background="transparent"  speed="1"   loop autoplay></lottie-player>
    </div>
</div>
<script src="{{asset("errors/js/lottie.js")}}"></script>
<script src="{{asset('errors/js/bootstrap.min.js')}}">
</script>
</body>
</html>