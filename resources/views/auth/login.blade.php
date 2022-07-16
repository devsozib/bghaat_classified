@extends('backend.layouts.layout')

@section('content')


                <div class="limiter">
                    <div class="container-login100">
                        <div class="wrap-login100 p-l-85 pb-5 pt-4 p-r-85 ">
                            <form class="login100-form validate-form flex-sb flex-w" method="POST" role="form" action="{{ route('login') }}">
                                @csrf
                                <span class="login100-form-title text-center">

                                </span>

                                <span class="txt1 p-b-11">
                                    Email
                                </span>
                                <div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
                                    <input  class="input100 {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ translate('Email') }}">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                    <span class="focus-input100"></span>
                                </div>

                                <span class="txt1 p-b-11">
                                    Password
                                </span>
                                <div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
                                    <span class="btn-show-pass">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                    <input  class="input100 {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" >
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                    <span class="focus-input100"></span>
                                </div>


                                <div class="flex-sb-m w-full p-b-48">
                                    <div class="text-left">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span>{{ translate('Remember Me') }}</span>
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                    @if(env('MAIL_USERNAME') != null && env('MAIL_PASSWORD') != null)
                                    <div>
                                        <a href="{{ route('password.request') }}" class="txt3">
                                            Forgot Password?
                                        </a>
                                    </div>
                                    @endif


                                </div>

                                <div class="container-login100-form-btn">
                                    <button class="login100-form-btn">
                                        Login
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>


                <div id="dropDownSelect1"></div>





@endsection

@section('script')
    <script type="text/javascript">
        function autoFill(){
            $('#email').val('admin@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection
