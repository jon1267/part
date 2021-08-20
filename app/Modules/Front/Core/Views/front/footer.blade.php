<? if (strpos($_SERVER['REQUEST_URI'], 'compare.html') OR strpos($_SERVER['REQUEST_URI'], 'about.html')) { ?>
<section class="comments">
    <div class="wrapper">
        <div class="comments__inner">
            <div class="comments__content">
                <div class="fb-comments" data-href="https://www.facebook.com/PD-Paris-%D0%A3%D0%BA%D1%80%D0%B0%D0%B8%D0%BD%D0%B0-104450154563865/" data-width="100%" data-numposts="5" data-order-by="reverse_time"></div>
            </div>
        </div>
    </div>
</section>
<? } ?>

<section id="footer" class="footer">
    <div class="footer-menu">
        <div class="wrapper">
            <div class="footer-menu__inner">
                <ul class="footer-menu__list">
                    <!-- <li class="footer-menu__item">
                        <a href="/contact.html" class="footer-menu__link">
                            Контакты
                        </a>
                    </li> -->
                    <!-- <li class="footer-menu__item">
                        <a href="/delivery.html" class="footer-menu__link">
                            Доставка и оплата
                        </a>
                    </li> -->
                    <li class="footer-menu__item">
                        <a href="{{ route('front.policy') }}" class="footer-menu__link">
                            Конфиденциальность
                        </a>
                    </li>
                    <li class="footer-menu__item">
                        <a href="{{ route('front.terms') }}" class="footer-menu__link">
                            Условия использования
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="footer-info">
        <div class="wrapper">
            <div class="footer-info__inner">
                <!--<div class="footer-info__button">
                        горячая линия
                    </div>
                    <a href="tel:0800334869" class="footer-info__phone">
                        0 800 33 48 69
                    </a> -->
                <div class="footer-info__time">
                    <!--c <b>9:00</b> до <b>21:00</b> <span>• БЕСПЛАТНО ПО УКРАИНЕ</span>
                        <br/>
                        <br/> -->
                    <?php
                    // <div class="text-center">
                    // 	<p><a href="mailto:support@pdparis-shop.com">support@pdparis-shop.com</a></p>
                    // 	<p>ФОП "Успешный Игорь Олегович", ЕГРПОУ 3119020313</p>
                    // 	<p>669006 г. Запорожье, ул. Добролюбова 12/29</p>
                    // </div>
                    ?>
                </div>
                <div class="footer-description">
                    <!-- <div class="footer-description__text">
                        ПОДПИСКА НА СПЕЦИАЛЬНОЕ ПРЕДЛОЖЕНИЕ <b>PDPARIS</b>
                    </div>
                    <form class="footer-description__wrapper">
                        <input v-model="email" name="subscribe" class="footer-description__input" placeholder="Введите Ваш е-мейл">
                        <button @click="subscribe($event)" type="submit" class="footer-description__button"></button>
                    </form> -->

                    <br/>
                    <br/>

                    <!--<div class="footer-description__text" style="text-align:center;">ООО "ИЗИМАРКЕТ" ИНН 42026686<br/>ул Криворожская 24-А,кв142</div>-->
                    <div class="footer-description__text" style="text-align:center;">PdParis</div>
                </div>




                <div class="footer-socials">
                    <div class="footer-socials__col">
                        <!-- <a target="_blank" href="https://www.facebook.com/PD-Paris-%D0%A3%D0%BA%D1%80%D0%B0%D0%B8%D0%BD%D0%B0-104450154563865/" class="footer-socials__icon footer-socials__icon--facebook">
                            <img src="/images/svg/sprite.svg#facebook" alt="facebook">
                        </a> -->
                    </div>
                    <div class="footer-socials__col">
                        <!-- <a target="_blank" href="https://twitter.com" class="footer-socials__icon footer-socials__icon--twitter">
                            <img src="/images/svg/sprite.svg#twitter" alt="twitter">
                        </a> -->
                    </div>
                    <div target="_blank" class="footer-socials__col">
                        <a target="_blank" href="https://www.instagram.com/pd_paris/" class="footer-socials__icon footer-socials__icon--instagram">
                            <img src="/images/svg/sprite.svg#instagram-white" alt="instagram">
                        </a>
                    </div>
                    <div >
                        <a target="_blank" href="/welcome"  class="btn-partners-program">
                            <i class="fas fa-dollar-sign fa-2x" style="margin-right: 7px;"></i>Партнерская программа
                        </a>
                    </div>
                    <div target="_blank" class="footer-socials__col">
                        <!-- <a target="_blank" href="https://youtube.com" class="footer-socials__icon footer-socials__icon--youtube">
                            <img src="/images/svg/sprite.svg#youtube" alt="youtube">
                        </a> -->
                    </div>
                    <div target="_blank" class="footer-socials__col">
                        <!-- <a target="_blank" href="https://vk.com" class="footer-socials__icon footer-socials__icon--vk">
                            <img src="/images/svg/sprite.svg#vk" alt="vk">
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--Модалки-->

