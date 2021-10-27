<section class="advantages">
    <div class="wrapper">
        <div class="advantages__inner">
            <div class="advantages__row">
                <div class="advantages__col">
                    <div class="advantages-card">
                        <div class="advantages-card__img">
                            <!--<img src="/images/advantages_1_old.png" alt="" class="desktop">-->
                            <!--<img src="/images/advantages_1_mobile_old.png" alt="" class="mobile">-->
                            <img src="/images/advantages_1.png" alt=""  class="desktop h-125">
                            <img src="/images/advantages_1_mobile.png" alt="" class="mobile h-30">
                        </div>
                        <div class="advantages-card__info">
                            <div class="advantages-card__text">
                                {{-- __('Французские эссенции и масла высочайшего качества.') --}}
                                {{ __('Качественные эссенции и масла из французского города Грасс.') }}
                            </div>
                            <!-- <a target="_blank" href="/about.html" class="advantages-card__btn">
                                Подробнее
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="advantages__col">
                    <div class="advantages-card">
                        <div class="advantages-card__img">
                            <!--<img src="/images/advantages_2_old.png" alt="" class="desktop">-->
                            <!--<img src="/images/advantages_2_mobile_old.png" alt="" class="mobile">-->
                            <img src="/images/advantages_2.png" alt=""  class="desktop h-125">
                            <img src="/images/advantages_2_mobile.png" alt="" class="mobile h-30">
                        </div>
                        <div class="advantages-card__info">
                            <div class="advantages-card__text">
                                {{-- __('Проработанные формулы для максимального сходства ароматов.') --}}
                                {{ __('Улучшенные формулы известных парфюмерных композиций.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="advantages__col">
                    <div class="advantages-card">
                        <div class="advantages-card__img">
                            <!--<img src="/images/advantages_3_old.png" alt="" class="desktop">-->
                            <!--<img src="/images/advantages_3_mobile_old.png" alt="" class="mobile">-->
                            <img src="/images/advantages_3.png" alt="" class="desktop h-125">
                            <img src="/images/advantages_3_mobile.png" alt="" class="mobile h-30">
                        </div>
                        <div class="advantages-card__info">
                            <div class="advantages-card__text">
                                {{-- __('Без парабенов, парафинов, красителей, фталатов, силиконов, минеральных масел, и других опасных веществ.') --}}
                                {{ __('Безопасные компоненты: в составе отсутствуют парабены, парафины, красители, фталаты, силиконы, минеральные масла и другие опасные вещества.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="advantages__col">
                    <div class="advantages-card">
                        <div class="advantages-card__img">
                            <!--<img src="/images/advantages_4_old.png" alt="" class="desktop">-->
                            <!--<img src="/images/advantages_4_mobile_old.png" alt="" class="mobile">-->
                            <img src="/images/advantages_4.png" alt="" class="desktop h-125">
                            <img src="/images/advantages_4_mobile.png" alt="" class="mobile h-30">
                        </div>
                        <div class="advantages-card__info">
                            <div class="advantages-card__text">
                                @if(config('app.host') === '1')
                                    {{ __('Быстрая доставка по Украине Новой Почтой или Укрпочтой за 1-2 дня.') }}
                                @elseif(config('app.host') === '2')
                                    {{ __('Быстрая Доставка службой доставки в любую точку России.') }}
                                @endif

                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="info__inner">
                <div class="text">
                    <p class="instagram-box__title text-center">О Нас</p>
                    <p style="text-align: justify">{{ __('PdParis — парфюмерная компания, которая с 2018 года предлагает своим клиентам улучшенные версии известных композиций.')}}
                        {{ __('В составе нашей продукции только качественные и натуральные компоненты, которые доставляются на производство прямиком из французского города Грасс.')}}</p>
                    <p style="text-align: justify">{{ __('Наша цель — вывести на рынок качественный нишевый парфюм по доступной цене. А лучшая гарантия качества — база наших постоянных клиентов, которая насчитывает уже более 100 000 довольных покупателей.') }}</p>
                    <p style="text-align: justify">{{ __('В составе нашей продукции отсутствуют парабены, парафины, красители, фталаты, силиконы, минеральные масла и другие опасные вещества.') }}
                        {{ __('Наши парфюмы не вызывают аллергию, головную боль и не предоставляют дискомфорт. А также наши парфюмы не тестируются на животных.') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
