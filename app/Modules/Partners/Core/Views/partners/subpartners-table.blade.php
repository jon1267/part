@extends('adminlte.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-10 form-group">
                    <p class="h5 text-center"> Ваша ссылка для привлечения субпартнеров: </p>
                    <input class="form-control mx-auto col-4 mb-4" style="text-align: center; font-size: 16px;" type="text" value="{{ 'http://'.auth()->user()->domain.'.pdp-partner.loc/register' }}" readonly >
                    {{-- 'pdparis.com/register' | config('app.url').'register'  --}}
                    <p class="h5"> Подключайте людей в вашу партнерскую программу и зарабатывайте 2% с их продаж на постоянной основе, это называется субпартнерство.</p>
                    <p class="h5"> Делитесь вашей ссылкой с активными людьми, и каждый кто по ней зарегистрируется, становится навсегда вашим субпартнером.</p>
                </div>

            </div>

            <div class="row">
                <!-- /.col-md-6 -->
                <!-- class="col-10 mx-auto"  -->
                <div class="col-10">

                    <div class="card ">

                        <div class="card-body table-responsive p-0">

                            <!--<table class="table table-bordered table-striped table-sm " id="table">-->
                            <table class="table table-hover " id="table">
                                <tr>
                                    <th>Дата регистрации</th>
                                    <th>ФИО</th>
                                    <th>Телефон</th>
                                    <th>Домен</th>
                                    <th>Заказы</th>
                                </tr>

                                @if(count($subpartners))
                                    @foreach($subpartners as $subpartner)
                                        <tr>
                                            <td>{{$subpartner->created}}</td>
                                            <td>{{$subpartner->name}}</td>
                                            <td>{{$subpartner->tel}}</td>
                                            <td>{{$subpartner->domain}}</td>
                                            <td>{{$subpartner->total_orders}}</td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5"><p class="lead">Субпартнеров пока нет.</p></td>
                                    </tr>
                                @endif
                            </table>

                            <div class="mt-2 ml-3 ">
                                @if($subpartners->hasPages())
                                    {{ $subpartners->links() }}
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

