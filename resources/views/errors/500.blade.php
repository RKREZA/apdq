@extends('errors.error_master')
@section('title')
    <title>500</title>
@endsection

@section('error')
<div class="error">
    <h1>500</h1>
    <h2>Internal Server Error</h2>
    <p>
        <a href="javascript:;" onclick="return history.go(-1);" style="text-decoration: none; font-size: 20px; color: #000">Go Back</a>
    </p>
</div>
@endsection