<!--Корзина промокод-->
<div class="modal modal__cart-promocode">
    <div class="modal__wrapper modal-promocode">
        <div class="modal__close modal-promocode__close"></div>

        <div class="modal-promocode__header">
            <div class="modal-promocode__title">
                Ваша корзина
            </div>
        </div>

        <div v-if="basket.length === 0">
            <div class="modal-promocode__title">
                Ваша корзина пуста
            </div>
            <br/>
            <br/>
        </div>
        <div v-else>
            <!-- <div class="modal-promocode__stock"> -->
            <!-- <div class="modal-promocode__stock-title">
                Минимальный заказ 3 пробника
            </div> -->
            <!-- </div> -->
            <div style="font-size:14px; border:2px solid rgb(133, 84, 160); padding:10px; margin: 10px 30px; text-align:center;">
                <!--<p><strong>Акция!</strong><br/>Добавьте 4 парфюма в корзину и 1 из них будет в <strong>подарок</strong></p>-->
                <p><strong>Акция!</strong><br/>Парфюм 30 мл в подарок при заказе от 600 грн.</p>
            </div>

            <div class="modal-promocode-table">
                <div class="modal-promocode-table__header">
                    <div class="modal-promocode-table__col-img"></div>
                    <div class="modal-promocode-table__col-product">
                        товар
                    </div>
                    <div class="modal-promocode-table__col-price">
                        цена
                    </div>
                    <div class="modal-promocode-table__col-volume">
                        объем
                    </div>
                    <div class="modal-promocode-table__col-volume">
                        кол-во
                    </div>
                    <div class="modal-promocode-table__col-amount">
                        сумма
                    </div>
                    <div class="modal-promocode-table__col-close"></div>
                </div>
                <div class="modal-promocode-table__content" style="max-height: 350px; overflow-y: scroll;">


                    <div v-cloak v-for="(product, index) in basketVisible" class="modal-promocode-table__row">


                        <!-- <div v-cloak v-for="(product, index) in basket" class="modal-promocode-table__row"> -->
                        <div class="modal-promocode-table__col-img">
                            <img style="height:75px;" v-if="product.img" :src="product.img" alt="">
                        </div>
                        <div class="modal-promocode-table__col-product">
                            <span>@{{ product.name }}</span>
                        <!-- <div class="modal-promocode-table__text-small">@{{ product.art }}</div> -->
                            <!--Дубль объема для мобильной версии-->
                            <div class="modal-promocode-table__mobile-volume">
                                <span>@{{ product.volume }} </span> мл<br/>
                                <span>@{{ product.sale }} грн.</span>
                            </div>
                            <!--Дубль объема для мобильной версии конец-->
                            <div class="discount" v-if="product.discount">(@{{ product.discount }})</div>
                        </div>
                        <div class="modal-promocode-table__col-volume">
                            <span>@{{ product.sale }}</span>  грн.

                        </div>
                        <div class="modal-promocode-table__col-volume">
                            <span>@{{ product.volume }}</span> мл
                        </div>

                        <div class="modal-promocode-table__col-product">
                            <span class="minusCart" @click="minusCart(product)"> - </span>
                            <span>@{{ product.qty }}</span>
                            <span class="plusCart" @click="plusCart(product)"> + </span>
                        </div>

                        <div class="modal-promocode-table__col-amount">
                            <span>@{{ product.total }}</span> грн.
                        <!-- <div class="discount" v-if="product.discount">(@{{ product.discount }})</div> -->
                        </div>
                        <div class="modal-promocode-table__col-close">

                            <a @click="removeFromCart(product.art)" href="javascript:void(0)" class="modal-promocode-table__close">&nbsp;</a>
                        </div>
                    </div>

                </div>

                <!-- input promocode -->
                <div style="border-top: solid 1px #e5e5e5;"></div>

            <!-- <div v-if="promocodeIssue" style="text-align:center; color:red; font-size:14px;"><br/>@{{ promocodeIssue }}</div>
                    <div v-if="!order.procent" style="margin: 0 auto; display: flex; align-items: baseline; padding: 15px 30px; width:320px; padding-bottom:10px;">
                        <input type="text" v-model="order.promocode" class="modal-order__input feedback__input" placeholder="Ваш промокод" name="promocode" style="width:140px; margin-bottom:10px; font-size:14px; padding:10px; margin-right: 10px;">
                        <button :disabled="loading" @click="acceptPromocode($event)" type="submit" class="modal-order__btn feedback__btn" style="width:150px; background:#fff; color:rgb(133, 84, 160); font-size:14px; border:1px solid rgb(133, 84, 160); padding:10px;">
                            @{{ loading ? 'Пожалуйста, подождите...' : 'Применить' }}
                </button>
            </div> -->
                <!-- input promocode -->

                <div class="modal-promocode-table__total">
                    <!--Строки для мобильной версии-->
                    <div class="modal-promocode-table__total-row-mobile">
                        <div class="modal-promocode-table__text-mobile">
                            Товаров на сумму:
                        </div>
                        <div class="modal-promocode-table__text-mobile">
                            @{{ total }} грн.
                        </div>
                    </div>
                    <div class="modal-promocode-table__total-row-mobile">
                        <div class="modal-promocode-table__text-mobile">
                            Доставка:
                        </div>
                        <div class="modal-promocode-table__text-mobile">
                            на следующем шаге
                        </div>
                    </div>


                    <div class="modal-promocode-table__total-row">
                        <div class="modal-promocode-table__total-text">
                            ИТОГО:
                        </div>
                        <div class="modal-promocode-table__total-text-big">
                        <!--@{{ total }} грн.-->
                            <div class="discount" v-if="promoDiscount">@{{ promoDiscount }}</div>

                            <div class="discount-line" v-if="totalFull > total">@{{ totalFull }} грн.</div>

                            <div :class="[totalFull > total ? 'discount' : '' ]">@{{ total }} грн. </div>

                        <!-- <div class="discount" v-if="order.procent">Промокод: @{{ order.promocode }}</div> -->

                        </div>
                    </div>

                </div>
                <div class="modal-promocode-table__footer">
                    <div class="modal-promocode-table__footer-col-link">
                        <a @click="closeBasket()" href="javascript:void(0)" class="modal-promocode-table__footer-link">
                            Вернуться к выбору
                        </a>
                    </div>

                    <div v-if="! order.promocodeAccepted" class="modal-promocode-table__footer-col-promo">

                    </div>
                    <div class="modal-promocode-table__footer-col-btn">
                    <!-- <button v-if="basket.length < 3" @click="closeBasket()"  class="modal-promocode-table__btn">
								@{{ 'Добавьте еще ' + (3 - basket.length) }}
                        </button> -->

                        <button @click="checkout()"  class="modal-promocode-table__btn">
                            Перейти к оформлению
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Корзина промокод конец-->

