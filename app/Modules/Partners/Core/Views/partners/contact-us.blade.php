@extends('adminlte.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col-md-6 -->
            <!-- class="col-10 mx-auto"  -->
            <div class="col-md-8 col-sm-12 mx-auto">

                <!-- Default box -->
                <div class="card">
                    <div class="card-body">
                        <!--<div class="col-5 text-center d-flex align-items-center justify-content-center">
                            <div class="">
                                <h2>Admin<strong>LTE</strong></h2>
                                <p class="lead mb-5">123 Testing Ave, Testtown, 9876 NA<br>
                                    Phone: +1 234 56789012
                                </p>
                            </div>
                        </div>-->
                        <div>
                            <!--<div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">E-Mail</label>
                                <input type="email" id="inputEmail" class="form-control" />
                            </div>-->

                            <form action="{{ route('cabinet.send.letter') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="subject">Тема сообщения</label>
                                    <input type="text" id="subject" name="subject" class="form-control @error('subject') is-invalid @enderror" />
                                    @error('subject')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message">Сообщение</label>
                                    <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror" rows="4"></textarea>
                                    @error('message')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> <i class="far fa-paper-plane mr-2"></i> Отправить сообщение </button>
                                    <a href="{{ route('cabinet') }}" class="btn btn-info ml-2"> <i class="fas fa-sign-out-alt mr-2"></i>Отмена</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
