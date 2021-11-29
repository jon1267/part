@extends('layouts.front')

@section('content')

    @include('front.header')

    <section class="info-page">
        <div class="wrapper">
            <div class="info-page__inner info-page__inner--certificates" style="height: 52vh; margin-top: 100px;">
                <h1>
                    Договор оферты
                </h1>

                <p>
                    Оформляя заказы на нашем сайте Вы как наш клиент даете согласие на периодическую отправку Вам sms и viber сообщений с предложениями о различных акциях, скидках и индивидуальных предложений. Данная оферта действует с момента оформления заказа на сайте.
                </p>

                <div class="return-catalog">
                    <a href="{{ route('front.index') }}" >{{ __('Вернуться в каталог') }}</a>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('footer')
    @include('front.footer')
@endsection

