@extends('adminlte.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <!-- /.col-md-6 -->
                <!-- class="col-10 mx-auto"  -->
                <div class="col-12">
                    <div class="card ">
                        {{--<div class="card-header d-flex align-items-baseline ">
                            <h5 class="m-0"> Заказы </h5>
                              <a href="" class="btn btn-primary ml-4">
                                Добавить заказ
                            </a>
                        </div>--}}
                        <div class="card-body table-responsive p-0">

                            <!--<table class="table table-bordered table-striped table-sm " id="table">-->
                            <table class="table table-hover " id="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Домен</th>
                                    <th>Дата</th>
                                    <th>Заказ</th>
                                    <th>Сумма</th>
                                    <th>ТТН</th>
                                    <th>Статус</th>
                                </tr>

                                @if(count($orders))
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->kod}}</td>
                                            <td>{{$order->adv}}</td>
                                            <td>{{$order->datebuy}}</td>
                                            <td>{{$order->product}}</td>
                                            <td>{{$order->sum}}</td>
                                            <td> </td>
                                            <td><span class="badge badge-pill text-white" style="background: {{ App\Models\StatusColor::getColorBy($order->status_id) }};" >{{ $order->status }}</span></td>
                                            {{--<td>

                                                <form action="{{ route('admin.order.destroy', $order) }}" class="form-inline " method="POST" id="fop-delete-{{$fop->id}}">
                                                    <div class="form-group">
                                                        <!-- ссылка независима, к форме не привязана, просто чтоб кнопы были в строку -->
                                                        <a href="{{ route('admin.fop.edit', $fop) }}" class="btn btn-primary btn-sm mr-1" title="Редактировать фоп"> <i class="fas fa-pen"></i> </a>

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger btn-sm" href="#" role="button" title="Удалить фоп"
                                                                onclick="confirmDelete('{{$fop->id}}', 'fop-delete-')" >
                                                            <i class="fas fa-trash" ></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>--}}
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7"><p class="lead">Заказов субпартнеров пока нет.</p></td>
                                    </tr>
                                @endif
                            </table>

                            <div class="mt-2 ml-3 ">
                                @if($orders->hasPages())
                                    {{ $orders->links() }}
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

