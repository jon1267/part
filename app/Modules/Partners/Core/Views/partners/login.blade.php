@extends('adminlte.start')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <!--<a href="../../index2.html"><b>Admin</b>LTE</a>-->
        <center>
            <img src="{{ asset('/images/euro.png') }}" class="logo" style="max-width: 300px; width: 100%">
        </center>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Вход в личный кабинет партнера</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Ваш логин (Email)" value="{{ old('email') }}">
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
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <!--<div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>-->
                    <!-- /.col -->
                    <!--<div class="col-4">-->
                    <div class="col mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Вход</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!--<div class="social-auth-links text-center mb-3">
                <p>- ИЛИ -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Вход через Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Вход через Google+
                </a>
            </div>-->
            <!-- /.social-auth-links -->

            <p class="mb-1">
                <!--<a href="/reset">Я забыл пароль</a>-->
                <a href="{{ route('password.request') }}">Я забыл пароль</a>
            </p>
            <p class="mb-0">
                <a href="/register" class="text-center">Регистрация нового партнера</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
@endsection
