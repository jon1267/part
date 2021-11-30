@extends('layouts.front')

@section('content')
<section class="thanks" style="height: 60vh;">
    <div class="wrapper">
        <div class="thanks__inner">
            <h1>

                @if (isset($_GET['success']))
                    <br/>{{ __('Ваша оплата прошла успешно!') }}
                    {{ __('Скоро посылка будет отправлена по указанному Вами адресу. Смс оповещение о прибытии поступит на Ваш телефон.') }}

                    <script>
                        setTimeout(function(){ window.location.href = encodeURI("https://wep.wf/gz5i5k"); }, 5000);
                    </script>
                @endif

                @if (isset($_GET['order']))
                    <br/>{{ __('Идет обработка вашего заказа...') }}
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
                    <br/>{{ __('Скоро посылка будет отправлена по указанному Вами адресу. Смс оповещение о прибытии поступит на Ваш телефон.') }}

                    <script>
                        setTimeout(function(){ window.location.href = encodeURI("https://wep.wf/gz5i5k"); }, 5000);
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