<!--Оформление заказа-->
<div class="modal modal__order">
    <div class="modal__wrapper modal-order" style="max-width:600px;">
        <div class="modal__close modal-order__close"></div>
        <div class="modal-order__inner">
            <div class="modal-order__header">
                <h1>
                    Оформление заказа
                </h1>
            </div>

            <div class="modal-order__content">
                <form class="modal-order__row" name="modal-order-form">

                    <div v-if="step == 1" class="modal-order__col-payment width-100">

                        <div class="modal-order__payment-box">

                            <div>

                                <!--<div v-if="order.kindpay == 1" style="font-size:14px; line-height: 18px; border: 2px solid #54256e; margin-bottom:20px; padding: 10px; color:#7b419b;">
                                    <strong>ВНИМАНИЕ!</strong> На следующей странице Вам нужно будет оплатить <strong>только</strong> за товар, доставку мы берем на себя.
                                </div>-->

                                <center>
                                    <img style="width:150px; margin-bottom:10px;" src="/images/Vip_partner.jpg">
                                    <br/>
                                </center>

                                <div style="font-size:14px; line-height: 18px; margin-bottom:10px;"><span style="margin-right: 7px;">Шаг 1 :</span> Выберите способ оплаты</div>

                                <label v-if="order.kindpay != 2" class="modal-order__radiobutton">
                                    <input @click="clearIssue()" v-model="order.kindpay" class="modal-order__radiobutton-input" type="radio" name="kindpay" value="1" selected>
                                    <div class="modal-order__box"></div>
                                    <div class="modal-order__text">
                                        <b>Оплата онлайн</b> &nbsp;

                                        <div style="font-size:9px; text-transform:uppercase; border:1px solid #5676d5; padding:3px 5px; padding-bottom:1px; border-radius:10px; display:inline-block; color:#5676d5; font-weight:bold;">Выбор клиентов</div>
                                        <br/>


                                        <!--<div v-if="!order.kindpay">Выберите этот способ оплаты, и сэкономьте <span style="color:green; font-weight:bold;">40 грн.</span> <span style="font-weight:bold;">на каждом</span> флаконе. Ваша цена <span style="color:green; font-weight:bold;">139 грн</span> за флакон.</div>-->
                                        <div v-if="!order.kindpay">Выберите этот способ оплаты, и получите <span style="color:green; font-weight:bold;">10% скидку </span> на весь заказ <span style="font-weight:bold;">дополнительно.</span> </div>

                                    </div>
                                </label>

                                <label v-if="order.kindpay != 1"  class="modal-order__radiobutton">
                                    <input @click="clearIssue()" v-model="order.kindpay" class="modal-order__radiobutton-input" type="radio" name="kindpay" value="2">
                                    <div class="modal-order__box"></div>
                                    <div class="modal-order__text">
                                        <b>Оплата при получении</b><br/>
                                        <div>При выборе этого способа доставки, Вы получаете стандартную цену.</div>
                                    </div>
                                </label>

                                <a
                                    v-if="order.kindpay"
                                    @click="clearKindPay();"
                                    href="javascript:void(0)"
                                    style="font-size:13px; text-decoration: underline; color:#333; padding:0px 35px;">
                                    Изменить выбор
                                </a>

                                <!--<div
                                    v-if="!order.kindpay"
                                    style="font-size:14px; line-height: 18px; border: 2px solid rgb(133 84 160); margin-bottom:20px; margin-top:40px; padding: 10px; color:rgb(133 84 160);">
                                    Рекомендуем выбрать самый популярный среди клиентов способ «<strong>Оплата онлайн</strong>», чтобы сэкономить 40 грн на каждом флаконе
                                </div>-->


                                <div v-if="order.kindpay">

                                    <div v-if="order.kindpay == 1" style="font-size:14px; line-height: 18px; border: 2px solid rgb(133 84 160); margin-bottom:20px; margin-top:40px; padding: 10px; color:black;">
                                        Выбрана онлайн оплата. Ваша экономия = <span style="color:green; font-weight:bold;">@{{ totalEconomy }} грн.</span>
                                    </div>

                                    <div style="border-bottom: solid 1px #e6e6e6; width: 100%; margin-bottom: 20px; margin-top:20px;"></div>

                                    <div style="font-size:14px; line-height: 18px; margin-bottom:10px;"><span style="margin-right: 7px;">Шаг 2 :</span> Выберите способ доставки</div>

                                    <label v-if="order.pay != 'Курьером'" class="modal-order__radiobutton">
                                        <input @click="clearIssue(); setStep(2)" v-model="order.pay" class="modal-order__radiobutton-input" type="radio" name="modal-order-payment" value="Отделение" selected>
                                        <div class="modal-order__box"></div>
                                        <div class="modal-order__text">
                                            <b>На отделение </b><br/>
                                            Доставка на отделение Новая Почта в Вашем населенном пункте.
                                            <div v-if="order.kindpay == 1"><strong>Стоимость доставки: 40 грн</strong></div>
                                            <div v-if="order.kindpay == 2"><strong>Стоимость доставки: 60 грн</strong></div>
                                        </div>
                                    </label>

                                    <label v-if="order.pay != 'Отделение'" class="modal-order__radiobutton">
                                        <input @click="clearIssue(); setStep(2)" v-model="order.pay" class="modal-order__radiobutton-input" type="radio" name="modal-order-payment" value="Курьером">
                                        <div class="modal-order__box"></div>
                                        <div class="modal-order__text">
                                            <b>Курьером</b><br/>
                                            Адресная доставка курьером Новая Почта
                                            <div v-if="order.kindpay == 1"><strong>Стоимость доставки: 60 грн</strong></div>
                                            <div v-if="order.kindpay == 2"><strong>Стоимость доставки: 80 грн</strong></div>
                                        </div>
                                    </label>

                                    <a v-if="order.pay" @click="clearPay();" href="javascript:void(0)"  style="font-size:13px; text-decoration: underline; color:#333; padding:0px 35px; ">
                                        Изменить выбор
                                    </a>

                                </div>

                                <br/>


                                <div class="modal-order__confirm-box">
                                    <button v-if="order.pay && order.kindpay && step == 1" @click="step = 2" type="submit" class="modal-order__btn feedback__btn">
                                        Далее
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>


                    <div v-if="step == 2" class="modal-order__col-contacts" style="width:100%;">

                        <br/>

                        <a @click="step = 1" href="javascript:void(0)"  style="font-size:15px; text-decoration: underline; color:#333;">
                            <center>Изменить способ доставки</center>
                        </a>

                        <br/>

                        <div style="font-size:14px; line-height: 18px; margin-bottom:10px;">Введите ваши контактные данные: </div>

                        <div v-if="order.kindpay != 1" style="display: flex; margin-bottom: 20px;">
                            <input type="checkbox" v-model="order.nocall" id="nocall" name="nocall" style="height: 23px; width: 23px;">
                            <div class="modal-order__text">Мне не звонить</div>
                        </div>

                        <input type="tel" v-mask="'+38 (###) ###-##-##'" v-model="order.phone" class="modal-order__input feedback__input" placeholder="Ваш телефон" name="modal-order-phone">

                        <input  v-model="order.email" class="modal-order__input feedback__input" placeholder="Email" name="email">

                        <input  v-model="order.name" class="modal-order__input feedback__input" placeholder="Имя" name="name">

                        <input v-if="order.nocall || order.kindpay == 1" v-model="order.lastname" class="modal-order__input feedback__input" placeholder="Фамилия" name="lastname">

                        <input v-if="order.pay == 'Курьером'" v-model="order.prelastname" class="modal-order__input feedback__input" placeholder="Отчество" name="prelastname">


                        <div v-if="!order.nocall && order.kindpay != 1" style="font-size:14px; line-height: 15px; margin-bottom:20px;"> <span style="color: red;">*</span> - обязательное поле только телефон</div>


                        <!--<div v-if="order.lastname">-->
                        <div v-if="order.nocall || order.kindpay == 1">

                            <!--<input type="tel" v-mask="'+38 (###) ###-##-##'" v-model="order.phone" class="modal-order__input feedback__input" placeholder="Ваш телефон" name="modal-order-phone">-->

                            <div class="vue-suggestion">
                                <input
                                    v-if="order.pay == 'Оплата онлайн' || order.pay == 'Отделение' || order.pay == 'Курьером'"
                                    v-model="order.city"
                                    placeholder="Город или населенный пункт"
                                    name="city"
                                    class="city"
                                    @input='evt => searchCities(order.city=evt.target.value)'
                                    @focus="showCities = true"
                                >
                                <div v-if="order.city && showCities && citiesFiltered.length > 0" class="vs__list">
                                    <div @click="setCity(row)" v-for="row in citiesFiltered" class="vs__list-item">@{{ row.name }}</div>
                                </div>
                            </div>

                            <div style="color:red;" class="city-issue"></div>

                            <div class="vue-suggestion">
                                <input
                                    v-if="order.pay == 'Отделение' && order.cityId"
                                    v-model="order.office"
                                    placeholder="Отделение 'Новая Почта'"
                                    name="office"
                                    class="office"
                                    @input='evt => searchOffices(order.office=evt.target.value)'
                                    @focus="showOffices = true"
                                >
                                <div v-if="showOffices && officesFiltered.length > 0" class="vs__list">
                                    <div @click="setOffice(row)" v-for="row in officesFiltered" class="vs__list-item">@{{ row.name_ua }}</div>
                                </div>

                                <div v-if="offices.length == 0 && order.cityId && order.pay == 'Отделение'" class="vs__list">
                                    <div class="vs__list-item">Нет отделений</div>
                                </div>
                            </div>

                            <input v-if="order.pay == 'Оплата онлайн'" v-model="order.office" class="modal-order__input feedback__input" placeholder="Отделение 'Новой Почты'" name="office">


                            <div class="vue-suggestion">
                                <input
                                    v-if="order.pay == 'Курьером' && order.cityId"
                                    v-model="order.street"
                                    placeholder="Улица"
                                    name="street"
                                    class="street"
                                    @focus="showStreets = true"
                                >
                            </div>

                            <div class="vue-suggestion">
                                <input
                                    v-if="order.pay == 'Курьером' && order.street"
                                    v-model="order.house"
                                    placeholder="Номер дома"
                                    name="house"
                                    class="house"
                                    @focus="showHouses = true"
                                >
                            </div>

                            <div style="color:red;" class="postindex-issue"></div>


                            <input v-if="order.pay == 'Курьером' && order.street" v-model="order.flat" class="modal-order__input feedback__input" placeholder="Квартира" name="flat">

                        </div>

                        <!-- <textarea v-if="order.pay == 'Наложенный платеж'" v-model="order.comment" class="modal-order__textarea feedback__textarea" placeholder="Комментарии к заказу" name="modal-order-message"></textarea> -->

                        <br/>

                        <div class="modal-order__confirm-box">
                            <!-- <div class="modal-order__text-small">
                                Нажимая на кнопку “Подтвердить”, вы даете согласие на обработку своих <a target="_blank" href="/policy.html">персональных данных</a>
                            </div> -->
                            <!-- :disabled="loading" -->
                            <button :disabled="loading" @click="acceptOrder($event)" type="submit" class="modal-order__btn feedback__btn">
                                @{{ loading ? 'Пожалуйста, подождите...' : 'Подтвердить' }}
                            </button>
                        </div>
                    </div>


                </form>
            </div>
            <!-- <div class="modal-order__footer">
                <a target="_blank" href="/delivery.html" class="modal-order__footer-link">
                    Доставка и оплата
                </a>
                <a target="_blank" href="/terms.html" class="modal-order__footer-link">
                    Условия использования
                </a>
            </div> -->
        </div>
    </div>
</div>
<!--Оформление заказа конец-->

<!--</div>-->

<!--Модалки конец-->

