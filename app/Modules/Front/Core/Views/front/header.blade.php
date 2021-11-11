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

    <div style="margin-top:20px; display: flex; align-items: center">
        <span style="margin-right: 3px; white-space: nowrap;">{{__('Выберите язык:')}}</span>
        <a href="{{ route('language.update', ['ru']) }}"><img style="height:20px; border:1px solid silver; padding:1px;" src="/images/ru_icon.png"></a> &nbsp;
        <a href="{{ route('language.update', ['ua']) }}"><img style="height:20px; border:1px solid silver; padding:1px;" src="/images/ua_icon.png"></a>
    </div>

    <div style="border-bottom: solid 1px #cccccc; margin-top: 20px;"></div>

    <ul style="margin-top: 15px;">
        <li><a href="{{ app()->getLocale() === 'ua' ? route('ua.front.index') : route('front.index') }}#woman">{{ __('Женская парфюмерия') }}</a></li>
        <li><a href="{{ app()->getLocale() === 'ua' ? route('ua.front.index') : route('front.index') }}#man">{{ __('Мужская парфюмерия') }}</a></li>
        <!--<li><a href="#">Унисекс парфюмерия</a></li>-->
        <li v-if="countAuto > 0"><a href="{{ app()->getLocale() === 'ua' ? route('ua.front.index') : route('front.index') }}#auto">{{ __('Автопарфюмы') }}</a></li>
        <li v-if="countSeptics > 0"><a href="{{ app()->getLocale() === 'ua' ? route('ua.front.index') : route('front.index') }}#septics">{{ __('Антисептики') }}</a></li>
    </ul>

    <ul style="margin-top: 15px;">
        <li>
            <a href="javascript:void(0)" @click="toggleFilter()">{{ __('Фильтр по брендам') }}
                {{--<i v-if="showFilter" class="fas fa-minus" style="color: #7e7e7e; margin-left: 10px;"></i>
                <i v-else class="fas fa-plus" style="color: #7e7e7e;  margin-left: 10px;"></i>--}}
                <span v-if="showFilter" style="color: #7e7e7e; margin-left: 10px; font-size: 18px;">-</span>
                <span v-else  style="color: #7e7e7e;  margin-left: 10px; font-size: 18px;">+</span>
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

        <!--<button v-if="brandsPreSelected.length > 0 && brandsSelected.length === 0" @click="filterBrands()" class="product-card__button sex_button " style="font-size: 12px; padding: 8px 30px; margin-bottom: 10px;">
            {{ __('Фильтровать') }}
        </button>-->

        <div class="toggle-top-div-brands">

            <div v-for="(brand, index) in brands" class="dis-flex-align" :id="['wrap-brand-'+index]" style="margin-bottom:5px;">
                <input @click="setPosition(index, brand)" v-model="brandsPreSelected" class="toggle-top-check-box" type="checkbox" :id="['brand-'+index]" :value="brand">
                <label :for="['brand-'+index]">@{{ brand }}</label>
            </div>

        </div>

    </div>

</div>

<button @click="filterBrands()" class="hide-button" id="filter-brands-button"></button>
<div class="overlay-black"></div>

<header @click="openBasket()" v-cloak v-if="basket.length > 0" class="header">
    <div v-cloak class="left-panel">
        {{ __('В корзине:') }} @{{ basket.length }}
    </div>

    <div v-cloak v-if="basket.length === 0" class="right-panel">
        &nbsp;
    </div>

    <div v-cloak v-if="basket.length > 0" @click="openBasket()" class="right-panel">
        {{ __('Продолжить') }}
    </div>
</header>
