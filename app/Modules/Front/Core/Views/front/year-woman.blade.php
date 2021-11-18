<!-- tap version Year set woman parfumes 500 ml -->
<section class="product">
    <div class="product__header" id="woman500">
        <div class="wrapper sample-title">
            <h2 class="font-weight-400">
                {{ __('Годовай запас парфюма 500 мл') }}&nbsp; &nbsp;<br />
                {{ __('Женская парфюмерия') }}

                <a href="#man500" class="product-card__button sex_button">
                    {{ __('перейти к Мужским 500мл') }}
                </a>
            </h2>
            <br/>
            <div>{{ __('Выберите') }} <div class="basket-circle" style="position:relative; right:20px; margin: 0; right:0; top:7px; "><div class="horizontal-plus"></div><div class="vertical-plus"></div></div> {{ __('свои парфюмы') }}</div>
        </div>
    </div>

    <div class="product__list">
        <div class="wrapper">
            <div class="product-list">

                <div v-cloak v-for="product in products"
                     v-if="((product.show && brandsSelected.length === 0) || (brandsSelected.length > 0 && brandsSelected.indexOf(product.bname) > -1 )) && product.woman500 == 1"
                     class="product-list__col">
                    @include('front.product-card')
                </div>
            </div>

            <div v-if="brandsSelected.length === 0">
                <div id="show-more-woman500" class="product__header" style="padding: 15px 0 15px;">
                    <div class="wrapper sample-title">
                        <h2>
                            <a @click="showMore('woman500')" class="product-card__button our_green show-more-all" >
                                <i class="fas fa-sync" style="margin-right: 10px;"></i> {{__('показать еще')}}
                            </a>
                        </h2>
                    </div>
                </div>
                <div id="more-background-woman500" style="height: 140px; overflow: hidden; position: relative; ">
                    @include('front.more-background')
                    <div style="z-index: 50; position: absolute; top: 10px; left: 0; height: 130px; width: 100%; background: linear-gradient(rgba(255,255,255,0), white);"></div>
                </div>
            </div>


        </div>
    </div>

</section>
<!-- tap version Year set parfumes 500 ml -->
