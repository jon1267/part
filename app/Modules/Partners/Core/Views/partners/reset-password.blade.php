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
                <p class="login-box-msg">Забыли пароль? Здесь Вы можете сбросить пароль.</p>

                <form action="recover-password.html" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Сбросить пароль</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="/login">Вход</a>
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
