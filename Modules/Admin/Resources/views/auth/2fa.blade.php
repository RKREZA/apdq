
@extends('admin::layouts.guest')

@section('page_title')
    {{ __('admin::auth.signin_title') }}
@endsection

@section('container')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    2FA Verification

                    <a href="{{ route('admin.logout') }}" class="text-start text-primary text-gradient font-weight-bold float-end">Logout</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.2fa.post') }}">
                        @csrf

                        <p class="text-center text-success">We sent code to your phone : {{ substr(auth()->user()->mobile, 0, 5) . '****' . substr(auth()->user()->mobile,  -2) }}</p>

                        @if ($message = Session::get('success'))
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="alert alert-success alert-block text-white">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                      <strong>{{ $message }}</strong>
                                  </div>
                              </div>
                            </div>
                        @endif

                        @if ($message = Session::get('error'))
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="alert alert-danger alert-block text-white">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                      <strong>{{ $message }}</strong>
                                  </div>
                              </div>
                            </div>
                        @endif

                        <div class="input-group input-group-outline my-3 is-filled @error('code') is-invalid @enderror">
                            <label class="form-label"><span class="required">OTP</span></label>
                            <input type="number" name="code" class="form-control">
                            @error('code')
                                <em class="error invalid-feedback"
                                    style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>

                        <a class="text-start text-dark text-gradient font-weight-bold" href="{{ route('admin.2fa.resend') }}">Resend Code?</a>

                        <div class="col-md-12 mt-2">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
