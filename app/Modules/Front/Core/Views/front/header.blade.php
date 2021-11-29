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
        <a href="{{ route('language.update', ['ua']) }}"><img style="height:20px; border:1px solid silver; padding:1px;" src="/images/ua_icon.png"></a> &nbsp;
        <a href="{{ route('language.update', ['ru']) }}"><img style="height:20px; border:1px solid silver; padding:1px;" src="/images/ru_icon.png"></a>
    </div>

    <div style="border-bottom: solid 1px #cccccc; margin-top: 20px;"></div>

    <ul style="margin-top: 15px;">
        <li><strong>{{__('Парфюмерия')}}</strong></li>
        <li><a href="{{ app()->getLocale() === 'ua' ? route('ua.front.index') : route('front.index') }}#woman">{{ __('Женская') }}</a></li>
        <li><a href="{{ app()->getLocale() === 'ua' ? route('ua.front.index') : route('front.index') }}#man">{{ __('Мужская') }}</a></li>

        <li v-if="countGel > 0"><strong>{{__('Парфюмированные гели для душа')}}</strong></li>
        <li v-if="countGel > 0"><a href="{{ app()->getLocale() === 'ua' ? route('ua.front.index') : route('front.index') }}#gel">{{ __('Женские гели') }}</a></li>
        <li v-if="countGel > 0"><a href="{{ app()->getLocale() === 'ua' ? route('ua.front.index') : route('front.index') }}#gel">{{ __('Мужские гели') }}</a></li>

        <li v-if="countAuto > 0"><a href="{{ app()->getLocale() === 'ua' ? route('ua.front.index') : route('front.index') }}#auto">{{ __('Автопарфюмы') }}</a></li>
        <li v-if="countSeptics > 0"><a href="{{ app()->getLocale() === 'ua' ? route('ua.front.index') : route('front.index') }}#septics">{{ __('Антисептики') }}</a></li>

        <li v-if="countMan500 || countWoman500" ><strong>Годовой запас парфюма 500мл</strong></li>
        <li v-if="countWoman500"><a href="{{ app()->getLocale() === 'ua' ? route('ua.front.index') : route('front.index') }}#woman500">{{ __('Женская парфюмерия') }}</a></li>
        <li v-if="countMan500"><a href="{{ app()->getLocale() === 'ua' ? route('ua.front.index') : route('front.index') }}#man500">{{ __('Мужская парфюмерия') }}</a></li>

    </ul>

    <!-- !!! временно отключен фильтр по брендам. включить - раскомментировать весь <ul> ... <li скрыть список> оставить закомментированным-->
    {{--<ul style="margin-top: 15px;">
        <li>
            <a href="javascript:void(0)" @click="toggleFilter()">{{ __('Фильтр по брендам') }}
                <span v-if="showFilter" style="color: #7e7e7e; margin-left: 10px; font-size: 18px;">-</span>
                <span v-else  style="color: #7e7e7e;  margin-left: 10px; font-size: 18px;">+</span>
            </a>
        </li>
        <!--<li v-if="showFilter"><a href="javascript:void(0)" @click="toggleFilter()">{{ __('скрыть список') }}</a></li>-->
    </ul>--}}

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

<header v-cloak v-if="basket.length === 0" class="header">

    <div style="display: flex; justify-content: center; align-items: center; align-self: center; margin: auto auto;">
        <div class="hide-mobile-white-logo">
            <a href="{{ route('front.index') }}"><img style="max-width:120px; " src="/images/pdparis-white-logo.png"></a>
        </div>

        {{--<div class="parfum-panel" v-cloak @click="openParfumMan()">
            <div class="text_desktop"><a class="product-card__button sex_button">{{__('хочу бесплатный подбор аромата ')}} {{__('аромастилистом')}}</a></div>

            <a class="product-card__button sex_button button_mobile">
                <span>{{__('хочу бесплатный подбор аромата ')}}</span>
                {{__('аромастилистом')}}
            </a>
        </div>--}}

        <div class="parfum-panel" v-cloak>
            <div class="text_desktop">
                <a href="tel:0800334869" >
                    <span style="padding: 0 30px; margin: auto; font-size: 24px;">0&nbsp;800&nbsp;33&nbsp;48&nbsp;69</span>
                </a>
            </div>

            <a href="tel:0800334869" class="button_mobile">
                <span style="padding: 0 30px; margin: auto; font-size: 21px;">0&nbsp;800&nbsp;33&nbsp;48&nbsp;69</span>
            </a>
        </div>

        <p class="hide-mobile-advanced-aromas">{{__('улучшенные версии ароматов')}}</p>
    </div>

</header>

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
