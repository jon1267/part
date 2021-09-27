@extends('layouts.front')

@section('content')
    @include('front.header')

    <section class="info-page" >
    <div class="wrapper">
        <div class="info-page__inner info-page__inner--certificates">
            <h1>
                {{--<?= $product['bname'] .' '.  $product['name'] ?>--}}
                {{ $product['bname'] .' '.  $product['name'] }}
            </h1>

            <div class="product-info-content">
                <!--<div style="align-self: start;">-->
                <div style="display: flex; align-items: center; justify-content: center;">
                    <!--<img src="/files/< $product['img'] >" style="max-width: 400px;"  alt="">-->
                    <img src="{{ $product['img'] }}" style="max-width: 400px;"  alt="">
                </div>

                <div style="margin-left: 30px;">
                    <div class="mob-center" style="font-size: 21px; font-weight: 500; margin-bottom: 25px;">
                        {{ $product['price'] }}  {{ $valuta }}
                    </div>

                    <div class="mob-center" @click="extendProductCart('{{$product['art']}}', $event)">
                        <a href="#" class="product-card__button" style="text-decoration: none;padding: 8px 30px;">{{ __('Добавить в корзину') }}</a>
                    </div>

                    {{--<p class="mob-center" style="font-weight: bold;  margin-top: 25px;">
                        <?= $product['name'].' ('. $product['bname'].')' ?>
                    </p>--}}

                    <p style="margin-top: 25px;">
                        {!! $product['text'] !!}
                    </p>

                </div>
            </div>

            <div style="font-size: 20px; text-align: center; margin-top: 20px;">
                <a href="{{ $product['link'] }}" >{{ __('Вернуться в каталог') }}</a>
            </div>


        </div>
    </div>
</section>

@endsection

@section('footer')
    @include('front.footer')
@endsection
