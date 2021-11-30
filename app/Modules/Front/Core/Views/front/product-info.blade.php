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
                <div style="display: flex; align-items: center; justify-content: center;">
                    <img class="product-info-img" src="{{ $product['img'] }}"  alt="" @if(isset($product['volume']) AND $product['volume'] == 500) style="max-width:225px" @endif>
                </div>

                <div style="margin-left: 30px;">
                    <div class="mob-center" style="font-size: 28px; font-weight: 500; margin-bottom: 25px;">
                        <span id="product-variant-price">{{ $product['price'] }}</span>  {{ $valuta }}
                    </div>

                    <!-- не понимаю, чего vue не фильтрует этот див ?  -->
                    @if( in_array(substr($product['art'],0,2), ['W0','W1','M0','M1'], true) )
                        <div v-cloak v-if="variants = findProductVariantsByArt('{{$product['art']}}')" class="mob-center" style="margin-bottom: 25px;">
                            <a v-for="variant in variants" :id="['variant-'+variant.volume]"
                               @click="setProductVariantPrice(variant.price, variant.volume, variant.img1000)"
                               class="vol-button" :class="[variant.volume == {{$product['volume']}} ? 'vol-active' : '']">
                                @{{ variant.volume }} мл
                            </a>
                        </div>
                    @endif


                    <div class="mob-center" @click="extendProductCart('{{$product['art']}}', $event)">
                        <a href="#" class="product-card__button" style="text-decoration: none;padding: 8px 30px;">{{ __('Добавить в корзину') }}</a>
                    </div>

                    <p style="margin-top: 25px;">
                        {!! $product['text'] !!}
                    </p>

                </div>
            </div>

            <div class="return-catalog">
                <a href="{{ $product['link'] }}" >{{ __('Вернуться в каталог') }}</a>
            </div>


        </div>
    </div>
</section>

@endsection

@section('footer')
    @include('front.footer')
@endsection
