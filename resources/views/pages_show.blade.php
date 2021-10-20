@extends('front_layout.layout')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-sm-12 text-right category-name">
            {{$page->title}}
        </div>
        <div class="help-title divider-margin "></div>
        <div class="col-sm-12 row mt-4 col-10 mr-4">
            {{ $page->description }}
        </div>
    </div>

   
</div>
@endsection
@push('css')
<style>
    .category-name {
        font-size: 1.5em;
        font-weight: 600;
        margin-right: 1em;
        margin-top: 2em;
    }

    .divider-margin {
        margin-right: 2.5em;
        margin-top: 1em;
        margin-bottom: 1em;
    }
</style>
@endpush
@push('css')
<style>
    @media (max-width: 676px) {
        .br-img-custom {
            max-width: 80% !important;
        }

        .a-custom {
            text-align: right !important;
        }
    }
</style>
@endpush
@section('js')

@endsection