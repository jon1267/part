<!-- tap version antiseptics -->

<section class="product">
    <div class="product__header" id="septics">
        <div class="wrapper sample-title">
            <h2 class="font-weight-400">
                Антисептики&nbsp; &nbsp;

                <a href="#auto" class="product-card__button sex_button">
                    перейти к автопарфюмам
                </a>
            </h2>
            <br/>
            <div>Выберите <div class="basket-circle" style="position:relative; right:20px; margin: 0; right:0; top:7px; "><div class="horizontal-plus"></div><div class="vertical-plus"></div></div> свои парфюмы</div>
        </div>
    </div>

    <div class="product__list">
        <div class="wrapper">
            <div class="product-list">

                <div v-cloak v-for="product in products"
                     v-if="product.category == 9 && product.show == 1"
                     class="product-list__col">
                     @include('front.product-card')
                </div>
            </div>

            <!--<div style="display: flex; justify-content: flex-end; margin-top: 15px; width: 220px;">-->
            <!--</div>-->
            <div id="show-more-9" class="product__header show-more-all" style="padding: 15px 0 15px;">
                <div class="wrapper sample-title">
                    <h2>
                        <a @click="showMore(9)" class="product-card__button our_green">
                            <i class="fas fa-sync" style="margin-right: 10px;"></i> больше антисептиков
                        </a>
                    </h2>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ...antiseptics -->
