@extends('adminlte.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <!--<div class="col-8"> -->
                <div class="col-md-8 col-sm-12 mx-auto">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="m-0">Изменение контактной информации</h5>
                        </div>
                        <div class="card-body">

                            <form  action="{{ route('update.profile') }}" method="post" >
                                @csrf
                                {{--@method('PUT') --}}

                                <div class="form-group mb-3">
                                    <label for="name" class="ml-1">Имя:</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="ФИО"
                                           value="{{(isset($user->name)) ? $user->name : old('name')}}">
                                    @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tel" class="ml-1">Телефон:</label>
                                    <input type="text" id="tel" name="tel" class="form-control  @error('tel') is-invalid @enderror" placeholder="Телефон"
                                           value="{{(isset($user->tel)) ? $user->tel : old('tel')}}">
                                    @error('tel')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email" class="ml-1">Email</label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                           value="{{(isset($user->email)) ? $user->email : old('email')}}">
                                    @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="city" class="ml-1">Город</label>
                                    <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="Город"
                                           value="{{(isset($user->city)) ? $user->city : old('city')}}">
                                    @error('city')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="bank" class="ml-1">Банковская карта: номер и ФИО</label>
                                    <input type="text" id="bank" name="bank" class="form-control @error('bank') is-invalid @enderror" placeholder="Банковская карта"
                                           value="{{(isset($user->bank)) ? $user->bank : old('bank')}}">
                                    @error('bank')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mt-4 mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="notification" type="checkbox" id="notification"
                                               @isset($user->notification) @if($user->notification == 1) checked @endif @endisset >
                                        <label class="custom-control-label" for="notification">Уведомлять о заработке и выплате</label>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password" class="ml-1">Пароль <span class="small"> ( не вводите пароль, чтобы он не менялся )</span></label>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Пароль">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" style="display: inline-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password_confirmation">Повтор пароля</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-primary"> <i class="far fa-save mr-2"></i> Сохранить </button>
                                    <a href="{{ route('cabinet') }}" class="btn btn-info ml-2"> <i class="fas fa-sign-out-alt mr-2"></i>Отмена</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
