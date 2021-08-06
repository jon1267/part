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
                                    <th>ID</th>
                                    <th>Дата </th>
                                    <th>Заказы</th>
                                    <th>Сумма</th>
                                    <th>Статус</th>
                                </tr>

                                @if(count($profits))
                                    @foreach($profits as $profit)
                                        <tr>
                                            <td>{{$profit->id}}</td>
                                            <td>{{$profit->date}}</td>
                                            <td>{!!  $profit->order !!}</td>
                                            <td>{{$profit->total}} {{ ($profit->host == 1) ? ' грн.' : ' руб.'}}</td>
                                            {{-- <td>{{($profit->active == 1) ? 'Выплачено' : 'Не выплачено'}}</td> --}}
                                            <td><span class="badge badge-pill {{($profit->active == 1) ? ' badge-success' : ' badge-secondary' }}" style="font-size: 14px;" >{{($profit->active == 1) ? 'Выплачено' : 'Не выплачено'}}</span></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5"><p class="lead">Запрошенных выплат пока нет.</p></td>
                                    </tr>
                                @endif
                            </table>

                            <div class="mt-2 ml-3 ">
                                @if($profits->hasPages())
                                    {{ $profits->links() }}
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

