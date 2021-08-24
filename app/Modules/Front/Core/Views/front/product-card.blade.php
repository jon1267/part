<div class="product-card">

    <!--<div v-if="product.new == 1" class="product-card__label-new">
        <span>
            new
        </span>
    </div>
    <div v-if="product.best == 1" class="product-card__label-bestseller">
        BESTSELLER
    </div>
    <div v-if="product.hit == 1" class="product-card__label-niche">
        niche
    </div>-->

    <div class="product-card__volume" style="margin: 15px 0 0 20px;">@{{ product.volume }} мл</div>


    <div class="product-card__img">

        <div style="display: flex;">

            <!--<div style="margin-top: 100px;">-->
            <div v-if="product.arrow">
                <button @click="prevProductInGroup(group)" class="product-card-arrow arrow-right"><i class="fas fa-chevron-left" style="color: #c2c2c2; z-index:100;"></i></button>
            </div>

            <a :href="['/product/'+product.slug+'_'+product.art+'.html']" >
                <img v-if="product.img" :src="[ product.img + '?2']" :alt="product.analog">
            </a>

            <!--<div style="margin-top: 100px;">-->
            <div v-if="product.arrow">
                <button @click="nextProductInGroup(group)" class="product-card-arrow arrow-left"><i class="fas fa-chevron-right" style="color: #c2c2c2; z-index:100;"></i></button>
            </div>

        </div>

    </div>


    <div class="product-card__info-wrapper">
        <div class="product-card__info">

            <a :href="['/product/'+product.slug+'_'+product.art+'.html']" >

                <strong>@{{ product.bname }}</strong><br/>
                @{{ product.name }}

            </a>

            <div class="product-card__number">
                <div class="product-card__number-icon">
                    <span>
                        <!-- @{{ product.name }} -->
                    </span>
                </div>
            </div>


            <a :href="['/product/'+product.slug+'_'+product.art+'.html']" >
                <div class="product-card__price">
                    <div class="product-card__price-col active">
                        <span>@{{ product.price }}.<sup>00</sup></span>
                    </div>
                    <span class="product-card__price-text">&nbsp; &nbsp; {{ $valuta }}</span>
                </div>
            </a>


            <a :href="['/product/'+product.slug+'_'+product.art+'.html']" >

                <div class="product-card__description">
                    Основные аккорды: <b>@{{ product.filter2 }}</b>
                </div>

            </a>

        </div>

        <!-- <form class="product-card__controllers">
                <button @click="addToCart(product, $event)" type="submit" class="product-card__button">
                @{{ hasInBasket(product.art) ? 'Добавлено в корзину' : 'В корзину' }}
            </button>
        </form> -->

        <div class="card-button" style="margin-bottom: 10px;">
            <!--<a class="card-link" href="/product/shanel_w068.html">Карточка товара</a>-->
            <a class="card-link"
               :href="['/product/'+product.slug+'_'+product.art+'.html']">
                Карточка товара
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

            <div v-if="hasInBasket(product.art)" class="added">Добавлено</div>
            <div v-if=" ! hasInBasket(product.art)" class="add">Добавить</div>
        </div>


    </div>
</div>
