<section class="advantages">
    <div class="wrapper">
        <div class="advantages__inner">
            <div class="advantages__row">
                <div class="advantages__col">
                    <div class="advantages-card">
                        <div class="advantages-card__img">
                            <img src="/images/advantages_1.png" alt="" class="desktop">
                            <img src="/images/advantages_1_mobile.png" alt="" class="mobile">
                        </div>
                        <div class="advantages-card__info">
                            <div class="advantages-card__text">
                                {{ __('Французские эссенции и масла высочайшего качества.') }}
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
                            <img src="/images/advantages_2.png" alt="" class="desktop">
                            <img src="/images/advantages_2_mobile.png" alt="" class="mobile">
                        </div>
                        <div class="advantages-card__info">
                            <div class="advantages-card__text">
                                {{ __('Проработанные формулы для максимального сходства ароматов.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="advantages__col">
                    <div class="advantages-card">
                        <div class="advantages-card__img">
                            <img src="/images/advantages_3.png" alt="" class="desktop">
                            <img src="/images/advantages_3_mobile.png" alt="" class="mobile">
                        </div>
                        <div class="advantages-card__info">
                            <div class="advantages-card__text">
                                {{ __('Без парабенов, парафинов, красителей, фталатов, силиконов, минеральных масел, и других опасных веществ.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="advantages__col">
                    <div class="advantages-card">
                        <div class="advantages-card__img">
                            <img src="/images/advantages_4.png" alt="" class="desktop">
                            <img src="/images/advantages_4_mobile.png" alt="" class="mobile">
                        </div>
                        <div class="advantages-card__info">
                            <div class="advantages-card__text">
                                @if(config('app.host') === '1')
                                    {{ __('Быстрая Доставка "Новая Почта" за 1-2 дня в любую точку Украины.') }}
                                @elseif(config('app.host') === '2')
                                    {{ __('Быстрая Доставка службой доставки за 1-2 дня в любую точку России.') }}
                                @endif

                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="info__inner">
                <div class="text">
                    <p class="instagram-box__title text-center">О Нас</p>
                    <p style="text-align: justify">Наша компания работает с 2007 года, являемся прямым партнером одного из самых крупных и авторитетных производителей парфюмерии Франции, расположенном в городе Грасс — мировой столице производителей брендовых духов.

                    Работаем исключительно на качество, сервис и максимальный уровень удовлетворенности наших клиентов, потому что довольные клиенты — это залог успеха. Помимо ритейла, снабжаем оптом крупные парфюмерные компании страны.

                    <br>У нас самые доступные цены на рынке, при лучшем качестве!</p>
                </div>
            </div>
        </div>
    </div>
</section>
