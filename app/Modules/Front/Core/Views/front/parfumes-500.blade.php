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
                            <p style="padding:0;">Добавьте 4 парфюма в корзину и 1 из них будет в <strong>подарок</strong></p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- woman parfumes 500 -->
        <section class="product">
            <div class="product__header" id="woman500">
                <div class="wrapper sample-title">
                    <h2>
                        Женские 500 мл&nbsp; &nbsp;

                        <a href="#man500" class="product-card__button sex_button">
                            перейти к мужским
                        </a>
                    </h2>
                    <br/>
                    <div>Выберите <div class="basket-circle" style="position:relative; right:20px; margin: 0; right:0; top:7px; "><div class="horizontal-plus"></div><div class="vertical-plus"></div></div> свои парфюмы</div>
                </div>
            </div>

            <div class="product__list">
                <div class="wrapper">
                    <div class="product-list">

                        <div v-cloak v-for="product in productsVisible"
                            v-if="product.woman == 1 && product.show == 1 && product.volume == 500"
                            class="product-list__col">
                            @include('front.product-card')
                        </div>
                    </div>

                    <div id="show-more-woman500" class="product__header show-more-all" style="padding: 15px 0 15px;">
                        <div class="wrapper sample-title">
                            <h2>
                                <a @click="showMore(7)" class="product-card__button">
                                    <i class="fas fa-sync" style="margin-right: 10px;"></i> больше парфюмов
                                </a>
                            </h2>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <!-- woman parfumes 500 end -->

        <!-- man parfumes 500 -->
        <section class="product">
            <div class="product__header" id="man500">
                <div class="wrapper sample-title">
                    <h2>
                        Мужские 500мл&nbsp; &nbsp;

                        <a href="#woman500" class="product-card__button sex_button">
                            перейти к женским 500мл
                        </a>
                    </h2>
                    <br/>
                    <div>Выберите <div class="basket-circle" style="position:relative; right:20px; margin: 0; right:0; top:7px; "><div class="horizontal-plus"></div><div class="vertical-plus"></div></div> свои парфюмы</div>
                </div>
            </div>

            <div class="product__list">
                <div class="wrapper">
                    <div class="product-list">

                        <div v-cloak v-for="product in productsVisible"
                            v-if="product.man == 1 && product.show == 1 && product.volume == 500"
                            class="product-list__col">
                            @include('front.product-card')
                        </div>
                    </div>

                    <div id="show-more-man500" class="product__header show-more-all" style="padding: 15px 0 15px;">
                        <div class="wrapper sample-title">
                            <h2>
                                <a @click="showMore(8)" class="product-card__button">
                                    <i class="fas fa-sync" style="margin-right: 10px;"></i> больше парфюмов
                                </a>
                            </h2>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <!-- man parfumes 500 end -->

        @include('front.advantages')
        @include('front.eu-directive')

    </div>
    <!-- hide-navigation -->

    @include('front.customer-feedback')

@endsection

@section('footer')
    @include('front.footer')
@endsection
