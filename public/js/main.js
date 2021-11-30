$(document).ready(function () {

    // Scroll top line on mobiles
    var scrollTopLine = function() {
      var fromTop = $(window).scrollTop();
      $('.header').toggleClass("scrolled", (fromTop > 10));
      $('.main-menu').toggleClass("scrolled-menu", (fromTop > 10));
    }

    scrollTopLine();

    $(window).on("scroll", function() {
      scrollTopLine();
    });

    $('input[type="tel"]').focus(function(){
        var that = this;
        setTimeout(function(){ that.selectionStart = that.selectionEnd = 10000; }, 0);
    });

    $('.toggle-top-menu').click(function(){
        $('.navigation').addClass('active');
        $('.overlay-black').show();
    });

    $('#close-top-menu').click(function(){
        $('.navigation').removeClass('active');
        $('.overlay-black').hide();
        $('#filter-brands-button').hide();
    });

    $('.overlay-black').click(function(){
        $('.navigation').removeClass('active');
        $('.overlay-black').hide();
    });

    function initCertificateSlider() {
        if ($('#certificateSlider').length > 0) {
            $('#certificateSlider').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                swipe: false,
                arrows: false,
                dots: false,
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            arrows: true,
                            dots: true,
                            swipe: true,
                        }
                    },
                ]
            });

        } else {
        }
    }

    function initMobileMenu() {
        $(".header__mobile-menu").on("click", function () {
            $(".main-menu").toggleClass("open");
        })
    }

    function closeModal() {
        $('.modal__close').on("click", function () {
            $(this).closest('.modal').removeClass('open');
            $('body').removeClass('hidden');
        })
    }

    function changePromocodeBoxPlaceholder() {
        $(window).resize(function () {
            if ($(window).width() < 768) {
                $('.modal-promocode-box__input').attr("placeholder", "Промокод");
            } else {
                $('.modal-promocode-box__input').attr("placeholder", "Есть промокод?");
            }
        });
    }

    function initInstagramSlider() {
        if ($('.instagram-box__slider').length > 0) {
            $('.instagram-box__slider').slick({
                slidesToShow: 4,
                arrows: true,
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            arrows: true,
                            dots: true,
                            swipe: true,
                        }
                    },
                ]
            });

        }
    }


    function initSelect() {
        $(".select select").select2({
            "width": "100%",
            minimumResultsForSearch: -1,
            placeholder: 'Фильтровать по...'
        });
    }

    function initSelectLanguage() {
        $(".main-menu__language select").select2({
            minimumResultsForSearch: -1,
            "width": "100%",
        });
    }

    initMobileMenu();
    closeModal();
    changePromocodeBoxPlaceholder();
    initCertificateSlider();
    initInstagramSlider();
    initSelect();
    initSelectLanguage();
});

