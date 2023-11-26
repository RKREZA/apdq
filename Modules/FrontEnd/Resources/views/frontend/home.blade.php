@extends('frontend::frontend.layouts.master')

@section('title')
    হোম
@endsection
@section('seo')
    <meta name="title" content="{{ $frontend_setting->meta_title }}">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="{{ $frontend_setting->social_title }}" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
<style>

    .dep_icon i {
        display: block;
        line-height: 12px;
        font-size: 25px
    }

    .dep_icon i.fa-long-arrow-right {
        color: #00ff63
    }

    .dep_icon i.fa-long-arrow-left {
        color: #00f5ff
    }

    .dep_h p {
        color: #ffffff;
        font-size: 14px;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .dep_h h4 {
        color: #ffffff;
        font-size: 16px;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .dep-list {
        margin-top: 105px;
    }

    .dep-list li {
        margin-bottom: 15px
    }

    .dep-list li a {
        display: flex;
        justify-content: start;
        align-items: center;
        align-content: center;
        padding: 15px;
        box-shadow: 0 4px 10px rgba(14, 16, 48, .05);
        background: #fff;
        border-radius: 5px
    }

    .dep_list_1 {
        width: 120px;
        text-align: left;
        margin-right: 10px;
    }
    .dep_list_1 > small{
        color: #111;
        font-size: 12px;
        font-weight: 500;
    }
    .dep_list_1 > small i {
        color: #FDDE09;
        font-size: 14px
    }
    .dep_list_1 > small span {
        font-size: 19px;
    }
    .dep-list li ul li {
        display: inline-block;
        margin: 0 0 0 15px;
    }

    .dep-list li ul {
        text-align: center
    }

    .dep_l_ic > img {
        width: 25px;
        float: left;
    }

    .dep_list_1 p {
        color: #111;
        font-size: 12px;
        font-weight: 500;
    }

    .dep_list_1 h2 {
        font-size: 13px;
        color: #444;
    }

    .dep_l_ic span {
        width: 25px;
        display: inline-block;
        height: 15px;
        line-height: 16px;
        background: #fff;
        color: #111;
        font-weight: 500;
        border-radius: 5px;
        font-size: 11px;
        border: 1px solid #eee;
        margin-left: 5px;
    }

    .dep_l_d small {
        background: #0EF65F;
        color: #fff;
        font-weight: 700;
        padding: 4px;
        border-radius: 5px;
        margin-top: 7px;
        display: inline-block;
        line-height: 15px;
        font-size: 12px;
    }
    .dep_list_3 p span {
        font-size: 17px;
    }
    .dep_l_d2 small {
        background: #0EF65F;
        color: #fff;
        font-weight: 700;
        padding: 4px;
        border-radius: 5px;
        margin-top: 7px;
        display: inline-block;
        line-height: 16px;
        font-size: 13px;
    }

    .dep_l_d_2 small {
        background: #00F5FF;
        color: #fff;
        font-weight: 700;
        padding: 4px;
        border-radius: 5px;
        margin-top: 7px;
        display: inline-block;
        line-height: 16px;
        font-size: 13px;
    }

    .dep_l_d_3 small {
        background: #6c2ff4;
        color: #fff;
        font-weight: 700;
        padding: 4px;
        border-radius: 5px;
        margin-top: 7px;
        display: inline-block;
        line-height: 15px;
        font-size: 12px;
    }

    .dep_list_3 {
        flex: 1;
        text-align: right;
        position: relative;
        top: -20px;
    }

    .dep_list_3 p {
        color: #0F9FC6;
        font-size: 12px
    }

    .form_container{
        width: 400px;
        max-height: 700px;
        -webkit-box-shadow: 0 1px 8px 0 rgba(0,0,0,.12);
        box-shadow: 0 1px 8px #0000001f;
        border-radius: 12px;
        margin: 20px;
        height: calc(100% - 40px);
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        z-index: 9;
        position: fixed;
    }

    .select2-container .select2-selection--single {
        height: 54px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 12px;
        margin-top: 22px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 14px;
        right: 7px;
    }

    .location{
        width: 100%;
        text-align: left;
        padding: 10px;
    }
    .location h5{
        font-size: 14px;
    }

    .card-header{
        position: absolute;
        top: 0;
        width: 100%;
    }

    #tab-footer{
        position: absolute;
        bottom: 0;
    }

    #tab-footer .nav-tabs{
        width: 100%;
        border-radius: 0 0 5px 5px;
    }

    #tab-footer .nav-item{
        width: 33.33%;
    }

    #tab-footer .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link{
        color: #ccc;
        margin-bottom: 0;
        margin: auto;
        font-size: 13px;
        font-weight: normal;
        width: 100%;
        padding: 11px 10px 5px 10px;
        border-radius: 5px;
    }

    #tab-footer .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
        color: #fff;
    }

</style>
@endpush

@section('content')



@endsection


@push('js')



@endpush
