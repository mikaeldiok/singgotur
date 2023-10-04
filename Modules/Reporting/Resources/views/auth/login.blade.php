@extends('auth.layout')

@section('title') @lang('Login') @endsection

@section('content')

<div class="main-content bg-light">

    <div class="header py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5 py-5">
                        <h1 class="text-white">@lang('Selamat Datang')</h1>
                        <p class="text-lead text-white">
                            @lang("Silakan masuk untuk bisa mengakses area donatur")
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt--9 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-light border border-soft">

                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>Login dengan email dan password</small>
                        </div>

                        @include('flash::message')

                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <p>
                                <i class="fas fa-exclamation-triangle"></i> @lang('Please fix the following errors & try again!')
                            </p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <form role="form" method="POST" action="{{ route('auth.reports.login') }}">
                            @csrf

                            <!-- redirectTo URL -->
                            <input type="hidden" name="redirectTo" value="{{ request()->redirectTo }}">

                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control" id="report_email" name="report_email" value="{{ old('report_email') }}" placeholder="{{ __('E-Mail Address') }}" aria-label="email" aria-describedby="input-email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="@lang('Password')" aria-label="@lang('Password')" aria-describedby="input-password" required>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-12">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" name="remember" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">
                                            <span class="text-muted">
                                                Remember my login
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-2">
                                    @lang('Submit')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="{{ route('password.request') }}" class="text-gray">
                            <!-- <small>{{ __('Forgot Your Password?') }}</small> -->
                            <small>Silakan hubungi kami jika anda kehilangan password</small>
                        </a>
                    </div>
                    @if (Route::has('register'))
                    <div class="col-6 text-right">
                        <a href="{{ route('register') }}" class="text-gray">
                            <small>Create new account</small>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
