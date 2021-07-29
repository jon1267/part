@extends('adminlte.start')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <!--<a href="../../index2.html"><b>Admin</b>LTE</a>-->
            <center>
                <img src="{{ asset('/images/euro.png') }}" class="logo" style="max-width: 300px; width: 100%">
            </center>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Регистрация нового партнера</p>

                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="ФИО">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" id="tel" name="tel" class="form-control  @error('tel') is-invalid @enderror" placeholder="Телефон">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        @error('tel')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Пароль">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Повторите пароль">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--<div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>-->
                        <!-- /.col -->
                        <div class="col mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Регистрация</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!--<div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div>-->

                <a href="/login" class="text-center">Я уже зарегистрирован</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
@endsection
