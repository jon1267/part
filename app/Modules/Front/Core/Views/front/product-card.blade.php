<div class="product-card">
    <div class="product-card__volume" style="margin: 15px 0 0 20px;">@{{ product.volume }} мл</div>
    <div class="product-card__img">
        <div style="display: flex;">
            <a :href="['{{ (app()->getLocale() === 'ua' ? '/ua' : '') }}/product/'+product.slug+'_'+product.art+'.html']" >
                <img v-if="product.img" :src="[ product.img + '?5']" :alt="product.analog">
            </a>
        </div>
    </div>


    <div class="product-card__info-wrapper">
        <div class="product-card__info">

            <a :href="['/product/'+product.slug+'_'+product.art+'.html']" >
                <div class="product-name">
                    <strong>@{{ product.bname }}</strong><br/>
                    @{{ product.name }}
                </div>
            </a>

            <div class="product-card__number">
                <div class="product-card__number-icon">
                    <span>
                        <!-- @{{ product.name }} -->
                    </span>
                </div>
            </div>


            <a :href="['{{ (app()->getLocale() === 'ua' ? '/ua' : '') }}/product/'+product.slug+'_'+product.art+'.html']" >
                <div class="product-card__price">
                    <div class="product-card__price-col active">
                        <span>@{{ product.price }}.<sup>00</sup></span>
                    </div>
                    <span class="product-card__price-text">&nbsp; &nbsp; {{ $valuta }}</span>
                </div>
            </a>

            <div v-if="product.variants">
                <a @click="setVolumeCard(product, 30)"  class="vol-button" :class="[product.volume == 30 ? 'vol-active' : '']"> 30 мл </a>
                <a @click="setVolumeCard(product, 50)"  class="vol-button" :class="[product.volume == 50 ? 'vol-active' : '']"> 50 мл </a>
                <a @click="setVolumeCard(product, 100)" class="vol-button" :class="[product.volume == 100 ? 'vol-active' : '']"> 100 мл </a>
            </div>

            <a :href="['/product/'+product.slug+'_'+product.art+'.html']" >
                <div class="product-card__description">
                    {{ __('Основные аккорды:') }} <b>@{{ product.filter2 }}</b>
                </div>
            </a>

        </div>

        <div class="card-button" style="margin-bottom: 10px;">
            <a class="card-link"
               :href="['{{ (app()->getLocale() === 'ua' ? '/ua' : '') }}/product/'+product.slug+'_'+product.art+'.html']">
                {{ __('Карточка товара') }}
            </a>
        </div>

        <div @click="switcherCart(product, $event)" class="card-button">
            <div
                v-if=" ! hasInBasket(product.art)"
                class="basket-circle"
            >
                <div class="horizontal-plus"></div>
                <div class="vertical-plus"></div>
            </div>

            <div v-if="hasInBasket(product.art)" class="checkmark">
                <div class="checkmark-stem"></div>
                <div class="checkmark-kick"></div>
            </div>

            <div v-if="hasInBasket(product.art)" class="added">{{ __('Добавлено') }}</div>
            <div v-if=" ! hasInBasket(product.art)" class="add">{{ __('Добавить') }}</div>
        </div>


    </div>
</div>
