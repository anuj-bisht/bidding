@extends('layout.index')
@section('content')
<div class="container">
   <div class="wrap-breadcrumb">
      <ul>
         <li class="item-link"><a href="{{url('bidderLoginform')}}" class="link">Login</a></li>
         <li class="item-link"><a href="{{url('sellerRegister')}}" class="link">Register</a></li>
      </ul>
   </div>



@if($errors->any())
<div align="center"><h4>{{$errors->first()}}</h4></div>
@endif

            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                  <div class="auto-form-wrapper">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                      <div class="form-group">
                        <label class="label">Username</label>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      <div class="form-group">
                        <button class="btn btn-primary submit-btn btn-block">Login</button>
                      </div>
                      {{-- <div class="form-group d-flex justify-content-between">
                        <div class="form-check form-check-flat mt-0">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" checked> Keep me signed in </label>
                        </div>
                        <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
                      </div> --}}
                      {{-- <div class="form-group">
                        <button class="btn btn-block g-login">
                          <img class="mr-3" src="{{ url('assets/images/file-icons/icon-google.svg') }}" alt="">Log in with Google</button>
                      </div>
                      <div class="text-block text-center my-3">
                        <span class="text-small font-weight-semibold">Not a member ?</span>
                        <a href="{{ url('/user-pages/register') }}" class="text-black text-small">Create new account</a>
                      </div> --}}
                    </form>
                  </div>
                  {{-- <ul class="auth-footer">
                    <li>
                      <a href="#">Conditions</a>
                    </li>
                    <li>
                      <a href="#">Help</a>
                    </li>
                    <li>
                      <a href="#">Terms</a>
                    </li>
                  </ul> --}}
                  {{-- <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p> --}}
                </div>
              </div>










   </div>
</div>
<!--end container-->
</main>
@endsection
