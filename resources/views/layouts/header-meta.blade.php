<base href="">
<meta charset="utf-8" />
<title>@yield('bar_title')</title>
<meta name="description" content="Updates and statistics" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Page Vendors Styles(used by this page)-->
<link href="{{ asset('backend_assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('backend_assets/css/bootstrap-timepicker.min.rtl.css')}}">
<!--end::Page Vendors Styles-->
<!--begin::Global Theme Styles(used by all pages)-->
<link href="{{ asset('backend_assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend_assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend_assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles-->
<!--begin::Layout Themes(used by all pages)-->
<link href="{{ asset('backend_assets/css/themes/layout/header/base/light.rtl.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend_assets/css/themes/layout/header/menu/light.rtl.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend_assets/css/themes/layout/brand/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend_assets/css/themes/layout/aside/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
<!--end::Layout Themes-->
<link rel="shortcut icon" href="{{ asset('backend_assets/media/logos/favicon.ico') }}" />
<link href="{{ asset('backend_assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('backend_assets/css/sweetalert.css')}}">
<link rel="stylesheet" href="{{asset("backend_assets/css/jquery-date-picker.css")}}">
<link rel="stylesheet" href="{{asset("backend_assets/css/custom.css")}}">
<script src="{{ asset('backend_assets/css/select2.css') }}"></script>
<link href="{{ asset('backend_assets/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
<style>

    td {
        text-align: center !important;
    }
</style>

<style>

    .thumb {
        width: 180px;
        border-radius: 40px;
    }

</style>

<style>
    table.bb td,
    th {
        text-align: center;
    }

    .container-box {
        position: absolute;
        top: 0px;
        left: -1px;

        width: 100%;
        height: 100%;
        background-color: #000000db;
        z-index: 100;
        background:rgba(0,0,0,0.4);
    }
  body{
      overflow-x: hidden;
  }
    .lds-ellipsis {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
    }
    .lds-ellipsis div {
    position: absolute;
    top: 33px;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: #fff;
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }
    .lds-ellipsis div:nth-child(1) {
    left: 8px;
    animation: lds-ellipsis1 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(2) {
    left: 8px;
    animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(3) {
    left: 32px;
    animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(4) {
    left: 56px;
    animation: lds-ellipsis3 0.6s infinite;
    }
    @keyframes lds-ellipsis1 {
    0% {
    transform: scale(0);
    }
    100% {
    transform: scale(1);
    }
    }
    @keyframes lds-ellipsis3 {
    0% {
    transform: scale(1);
    }
    100% {
    transform: scale(0);
    }
    }
    @keyframes lds-ellipsis2 {
    0% {
    transform: translate(0, 0);
    }
    100% {
    transform: translate(24px, 0);
    }
    }
</style>
