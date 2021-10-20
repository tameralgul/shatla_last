<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };
</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('backend_assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('backend_assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('backend_assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('backend_assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('backend_assets/js/pages/widgets.js') }}"></script>
<script src="{{ asset('backend_assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<link href="http://fonts.cdnfonts.com/css/cairo-2" rel="stylesheet">
<script src="{{asset('backend_assets/js/sweetalert.js')}}"></script>
<script src="{{asset('backend_assets/js/ckeditor.js')}}"></script>
<script src="{{asset('/backend_assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js?v=7.2.8')}}"></script>
<script src="{{asset('/backend_assets/js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset("/backend_assets/js/jquery-date-picker.js")}}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script> --}}
<script src="{{ asset('backend_assets/js/pages/features/miscellaneous/toastr.js') }}"></script>
<script src="{{ asset('backend_assets/js/pages/crud/forms/widgets/bootstrap-select.js') }}"></script>
<script src="{{ asset('backend_assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
<script src="{{ asset('backend_assets/js/select2.js') }}"></script>

<script src="{{ asset('backend_assets/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
<script src="{{ asset('backend_assets/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
<script src="{{ asset('backend_assets/bootstrap-fileinput/js/plugins/purify.min.js') }}"></script>

<script src="{{ asset('backend_assets/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('backend_assets/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>

<script>
    
    toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    };
</script>

<style>
    #kt_body {
        font-family: 'Cairo', sans-serif;
    }
</style>

<script>
    //image input show image by abed
    $(document).ready(function () {
    $('#file-image').on('change', function () { //on file input change
    if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
    {
    $('#thumb-output').html(''); //clear html of output element
    var data = $(this)[0].files; //this file data

    $.each(data, function (index, file) { //loop though each file
    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
    var fRead = new FileReader(); //new filereader
    fRead.onload = (function (file) { //trigger function on successful read
    return function (e) {
    var img = $('<img />').addClass('thumb').attr('src', e.target.result); //create image element
    $('#thumb-output').append(img); //append image to output element
    };
    })(file);
    fRead.readAsDataURL(file); //URL representing the file's data.
    }
    });

    } else {
    alert("Your browser doesn't support File API!"); //if File API is absent
    }
    });
    });
</script>
