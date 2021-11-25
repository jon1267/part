<!-- tap version antiseptics -->

<section class="product">
    <div class="product__header" id="auto">
        <div class="wrapper sample-title">
            <h2 class="font-weight-400">
                {{ __('Автопарфюмы') }}&nbsp; &nbsp;

                {{--<a href="#septics" class="product-card__button sex_button">
                    {{ __('перейти к Антисептикам') }}
                </a>--}}
            </h2>
            <br/>
            <div>{{ __('Выберите') }} <div class="basket-circle" style="position:relative; right:20px; margin: 0; right:0; top:7px; "><div class="horizontal-plus"></div><div class="vertical-plus"></div></div> {{ __('свои парфюмы') }}</div>
        </div>
    </div>

    <div class="product__list">
        <div class="wrapper">
            <div class="product-list">

                <div v-cloak v-for="product in products"
                     v-if="product.category == 10 && product.show == 1"
                     class="product-list__col">
                     @include('front.product-card')
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ...antiseptics -->

