@extends('adminlte.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

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
                                        <td colspan="5"><p class="lead">Заказов пока нет.</p></td>
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

