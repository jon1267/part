<!--<div class="header">
    <div class="online-pay" style="left: auto">
        <p style="font-size:16px;text-align:center;"><strong>Акция! </strong>Скидка 25% при оплате онлайн</p>
    </div>
</div>-->

<div class="toggle-top-menu" :class="[basket.length ? 'not-empty-card' : '' ]" title="Меню" >
    <!--<p class="toggle-top-menu-text">МЕНЮ</p>-->
    <i class="fas fa-bars fa-2x" style="margin: 0; padding: 0; line-height: 0.9;"></i>
</div>

<div class="navigation">

    <div>
        <p>{{ __('ГОРЯЧАЯ ЛИНИЯ') }}</p>
        @if(config('app.host') === '1')
            <p><a href="tel:0800334869">0 800 33 48 69</a></p>
        @elseif(config('app.host') === '2')
            <p><a href="tel:74993411849">7 499 341 18 49</a></p>
        @endif

    </div>

    <div style="position:absolute; right:10px; top:10px; cursor:pointer;">
        <i id="close-top-menu" class="far fa-times-circle fa-2x"></i>
    </div>

    <div style="border-bottom: solid 1px #cccccc; margin-top: 20px;"></div>

    <ul style="margin-top: 15px;">


        <li><a href="/#woman">{{ __('Женская парфюмерия') }}</a></li>
        <li><a href="/#man">{{ __('Мужская парфюмерия') }}</a></li>
        <!--<li><a href="#">Унисекс парфюмерия</a></li>-->
        <li v-if="countAuto > 0"><a href="/#auto">{{ __('Автопарфюмы') }}</a></li>
        <li v-if="countSeptics > 0"><a href="/#septics">{{ __('Антисептики') }}</a></li>

    </ul>

    <ul style="margin-top: 15px;">
        <li>
            <a href="javascript:void(0)" @click="toggleFilter()">{{ __('Фильтр по брендам') }}
                <i v-if="showFilter" class="far fa-minus-square" style="color: #7e7e7e; margin-left: 7px;"></i>
                <i v-else class="far fa-plus-square" style="color: #7e7e7e;  margin-left: 7px;"></i>
            </a>
        </li>
        {{--<li v-if="showFilter"><a href="javascript:void(0)" @click="toggleFilter()">{{ __('скрыть список') }}</a></li>--}}
    </ul>

    <div v-if="showFilter">

        <div style="border-bottom: solid 1px #cccccc; margin-top: 20px; margin-bottom: 20px;"></div>

        <p v-if="brandsSelected.length > 0"><strong>{{ __('Выбрано') }} @{{ brandsSelected.length }} бренд(ов)</strong></p>

        <button v-if="brandsSelected.length > 0" @click="clearBrands()" class="product-card__button sex_button " style="font-size: 12px; padding: 8px 30px; margin-bottom: 10px;">
            {{ __('Сбросить фильтр') }}
        </button>

        <div class="toggle-top-div-brands">

            <div v-for="(brand, index) in brands" class="dis-flex-align" style="margin-bottom:5px;">
                <input @click="setPosition(index, brand)" v-model="brandsPreSelected" class="toggle-top-check-box" type="checkbox" :id="['brand-'+index]" :value="brand">
                <label :for="['brand-'+index]">@{{ brand }}</label>
            </div>

        </div>

        <button v-show="brandsPreSelected.length > 0" @click="filterBrands()" href="#" class="product-card__button sex_button" id="filter-brands-button" style="font-size: 12px; padding: 8px; position: absolute; width:100px; z-index:100; opacity:0.85;">
            {{ __('Фильтровать') }}
        </button>

    </div>

</div>

<div class="overlay-black"></div>

<header @click="openBasket()" v-cloak v-if="basket.length > 0" class="header">


    <div class="left-panel" style="">
        {{ __('В корзине:') }} @{{ basket.length }}

    </div>


    <div v-if="basket.length === 0" class="right-panel">
        &nbsp;
    </div>

    <div v-if="basket.length > 0" @click="openBasket()" class="right-panel">
        {{ __('Продолжить') }}
    </div>


</header>
