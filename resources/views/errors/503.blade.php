@extends('errors.error_master')
@section('title')
    <title>503</title>
@endsection

@section('error')
<div class="error">
    <h1>503</h1>
    <h2>Service Unavailable</h2>
    <p>
        <a href="javascript:;" onclick="return history.go(-1);" style="text-decoration: none; font-size: 20px; color: #000">Go Back</a>
    </p>
</div>
@endsection
