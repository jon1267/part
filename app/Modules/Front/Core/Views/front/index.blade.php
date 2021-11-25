@extends('layouts.front')

@section('pixels')
    @include('front.pixels')
@endsection

@section('content')

    @include('front.header')

    @include('front.carousel')

    <div style="position:relative;">
        <div style="position:absolute; top:-40px;" id="adv"></div>
    </div>

    <!-- hide-navigation -->
    <div class="hide-navigation">

        <section class="advantages">
            <div class="wrapper">
                <div class="advantages__inner">
                    <div class="text">
                        <p style="text-align:center">
                            {{ __('Познакомьтесь очень легко с мировыми парфюмерными шедеврами.') }}
                            <br/>
                        </p>
                        <div style="border:2px solid rgb(133, 84, 160); margin: 0 auto; max-width:580px; width:100%; text-align:center;">
                            <div style="font-size:28px; font-weight:bold;">{{__('Акция')}}</div>
                            <p style="padding:0;">{{__('Добавьте 4 товара в корзину и 1 из них будет в')}} <strong>{{__('подарок')}}</strong></p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <div v-cloak class="wrapper" style="padding:0 30px;">
            <h2 class="font-weight-400 text-center" style="margin-top: 30px;" >{{__('Топ продаж')}}</h2>
            <section class="regular slider top-sales-slider" id="top-sales-slider" >
                <div v-cloak v-for="product in productsTop">
                    @include('front.product-card')
                </div>
            </section>
        </div>

        <div v-cloak class="wrapper" style="padding:0 30px;">
            <h2 class="font-weight-400 text-center" style="margin-top: 30px;" >{{__('Новинки')}}</h2>
            <section class="regular2 slider top-sales-slider" id="new-sales-slider" >
                <div v-cloak v-for="product in productsNew">
                    @include('front.product-card')
                </div>
            </section>
        </div>

        <!-- woman parfumes -->
        <section class="product">
            <div class="product__header" id="woman">
                <div class="wrapper sample-title">
                    <h2 class="font-weight-400">
                        {{__('Женская парфюмерия')}}

                        <a v-cloak v-if="brandsSelected.length === 0" href="#man" class="product-card__button sex_button">
                            {{__('перейти к мужской')}}
                        </a>
                    </h2>

                    <p v-cloak v-if="brandsSelected.length > 0"><br/>{{__('Выбранные бренды:')}}
                        <span v-for="brand in brandsSelected">@{{ brand }}
                            <span @click="removeBrand(brand)" class="remove-brand">x</span>
                        </span>
                    </p>

                    <h2><a v-cloak v-if="brandsSelected.length > 0" @click="clearBrands()" class="product-card__button sex_button" style="margin-top:20px;">
                        {{__('показать все бренды')}}</a></h2>

                    <br/>

                    <div>{{__('Выберите')}} <div class="basket-circle" style="position:relative; right:20px; margin: 0; right:0; top:7px; "><div class="horizontal-plus"></div><div class="vertical-plus"></div></div> {{__('свои парфюмы')}} </div>
                </div>
            </div>

            <div class="product__list">
                <div class="wrapper">
                    <div class="product-list">
                        <div v-cloak v-for="product in products" v-if="((product.show && brandsSelected.length === 0) || (brandsSelected.length > 0 && brandsSelected.indexOf(product.bname) > -1 )) && product.woman == 1" class="product-list__col">
                            @include('front.product-card')
                        </div>
                    </div>


                    <div v-if="brandsSelected.length === 0">

                        <div id="more-background-woman" style="height: 140px; overflow: hidden; position: relative; ">
                            @include('front.more-background')
                            <div style="z-index: 50; position: absolute; top: 10px; left: 0; height: 130px; width: 100%; background: linear-gradient(rgba(255,255,255,0), white);"></div>
                        </div>

                        <div id="show-more-woman" class="product__header" style="padding: 15px 0 15px;">
                            <div class="wrapper sample-title">
                                <h2>
                                    <a @click="showMore('woman')" class="product-card__button our_green show-more-all" >
                                        <i class="fas fa-sync" style="margin-right: 10px;"></i> {{__('показать еще')}}
                                    </a>
                                </h2>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
        <!-- woman parfumes end -->

        <!-- man parfumes -->
        <section class="product">
            <div class="product__header" id="man">
                <div class="wrapper sample-title">
                    <h2 class="font-weight-400">
                        {{__('Мужская парфюмерия')}}
                        <a v-cloak v-if="brandsSelected.length === 0" href="#woman" class="product-card__button sex_button">
                            {{__('перейти к женской')}}
                        </a>
                    </h2>

                    <p v-cloak v-if="brandsSelected.length > 0"><br/>{{__('Выбранные бренды:')}}
                        <span v-for="brand in brandsSelected">@{{ brand }}
                            <span @click="removeBrand(brand)" class="remove-brand">x</span>
                        </span>
                    </p>

                    <h2><a v-cloak v-if="brandsSelected.length > 0" @click="clearBrands()" class="product-card__button sex_button" style="margin-top:20px;">
                            {{__('показать все бренды')}}</a></h2>

                    <br/>

                    <div>{{__('Выберите')}} <div class="basket-circle" style="position:relative; right:20px; margin: 0; right:0; top:7px; "><div class="horizontal-plus"></div><div class="vertical-plus"></div></div> {{__('свои парфюмы')}}</div>
                </div>
            </div>

            <div class="product__list">
                <div class="wrapper">
                    <div class="product-list">
                        <div v-cloak v-for="product in products" v-if="((product.show && brandsSelected.length === 0) || (brandsSelected.length > 0 && brandsSelected.indexOf(product.bname) > -1 )) && product.man == 1" class="product-list__col">
                            @include('front.product-card')
                        </div>
                    </div>

                    <div v-if="brandsSelected.length === 0">

                        <div id="more-background-man" style="height: 140px; overflow: hidden; position: relative; ">
                            @include('front.more-background')
                            <div style="z-index: 50; position: absolute; top: 10px; left: 0; height: 130px; width: 100%; background: linear-gradient(rgba(255,255,255,0), white);"></div>
                        </div>

                        <div id="show-more-man" class="product__header" style="padding: 15px 0 15px;">
                            <div class="wrapper sample-title">
                                <h2>
                                    <a @click="showMore('man')" class="product-card__button our_green show-more-all" >
                                        <i class="fas fa-sync" style="margin-right: 10px;"></i> {{__('показать еще')}}
                                    </a>
                                </h2>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </section>
        <!-- man parfumes end -->

        <div v-if="countGel > 0">
            @include('front.gel')
        </div>
        <div v-if="countAuto > 0">
            @include('front.auto')
        </div>
        <div v-if="countSeptics > 0">
            @include('front.antiseptics')
        </div>
        <div v-if="countWoman500 > 0">
            @include('front.year-woman')
        </div>
        <div v-if="countMan500 > 0">
            @include('front.year-man')
        </div>




        @include('front.advantages')

    </div>
    <!-- hide-navigation -->

    @include('front.customer-feedback')

@endsection

@section('footer')
    @if(config('app.host') === '1')
        @include('front.footer')
    @elseif(config('app.host') === '2')
        @include('front.footer_ru')
    @endif
@endsection
