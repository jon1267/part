@extends('adminlte.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <!-- /.col-md-6 -->
                <!-- class="col-10 mx-auto"  -->
                <div class="col-10">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-around">
                                <p class="h5">Ваш доход: <span class="text-green text-bold">{{ $earnings }} {{ $valuta }}</span></p>
                                <p class="h5">Доход от субпартнеров: <span class="text-green text-bold">{{ $subearnings }} {{ $valuta}}</span></p>
                            </div>


                            <div class="my-3 d-flex justify-content-center">
                                @if($payButtonEnabled)
                                {{--<a href="{{ route('cabinet.request.payment') }}" id="request-payment-link" class="btn  btn-primary ">--}}
                                <form action="{{ route('cabinet.request.payment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="earnings" value="{{ $earnings }}">
                                    <input type="hidden" name="subearnings" value="{{ $subearnings }}">
                                    <input type="hidden" name="host" value="{{ auth()->user()->host }}">

                                    <button type="submit" id="request-payment-link" class=" btn btn-primary">
                                        Запрос выплаты
                                    </button>
                                </form>
                                @else
                                    <!-- сделано так, бо button type="submit" тупо тварь сабмитит форму как ты его не делай disabled -->
                                    <a href="#" class="btn btn-secondary disabled">Запрос выплаты</a>
                                @endif
                            </div>


                            @if(!$payButtonEnabled)
                            <div class="d-flex justify-content-center">
                                <p class="h5">Вы сможете запросить платеж, как только ваш доход составит не менее {{ $min }} {{ $valuta }} </p>
                            </div>
                            @endif

                        </div>
                    </div>

                    <div class="card ">
                        <div class="card-header d-flex align-items-baseline ">
                            <h5 class="m-0"> Выплаты: </h5>
                        </div>
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
                                        <td colspan="5"><p class="lead text-center">Запрошенных выплат пока нет.</p></td>
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

