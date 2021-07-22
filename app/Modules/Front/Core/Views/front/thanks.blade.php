@extends('layouts.front')

@section('content')
<section class="thanks" style="height: 60vh;">
    <div class="wrapper">
        <div class="thanks__inner">
            <h1>

                @if (isset($_GET['success']))
                    <br/>Ваша оплата прошла успешно!
                    Скоро посылка будет отправлена по указанному Вами адресу. Смс оповещение о прибытии поступит на Ваш телефон.

                    <script>
                        setTimeout(function(){ window.location.href = encodeURI("https://wep.wf/gz5i5k"); }, 1000);
                    </script>
                @endif

                @if (isset($_GET['order']))
                    <br/>Идет обработка вашего заказа...
                @endif

                @if (isset($_GET['phone']))
                    @php
                        $phone = trim($_GET['phone']);
                        $phone = str_replace('+', '', $phone);
                        $phone = str_replace(' ', '', $phone);
                        $phone = str_replace('-', '', $phone);
                        $phone = str_replace('(', '', $phone);
                        $phone = str_replace(')', '', $phone);
                    @endphp
                    <br/>Скоро посылка будет отправлена по указанному Вами адресу. Смс оповещение о прибытии поступит на Ваш телефон.

                    <script>
                        setTimeout(function(){ window.location.href = encodeURI("https://wep.wf/gz5i5k"); }, 1000);
                    </script>
                @endif
            </h1>

            <p>
                {{ $button }}
            </p>
        </div>
    </div>
</section>
@endsection

@section('footer')
    @include('front.footer')
@endsection
