@extends('layouts.front')

@section('content')

    @include('front.header')

    <section class="info-page">
        <div class="wrapper">
            <div class="info-page__inner info-page__inner--certificates" style="height: 52vh; margin-top: 100px;">
                <h1>
                    Договір оферти
                </h1>

                <p>
                    Оформляючи замовлення на нашому сайті Ви як наш клієнт даєте згоду на періодичне відправлення Вам sms та viber повідомлень з пропозиціями про різні акції, знижки та індивідуальні пропозиції. Ця оферта діє з моменту оформлення замовлення на сайті.
                </p>

                <div class="return-catalog">
                    <a href="{{ route('ua.front.index') }}" >{{ __('Повернутися в каталог') }}</a>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('footer')
    @include('front.footer')
@endsection
