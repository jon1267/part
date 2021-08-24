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
                            <!--МЫ ОЧЕНЬ ХОТИМ ПОЗНАКОМИТЬ ВАС С НАШЕЙ ПАРФЮМЕРИЕЙ, УВЕРЕНЫ – ВЫ В НЕЕ ВЛЮБИТЕСЬ, ПОЭТОМУ ДАЕМ ТАКУЮ СИМВОЛИЧЕСКУЮ ЦЕНУ!-->
                            <!--Вы получите максимально проработанные и усиленные версии самых популярных брендовых ароматов, всего по 179 грн за флакон! Созданы лучшими парфюмерами Франции.-->
                            Познакомьтесь очень легко с мировыми парфюмерными шедеврами. Единая цена на все!
                            <br/>
                            <!--Выберите <strong style="color:#fb200d;">3 любых</strong> пробника по&nbsp;2,5 мл -->
                            <!-- Мы используем <strong>только оригинальные</strong> компоненты для создания красивых, безопасных и гипоаллергенных ароматов. Наши аналоги - это уникальные формулы, которые максимально приближены к своим брендовым форматам, но незначительно отличается от них своеобразной изюминкой в аромате. -->
                        </p>
                        <div style="border:2px solid rgb(133, 84, 160); margin: 0 auto; max-width:580px; width:100%; text-align:center;">
                            <div style="font-size:28px; font-weight:bold;">Акция</div>


                            <a href="#" style="display: block; vertical-align: middle; margin-bottom:10px;">
                                <span style="vertical-align: middle;">30 мл в подарок</span>
                                <img src="/images/gift.png" style="vertical-align: middle; width:32px; height:32px;"/>
                                <span style="vertical-align: middle;">при заказе от 600 {{ $valuta }}</span>
                            </a>


                        </div>
                    </div>

                </div>
            </div>
        </section>

        <div class="wrapper" style="padding:0 30px;">
            <!-- slider from 3-5-10 most sale(favorite) product card -->
            <h2 class="font-weight-400 text-center" style="margin-top: 30px;" >Топ продаж</h2>
            <section class="regular slider top-sales-slider" id="top-sales-slider" >
                <template v-cloak v-for="group in productsTop">
                    <div v-for="product in group.products" v-if="product.show">
                        {{--<?=$this->include('tmp/product-card') ?>--}}
                        @include('front.product-card')
                    </div>
                </template>
            </section>
        </div>

        <div class="wrapper" style="padding:0 30px;">
            <!-- slider from 3-5-10 new products -->
            <h2 class="font-weight-400 text-center" style="margin-top: 30px;" >Новинки</h2>
            <section class="regular2 slider top-sales-slider" id="new-sales-slider" >
                <template v-cloak v-for="group in productsNew">
                    <div v-for="product in group.products" v-if="product.show">
                        {{--<?=$this->include('tmp/product-card') ?>--}}
                        @include('front.product-card')
                    </div>
                </template>
            </section>
        </div>

        <!-- woman parfumes -->
        <section class="product">
            <div class="product__header" id="woman">
                <div class="wrapper sample-title">
                    <h2 class="font-weight-400">
                        Женская парфюмерия

                        <a v-cloak v-if="brandsSelected.length === 0" href="#man" class="product-card__button sex_button">
                            перейти к мужским
                        </a>
                    </h2>

                    <p v-cloak v-if="brandsSelected.length > 0"><br/>Выбранные бренды: @{{ brandsSelected.join(', ') }}<br/></p>

                    <a v-cloak v-if="brandsSelected.length > 0" @click="clearBrands()" class="product-card__button sex_button" style="width:200px; display:inline-block; line-height: 30px; font-size:12px;">
                        показать все бренды
                    </a>

                    <br/>

                    <div>Выберите <div class="basket-circle" style="position:relative; right:20px; margin: 0; right:0; top:7px; "><div class="horizontal-plus"></div><div class="vertical-plus"></div></div> свои парфюмы</div>
                </div>
            </div>

            <div class="product__list">
                <div class="wrapper">
                    <div class="product-list">
                        <div v-cloak v-for="group in productsGroupped" v-if="group.woman == 1 && group.show" class="product-list__col">
                            <div v-for="product in group.products" v-show="product.show">
                                @include('front.product-card')
                            </div>
                        </div>
                    </div>


                    <div id="show-more-woman" class="product__header" style="padding: 15px 0 15px;">
                        <div class="wrapper sample-title">
                            <h2>
                                <a @click="showMoreGroup('woman')" class="product-card__button our_green show-more-all" >
                                    <i class="fas fa-sync" style="margin-right: 10px;"></i> больше парфюмов
                                </a>
                            </h2>
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
                        Мужская парфюмерия
                        <a v-cloak v-if="brandsSelected.length === 0" href="#woman" class="product-card__button sex_button">
                            вернуться к женским
                        </a>
                    </h2>

                    <p v-cloak v-if="brandsSelected.length > 0"><br/>Выбранные бренды: @{{ brandsSelected.join(', ') }}<br/></p>

                    <a v-cloak v-if="brandsSelected.length > 0" @click="clearBrands()" class="product-card__button sex_button" style="width:200px; display:inline-block; line-height: 30px; font-size:12px;">
                        показать все бренды
                    </a>

                    <br/>

                    <div>Выберите <div class="basket-circle" style="position:relative; right:20px; margin: 0; right:0; top:7px; "><div class="horizontal-plus"></div><div class="vertical-plus"></div></div> свои парфюмы</div>
                </div>
            </div>

            <div class="product__list">
                <div class="wrapper">
                    <div class="product-list">

                        <div v-cloak v-for="group in productsGroupped" v-if="group.man == 1 && group.show" class="product-list__col">
                            <div v-for="product in group.products" v-show="product.show">
                                @include('front.product-card')
                            </div>
                        </div>
                    </div>

                    <div id="show-more-man" class="product__header" style="padding: 15px 0 15px;">
                        <div class="wrapper sample-title">
                            <h2>
                                <a @click="showMoreGroup('man')" class="product-card__button our_green show-more-all" >
                                    <i class="fas fa-sync" style="margin-right: 10px;"></i> больше парфюмов
                                </a>
                            </h2>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <!-- man parfumes end -->

        @include('front.antiseptics')
        @include('front.auto')

        @include('front.advantages')
        @include('front.eu-directive')

    </div>
    <!-- hide-navigation -->

    @include('front.customer-feedback')

@endsection

@section('footer')
    @include('front.footer')
@endsection