if ($('.vue').length) {

    Vue.directive('mask', VueMask.VueMaskDirective);

    new Vue({
        el: '.vue',
        data: {
            step: 1,
            link: '',
            gclid: null,
            loading: false,
            email: '',
            analog: false,
            filter: '',
            filter2: '',
            basket: [],

            brandsPreSelected: [],
	        brandsSelected: [],
            products: [],
            product: {},
            contact: {
                type: '',
                name: '',
                email: '',
                message: '',
                answer: '',
            },
            order: {
                procent: 0,
                streetId: '',
                street: '',
                house: '',
                flat: '',
                name: '',
                lastname: '',
                prelastname: '',
                office: '',
                city: '',
                cityId: '',
                comment: '',
                phone: '+38 ',
                pay: null,
                kindpay: null,
                promocode: '',
                promocodeAccepted: false,
                promocodeInfo: '',
                nocall: 0,
                email: '',
                url: '',
                zip: '', // post index for search sdek office
                sdek_to: '', //choice sdek office for order delivery
            },

            promocodeIssue: '',

            compare: false,

            cities:[],
            citiesFiltered: [],

            offices:[],
            officesFiltered: [],

            streets:[],
            streetsFiltered: [],

            houses:[],
            housesFiltered: [],

            showCities: false,
            showOffices: false,
            showStreets: false,
            showHouses: false,

            showFilter: false,
            token: $('meta[name="csrf-token"]').attr('content'),
            host: parseInt($('meta[name="host"]').attr('content')),

            totalAction: 600,
            totalActionRu: 1200,

            productsNew: [],
            productsTop: [],

            parfumManRequest: false,
            phone: '', // for parfum Man Request
        },

        events: {
            filter: function () {
                this.filterBrands();
            }
        },

        mounted: function() {
            let that = this;
            window.addEventListener('hashchange', () => {
                if (window.location.hash === '') {
                    that.closeBasket();
                }
            });

            this.$cookies.config('30d');

            this.getSamples();

            let cookie = JSON.parse(this.$cookies.get('basket'));
            if (cookie) {
                this.basket = cookie;
            }

            let promocode = this.$cookies.get('promocode');
            if (promocode) {
                this.order.promocode = promocode;
                this.order.procent = this.$cookies.get('procent');
            }

            if ($('.thanks__inner').length) {
                this.basket = [];
                this.basketVisible = [];
                this.$cookies.remove('basket');
                this.$cookies.remove('promocode');
                this.$cookies.remove('procent');
            }

            if (this.host === 2) {
                this.order.phone = '';
            }
        },

        watch: {

        },

        computed: {

            brands: function () {
            	var list = [];
                var that = this;

            	 $.each(that.products, function (index, product) {
                    if (product.variants && list.indexOf(product.bname) < 0) {
                    	list.push(product.bname);
                    }
                });

                return list.sort();
            },

            productsVisible: function () {
                // var list = [];
                // var that = this;
                // var visible = [];
                //
                // $.each(that.products, function (index, product) {
                //     let added = false;
                //
                //     if ( ! visible[product.category]) {
                //         visible[product.category] = 0;
                //     }
                //
                //     if (product.show === 1) {
                //         visible[product.category]++;
                //     }
                //
                //     if (that.brandsSelected.length === 0) {
                //         list.push(product);
                //         added = true;
                //     }
                //
                //     if ( ! added && that.brandsSelected.indexOf(product.bname) >= 0) {
                //         product.show = 1;
                //         visible[product.category]++;
                //         list.push(product);
                //     }
                // });
                //
                // return list;
            },

            totalEconomy: function () {
                var total = 0;
                var that = this;
                $.each(that.basketVisible, function (index, product){
                    if (product.sale > 0) {
                        if (that.order.kindpay == 1) {
                            total += Math.round(product.price * 0.1) * product.qty;
                        }
                    }
                });

                return total;
            },

            promoDiscount: function () {
                return '';
            },

            total: function () {
                var total = 0;
                var that  = this;
                $.each(that.basketVisible, function (index, product) {
                    total += product.total;
                });

                // если оплата онлайн то еще 10% скидки
                if (that.order.kindpay == 1) {
                    total = total - (total * 0.1);
                }

                return Math.round(total);
            },

            totalFull: function () {
                var total = 0;
                var that = this;
                $.each(that.basketVisible, function (index, product){
                    total += (parseInt(product.price) * product.qty);
                });

                return total;
            },

            basketFormat: function () {
                let that = this;
                $.each(that.basket, function (i, row) {
                    let product = that.findProductByArt(row.art);
                    if (product) {
                        row.price = parseInt(product.price);
                    }
                });

                return that.basket;
            },

            basketVisible: function () {

                let list = [];
                let that = this;
                let counted = 0;
                let countBasket = 0;

                $.each(that.basket, function (i, row) {
                    countBasket = countBasket + parseInt(row.qty);
                });

                let saleCount = Math.floor(countBasket / 4);

                that.basketFormat = that.basketFormat.sort(function(a,b) {
                    return a['price'] - b['price'];
                });

                $.each(that.basketFormat, function (i, row) {

                    let product = that.findProductByArt(row.art);

                    if (product) {

                        product.discount = null;

                            let price = parseInt(product.price);
                            let sale  = parseInt(product.price);

                            if (that.order.procent && product.category !== 11 && product.category !== 9) {
                                sale = sale - Math.round(sale * that.order.procent / 100);
                                product.discount = 'Скидка ' + that.order.procent + '%';
                            }

                            let total = 0;
                            let free  = 0;

                            for (var i = 0; i < row.qty; i++) {
                                if (counted < saleCount && ( product.volume !== 500 && product.category !== 11)) {
                                    free ++;
                                    counted ++;
                                    product.discount = free + ' в подарок!';
                                } else {
                                    total = total + sale;
                                }
                            }

                            let has = false;
                            $.each(list, function (ind, li) {
                                if (li.art == row.art) {
                                    li.qty += row.qty;
                                    li.total = sale * li.qty;
                                    has = true;
                                }
                            });

                            let variants = [];
                            if (product.variants) {
                                variants = product.variants;
                            }

                            if ( ! has) {
                                list.push({
                                    qty:      row.qty,
                                    art:      row.art,
                                    volume:   row.vol,

                                    price:    price,
                                    sale:     sale,

                                    bname:    product.bname,
                                    name:     product.name,
                                    img:      product.img,
                                    discount: product.discount,
                                    analog:   product.analog,
                                    samples:  product.samples,
                                    category: product.category,

                                    total:    total,
                                    variants:  variants
                                });
                            }
                        }

                });

                return list;
            },

            countSeptics: function () {
                let that = this;
                let count = 0;
                $.each(that.products, function (index, product){
                    if (product.category == 9 ) {
                        count++;
                    }
                });
                return count;
            },

            countAuto: function () {
                let that = this;
                let count = 0;
                $.each(that.products, function (index, product){
                    if (product.category == 10 ) {
                        count++;
                    }
                });
                return count;
            },

            countGel: function () {
                let that = this;
                let count = 0;
                $.each(that.products, function (index, product){
                    if (product.category == 11 ) {
                        count++;
                    }
                });
                return count;
            },

            countMan500: function () {
                let that = this;
                let count = 0;
                $.each(that.products, function (index, product){
                    if (product.man500 == 1) {
                        count++;
                    }
                });
                return count;
            },

            countWoman500: function () {
                let that = this;
                let count = 0;
                $.each(that.products, function (index, product){
                    if (product.woman500 == 1) {
                        count++;
                    }
                });
                return count;
            },

        },

        methods: {

            prepareProductsNew: function () {
                var that   = this;
                that.productsNew = [];
                var limit  = 10;
                $.each(that.products, function (index, product) {
                    if (product.new == 1 && that.productsNew.length < limit) {
                        that.productsNew.push(product);
                    }
                });

                return that.productsNew;
            },

            prepareProductsTop: function () {
                var that   = this;
                that.productsTop = [];
                var limit  = 10;
                $.each(that.products, function (index, product) {
                    if (product.hit == 1 && that.productsNew.length < limit) {
                        that.productsTop.push(product);
                    }
                });

                return that.productsTop;
            },

            findProductByArt: function(art) {
                let that = this;
                let pro = null;
                $.each(that.products, function (index, product) {
                    if (product.art == art) {
                        pro = Object.assign({}, product);
                    }

                    if (product.variants) {
                        $.each(product.variants, function (i, variant) {
                            if (variant.art == art) {
                                pro = Object.assign({}, product);
                                pro.price = variant.price;
                                pro.img = variant.img;
                                pro.img1000 = variant.img1000;
                                pro.volume = variant.volume;
                                pro.art = variant.art;
                            }
                        });
                    }
                });

                return pro;
            },

            findProductVariantsByArt: function(art) {
                let result;
                let that = this;
                result = that.findProductByArt(art);
                if ((result !== null) && result.variants) {
                    console.log(art, result.variants);
                    return result.variants;
                }
                return null;
            },

            setProductVariantPrice: function(price, volume, img) {
                //console.log(price, volume);
                $('span#product-variant-price').text(price);
                $('a.vol-button').removeClass('vol-active');
                $('a#variant-'+volume).addClass('vol-active');
                $("img.product-info-img").attr("src",img);
                if (volume == 500) {
                    $("img.product-info-img").css("max-width", "225px");
                } else {
                    $("img.product-info-img").css("max-width", "400px");
                }
            },

            toggleFilter: function () {
                this.showFilter = ! this.showFilter;
            },

            setPosition: function (index) {
                $('.filter-button').remove();
                $('#wrap-brand-' + index).after('<button onClick="$(\'.hide-button\').click();" class="product-card__button sex_button filter-button" style="font-size: 12px; padding: 8px 30px; margin-bottom: 10px;">Фильтровать</button>');
            },

            reloadSliderNew: function () {
               $(".regular2").slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: false,
                dots: false,
                responsive: [
                    {
                    breakpoint: 990,
                    settings: {slidesToShow: 3}
                    }, {
                    breakpoint: 800,
                    settings: {slidesToShow: 2}
                    }, {
                    breakpoint: 600,
                    settings: {slidesToShow: 1}
                    }
                ]
                });
            },

            reloadSliderTop: function () {
               $(".regular").slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: false,
                dots: false,
                responsive: [
                    {
                    breakpoint: 990,
                    settings: {slidesToShow: 3}
                    }, {
                    breakpoint: 800,
                    settings: {slidesToShow: 2}
                    }, {
                    breakpoint: 600,
                    settings: {slidesToShow: 1}
                    }
                ]
                });
            },

            setVolumeCard: function(product, volume) {
                let that = this;
                $.each(product.variants, function (index, variant) {
                    if (variant.volume === parseInt(volume)) {
                        product.volume = variant.volume;
                        product.art = variant.art;
                        product.img = variant.img;
                        product.price = variant.price;

                        that.$forceUpdate();
                    }
                });
            },

            removeBrand: function (brand) {
                let index = this.brandsSelected.indexOf(brand);
                if (index !== -1) {
                    this.brandsSelected.splice(index, 1);
                }

                let index2 = this.brandsPreSelected.indexOf(brand);
                if (index2 !== -1) {
                    this.brandsPreSelected.splice(index2, 1);
                }

                if (this.brandsSelected.length === 0) {
                    this.clearBrands();
                }
            },

            filterBrands: function () {
                this.brandsSelected = Object.assign([], this.brandsPreSelected);
                $('.show-more-all').hide();
                $('#filter-brands-button').hide();
                location.href="#woman";

                $('.navigation').removeClass('active');
                $('.overlay-black').hide();
                $('.filter-button').remove();
            },

            clearBrands: function () {
                this.brandsPreSelected = [];
                this.brandsSelected = [];

                $('.show-more-all').show();
                $('.filter-button').remove();
            },

            clearBasker: function () {
                this.basket = [];
                this.basketVisible = [];
            },

            setStep: function (step) {
                var that = this;
                setTimeout(function(){ that.step = step; }, 100);
            },

            setCity: function (row) {
                this.showCities = false;
                this.order.cityId = row.city_id;
                this.order.city = row.name;
                $('.city-issue').html('');

                if (this.order.pay == 'Отделение') {
                    this.searchOffices('', true);
                }

                if (this.order.pay == 'Курьером') {
                    //this.searchStreets();
                }

            },

            searchCities: function () {
                var that = this;

                if ( ! that.order.city && that.order.city.length < 3) {
                    that.cities = [];
                    that.citiesFiltered = [];
                    that.offices = [];
                    that.officesFiltered = [];
                    that.showCities = false;
                    that.showOffices = false;
                    that.showStreets = false;
                    that.showHouses = false;
                    that.order.cityId = '';
                    that.order.office = '';
                    that.order.officeId = '';
                    that.order.street = '';
                    that.order.house = '';
                    return false;
                }

                if (that.order.city.length >= 3) {

                    if (that.loading) {
                        return false;
                    }

                    that.loading = true;
                    $.ajax({
                        type: 'POST',
                        url: '/api/cities',
                        data: {
                            _token: that.token,
                            keyword: that.order.city,
                        },
                        cache: false,
                        success: function(data) {
                            that.order.strretId = '';
                            that.order.cityId = '';
                            that.order.office = '';
                            that.order.officeId = '';
                            that.offices = [];
                            that.officesFiltered = [];
                            that.streets = [];
                            that.streetsFiltered = [];
                            that.houses = [];
                            that.housesFiltered = [];

                            that.showCities = true;
                            that.showOffices = false;
                            that.showStreets = false;
                            that.showHouses = false;

                            that.cities = [];
                            that.citiesFiltered = [];

                            let cities = JSON.parse(data);
                            $.each(cities, function (index, row) {

                                let city = [];
                                city.push(row.name_ua);

                                if (row.region) {
                                    city.push(row.region);
                                }

                                if (row.area) {
                                    city.push(row.area);
                                }

                                that.cities.push({
                                    city_id: row.ref,
                                    name: city.join(' - '),
                                    name_ua: row.name_ua
                                })

                                that.citiesFiltered.push({
                                    city_id: row.ref,
                                    name: city.join(' - '),
                                    name_ua: row.name_ua
                                })
                            });

                            // that.loading = false;
                            setTimeout(function(){ that.loading = false; }, 700);
                        }
                    });

                } else {

                    that.citiesFiltered = that.cities.filter(function(item){
                        return item.name.toLowerCase().includes(that.order.city.toLowerCase()) || item.name_ua.toLowerCase().includes(that.order.city.toLowerCase());
                    });
                }
            },

            setOffice: function (row) {
                this.showOffices = false;
                this.order.office = row.name_ua;
                this.order.officeId = row.number;
            },

            //setOffice - оффис новой почты для ua, это СДЕК ru
            setOfficeSdek: function (row) {
                this.showOffices = false;
                this.order.sdek_to = row;
            },

            searchOffices: function (office, force = false) {
                var that = this;

                if ( ! that.order.cityId) {
                    return false;
                }

                if (that.offices.length === 0 || force == true) {

                    if (that.loading) {
                        return false;
                    }

                    that.loading = true;

                    $.ajax({
                        type: 'POST',
                        url: '/api/offices',
                        data: {
                            _token: that.token,
                            cityId: that.order.cityId
                        },
                        cache: false,
                        success: function(data) {
                            that.order.office = '';
                            that.order.officeId = '';
                            that.offices = JSON.parse(data);
                            that.officesFiltered = JSON.parse(data);
                            that.showOffices = true;
                            that.loading = false;
                        }
                    });

                } else {

                    that.officesFiltered = that.offices.filter(function(item){
                        return item.number.toString().indexOf(that.order.office.toLowerCase()) > -1 ||
                            item.name_ua.toLowerCase().indexOf(that.order.office.toLowerCase()) > -1 ||
                            item.name_ru.toLowerCase().indexOf(that.order.office.toLowerCase()) > -1;
                    });
                }
            },

            // Sdek search RU offices on zip code (=== post code)
            searchOfficesSdek: function () {
                let that = this;

                $.ajax({
                    type: 'POST',
                    url: '/api/offices-ru',
                    data: {
                        _token: that.token,
                        zip: that.order.zip
                    },
                    cache: false,
                    success: function(data) {
                        that.offices = JSON.parse(data);
                        that.officesFiltered = JSON.parse(data);
                        that.showOffices = true;
                        that.loading = false;

                    }
                });

            },

            clearIssue: function () {

                $('.postindex-issue').html('');
                $('.city-issue').html('');

                $('input[name="modal-order-phone"]').removeClass('issue');
                $('input[name="name"]').removeClass('issue');
                $('input[name="city"]').removeClass('issue');
                $('input[name="office"]').removeClass('issue');
                $('input[name="street"]').removeClass('issue');
                $('input[name="house"]').removeClass('issue');

                this.cities = [];
                this.citiesFiltered = [];
                this.offices = [];
                this.officesFiltered = [];
                this.houses = [];
                this.housesFiltered = [];
                this.flat = '';

                this.order.city = '';
                this.order.cityId = '';
                this.order.office = '';
                this.order.officeId = '';
                this.order.street = '';
                this.order.streetId = '';
                this.order.house = '';
                this.order.flat = '';
            },

            clearKindPay: function () {
                this.order.kindpay = null;
                this.order.pay = null;
                this.clearIssue();
            },

            clearPay: function () {
                this.order.pay = null;
                this.clearIssue();
            },

            acceptOrder: function (event) {

                event.preventDefault();

                var that = this;
                var error = false;

                $('.postindex-issue').html('');

                $('input[name="modal-order-phone"]').removeClass('issue');
                $('input[name="name"]').removeClass('issue');
                $('input[name="lastname"]').removeClass('issue');

                $('input.city').removeClass('issue');
                $('input.office').removeClass('issue');
                $('input.street').removeClass('issue');
                $('input.house').removeClass('issue');

                if ( ! that.order.phone || that.order.phone.replace(/[^0-9]/g,"").length < 12) {
                    $('input[name="modal-order-phone"]').addClass('issue');
                    error = true;
                }

                if ( that.order.nocall && that.order.pay == 'Отделение' && ! that.order.city) {
                    $('input[name="city"]').addClass('issue');
                    $('input.city').addClass('issue');
                    error = true;
                }

                if ( that.order.nocall && that.order.pay == 'Отделение' && ! that.order.office) {
                    $('input[name="office"]').addClass('issue');
                    $('input.office').addClass('issue');
                    error = true;
                }

                if ( that.order.nocall && that.order.pay == 'Курьером' && ! that.order.city) {
                    $('input[name="city"]').addClass('issue');
                    $('input.city').addClass('issue');
                    error = true;
                }

                if ( that.order.nocall && that.order.pay == 'Курьером' && ! that.order.street) {
                    $('input.street').addClass('issue');
                    error = true;
                }

                if ( that.order.nocall && that.order.pay == 'Курьером' && ! that.order.house) {
                    $('input.house').addClass('issue');
                    error = true;
                }

                if ( that.order.pay == 'Отделение' || that.order.pay == 'Курьером') {
                    //не уверен... сделано, чтоб при оплате при получении, name было необязательным (обязат.только телефон)
                    //if ( ! that.order.name) {
                    if ( ! that.order.name && that.order.kindpay == 1) {
                         $('input[name="name"]').addClass('issue');
                         error = true;
                    }

                    if ( that.order.nocall && ! that.order.lastname) {
                         $('input[name="lastname"]').addClass('issue');
                         error = true;
                    }
                }

                if ( that.order.nocall && that.order.pay == 'Отделение' && that.order.city && ! that.order.cityId) {
                    $('.city-issue').html('Выберите город из списка');
                    error = true;
                }

                if ( that.order.nocall && that.order.pay == 'Отделение' && ! that.order.office) {
                    $('.postindex-issue').html('Выберите Отделение из списка');
                    error = true;
                }

                if ( that.order.nocall && that.order.pay == 'Курьером' && ! that.order.house) {
                    $('.postindex-issue').html('Выберите номер дома из списка');
                    error = true;
                }

                if (error) {
                    console.log('error');
                    return false;
                }

                    that.loading = true;

                    $.ajax({
                        type: 'POST',
                        url:  '/api/store',
                        data: {
                            street: that.order.street,
                            house: that.order.house,
                            flat: that.order.flat,
                            name: that.order.name,
                            lastname: that.order.lastname,
                            prelastname: that.order.prelastname,
                            tel: that.order.phone,
                            city: that.order.city,
                            office: that.order.officeId,
                            comment: that.order.comment,
                            pay: that.order.pay,
                            kindpay: that.order.kindpay,
                            promocode: that.order.promocode,
                            basket: JSON.stringify(that.basketVisible),
                            nocall: that.order.nocall,
                            url: window.location.hostname,
                            _token: that.token,
                        },
                        cache: false,
                        success: function(data) {

                            that.$cookies.remove('basket');
                            that.$cookies.remove('promocode');

                            if (that.order.kindpay == 1) {
                                setTimeout(function(){ location.href="/thanks.html?order="+data+"&sum=" + that.total }, 100);
                                return true;
                            }

                            setTimeout(function(){ location.href="/thanks.html?phone=" + that.order.phone; }, 100);
                        }
                    });

            },

            openModal: function (id) {
                $('.' + id).addClass('open');
                $('body').addClass('hidden');
            },

            closeModal: function (id) {
                $('.' + id).removeClass('open');
                $('body').removeClass('hidden');
            },

            removeFromCart: function (art) {

                var that = this;

                $.each(that.basketVisible, function (index, product){
                    if (product.art === art) {
                        that.basket.splice(index, 1);
                    }
                });

                that.$cookies.set('basket', JSON.stringify(this.basket));

            },

            switcherCart: function (product, event) {
                if (this.hasInBasket(product.art)) {
                    this.removeFromCart(product.art);
                    return true;
                }

                this.addToCart(product, event);
            },

            minusCart: function(product) {
                var that = this;

                $.each(that.basket, function (index, pro){
                    if (pro && pro.art === product.art) {
                        pro.qty--;

                        if (pro.qty === 0 || pro.qty < 0) {
                            that.removeFromCart(pro.art);
                        } else {
                            that.$cookies.set('basket', JSON.stringify(that.basket));
                        }
                    }
                });
            },

            plusCart: function(product) {
                var that = this;

                $.each(that.basket, function (index, pro){
                    if (pro.art === product.art) {
                        pro.qty++;
                        that.$cookies.set('basket', JSON.stringify(that.basket));
                    }
                });
            },

            addToCart: function (product, event) {
                event.preventDefault();
                this.basket.push({art: product.art, vol: product.volume, qty: 1});
                this.$cookies.set('basket', JSON.stringify(this.basket));
            },

            // add to cart from extended product page
            extendProductCart: function (art, event) {
                this.switcherCart({ art: art }, event);
            },

            closeBasket: function () {
                this.closeModal('modal__cart-promocode');
                this.closeModal('modal__order');

                window.history.pushState({}, document.title, "/");
            },

            openBasket: function () {
                this.closeModal('modal__product');
                this.openModal('modal__cart-promocode');

                this.clearKindPay();

                setTimeout(function() {
                    $('.modal-promocode').css('top', 0);
                    if (parseInt($('body').width()) > 760) {
                        let height = parseInt($('.modal-promocode').height()) / 2;
                        $('.modal-promocode').css('top', height + 'px');
                    }

                    document.location.hash = 'basket';
                }, 100);
            },

            checkout: function () {
                this.closeModal('modal__cart-promocode');
                this.openModal('modal__order');
            },

            getSamples: function () {
                let that = this;
                let lang = $('.lang').val();

                $.get('/api/samples?lang='+lang, function(data) {
                    that.products = JSON.parse(data);

                    that.prepareProductsTop();
                    that.prepareProductsNew();

                    setTimeout(function(){
                        that.reloadSliderTop();
                        that.reloadSliderNew();
                    }, 100);

                    if (window.location.hash && window.location.hash !== '#basket') {
                        setTimeout(function(){
                            $([document.documentElement, document.body]).animate({
                                scrollTop: $(window.location.hash).offset().top
                            }, 500);
                        }, 200);
                    }
                });
            },

            showPromocode: function () {
                $('.modal-promocode-table__footer-col-promo').show();
            },

            showInfo: function () {
                $('.main-menu').removeClass('open');
            },

            hasSamples: function () {
                var sample = false;

                this.basketVisible.forEach(function (product) {
                    if (product.samples == 1) {
                        sample = true;
                    }
                });

                return sample;
            },

            hasInBasket: function (art) {
                var has = false;

                this.basketVisible.forEach(function (product) {
                    if (product.art == art) {
                        has = true;
                    }
                });

                return has;
            },

            countSamples: function () {
                var count = 0;

                this.basketVisible.forEach(function (product) {
                    if (product.samples == 1) {
                        count++;
                    }
                });

                return count;
            },

            acceptPromocode: function (event) {
                event.preventDefault();

                var that = this;

                that.promocodeIssue = '';
                if ( ! that.order.promocode) {
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: '/api/promocode',
                    data: {
                        promocode: that.order.promocode,
                        site: window.location.hostname,
                        _token: that.token,
                    },
                    cache: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data && data.procent) {
                            that.order.procent = data.procent;
                            that.$cookies.set('promocode', that.order.promocode);
                            that.$cookies.set('procent', data.procent);
                        } else {
                            that.promocodeIssue = 'Промокод не найден';
                        }

                    }
                });
            },

            showMore: function (category) {
                let that = this;
                let count = 0;

                $.each(that.products, function (index, product) {
                    if ( ((product.man == 1 && category == "man") || (product.woman == 1 && category == "woman")) && product.show === 0 && count < 32) {
                      product.show = 1;
                      count++;
                    }
                });

                if (this.products.filter(function (product) {
                    return (product.show === 0 && ((product.man == 1 && category == "man") || (product.woman == 1 && category == "woman") ))
                }).length === 0) {
                    $('#show-more-' + category).hide();
                    $('#more-background-' + category).hide();
                }
            },

            changeBasketVolume: function (product) {
                var that = this;
                var arts = [];
                $.each(that.basket, function (index, row) {

                    if (row.art === product.art) {

                        let art = product.art
                            .replace('-30', '')
                            .replace('-500', '')
                            .replace('-50', '')
                        ;

                        if (product.volume == 30) {
                            row.art = art + '-30';
                        }

                        if (product.volume == 50) {
                            row.art = art + '-50';
                        }

                        if (product.volume == 100) {
                            row.art = art;
                        }

                        if (product.volume == 500) {
                            row.art = art + '-500';
                        }

                        row.vol = product.volume;
                    }
                });

                $.each(that.basket, function (index, row) {
                    if (row) {
                        if (that.contains(arts, row.art)) {
                            that.basket.splice(index, 1);
                        } else {
                            arts.push(row.art);
                        }
                    }

                });

                that.$cookies.set('basket', JSON.stringify(that.basket));

                that.$forceUpdate();
            },

            contains: function (a, obj) {
                var i = a.length;
                while (i--) {
                    if (a[i] === obj) {
                        return true;
                    }
                }
                return false;
            },

            openParfumMan: function () {
                this.openModal('modal__parfumer');
            },

            closeParfumMan: function () {
                this.closeModal('modal__parfumer');
            },

            saveParfumMan: function () {
                var error = false;
                var that  = this;

                $('input[name="modal-order-phone"]').removeClass('issue');

                if ( ! this.phone || this.phone.replace(/[^0-9]/g,"").length < 12) {
                    $('input[name="modal-order-phone"]').addClass('issue');
                    error = true;
                }

                if ( ! error) {
                    $.ajax({
                        type: 'POST',
                        url:  '/api/parfumman',
                        data: {
                            _token: that.token,
                            tel: that.phone,
                            subdomain: $('.subdomain').val(),
                        },
                        cache: false,
                        success: function(data) {
                            that.parfumManRequest = true;
                        }
                    });
                }
            },

        }
    });
}
