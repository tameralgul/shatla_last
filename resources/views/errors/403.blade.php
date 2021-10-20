<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('front_assets/css/bootstrap.rtl.min.css')}}">
    <title>Forbidden</title>
    <link rel="stylesheet" href="{{asset('front_assets/css/index.css')}}">
    <style>
        html{
            overflow-y: hidden!important;
        }
        body{
            overflow-y: hidden!important;
            overflow-x: hidden!important;
        }
        .lottie-player{
            margin-top: 3em;
            width: 64%;
            height: 50%;
            margin-left: 10em;
        }
        .title-page{
            margin-top: 2em;
            font-size: 2em;
            font-family: Cairo,Sans-Serif;
        }
        @media (max-width: 767px) {
            .lottie-player{
                margin-left: 5em;
            }
            .title-page{
                margin-top: 50%;
                font-size: 1.5em;
            }
            .lottie-player{
                margin-top: 50%;
                width: 90%;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid">

    <div class="row d-flex justify-content-center">
        <lottie-player class="lottie-player" src="{{asset('front_assets/lottie/not_allowed.json')}}"  background="transparent"  speed="1"   loop autoplay></lottie-player>
    </div>
</div>
<script src="{{asset("front_assets/js/lottie.js")}}"></script>
<script src="{{asset('front_assets/js/bootstrap.min.js')}}">
</script>
</body>
</html>
