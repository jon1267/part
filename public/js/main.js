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

    $('input[type="tel"]').click(function(){
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

        } else {
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

    function openBasket() {
        // $('.header-basket').on("click", function () {
        //     $('.modal__cart-promocode').addClass('open');
        //     $('body').addClass('hidden');
        // })
    }

    //function showMore(category = '') {
    //    console.log(this.products, category);
    //}

    initMobileMenu();
    closeModal();
    changePromocodeBoxPlaceholder();
    initCertificateSlider();
    initInstagramSlider();
    initSelect();
    initSelectLanguage();
    openBasket();
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
                procent: 10,//0,
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

            countManMax: 12,
            countWomanMax: 12,
            pagination: 12,

            productsGroupped: [],
            productsNew: [],
            productsTop: [],

            showFilter: false,
            token: $('meta[name="csrf-token"]').attr('content'),
        },



        mounted: function() {

            this.$cookies.config('30d');

            this.getSamples();

            if ($('.compare').length) {
                this.compare = true;
            }

            if ($('.compare').length && ! this.$cookies.get('analog')) {
                this.openAnalog();
                $('.modal-warning__close').hide();
            }

            cookie = JSON.parse(this.$cookies.get('basket'));
            if (cookie) {
                this.basket = cookie;
            }

            promocode = this.$cookies.get('promocode');
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



        },

        watch: {
           countManMax: function () {
               this.productsGrouppedPrepare();
           },

           countWomanMax: function () {
               this.productsGrouppedPrepare();
           },
        },

        computed: {

            brands: function () {
            	var list = [];
                var that = this;

            	 $.each(that.products, function (index, product){
                    if (list.indexOf(product.bname) < 0 && product.category != 9 && product.category != 10) {
                    	list.push(product.bname);
                    }
                });

                return list.sort();
            },

	    productsVisible: function () {
	        var list = [];
                var that = this;
                var visible = [];

		$.each(that.products, function (index, product) {

			let added = false;

			if ( ! visible[product.category]) {
				visible[product.category] = 0;
			}

			if (product.show === 1) {
			 	visible[product.category]++;
			}

			if (that.brandsSelected.length === 0) {
                    		list.push(product);
                    		added = true;
                    	}

                    	if ( ! added && that.brandsSelected.indexOf(product.bname) >= 0) {
            			product.show = 1;
            			visible[product.category]++;
                    		list.push(product);
                    	}

		});

		return list;
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
                if (this.totalFull > 600) {
                	return '+1 парфюм 30мл бесплатно';
                }

                return '';
            },

            total: function () {
                var total = 0;
                var that = this;
                $.each(that.basketVisible, function (index, product){
                    if (product.sale > 0) {
                        total += (parseInt(product.sale) * product.qty);
                    }
                });

                return total;
            },

            totalFull: function () {
                var total = 0;
                var that = this;
                $.each(that.basketVisible, function (index, product){
                    total += (parseInt(product.price) * product.qty);
                });

                return total;
            },

            basketVisible: function () {
                var list = [];
                var that = this;

                // that.basket.sort(function(a, b){return (a.price > b.price) ? 1 : -1});

                var saleCount = 0;
                // saleCount = Math.floor(that.basket.length / 4);


              	var total = 0;
                $.each(that.basket, function (i, pro) {
                    $.each(that.products, function (index, product) {
                        if (pro.art == product.art) {
                            total += (parseInt(product.price) * pro.qty);
                        }
                    });
                });

                $.each(that.basket, function (i, pro) {

                    $.each(that.products, function (index, product) {

                        product.discount = null;
                        product.sale     = product.price;

                        if (that.order.kindpay == 1) {
                            product.sale = product.sale - Math.round(product.sale * 0.1);
                            product.discount = 'Скидка 10%';
                        }

                        //if (that.order.procent) {
                        //     product.sale = product.sale - Math.round(product.sale * that.order.procent / 100);
                        //     product.discount = 'Скидка ' + that.order.procent + '%';
                        //}

                        if (total >= 600) {

                        }

                        if (i + 1 <= saleCount) {
                            product.sale = 0;
                            product.discount = 'В подарок!';
                        }

                        if (pro.art == product.art) {
                            list.push({
                                qty:      pro.qty,

                                art:      product.art,
                                price:    product.price,
                                sale:     product.sale,
                                volume:   product.volume,
                                bname:    product.bname,
                                name:     product.name,
                                img:      product.img,
                                discount: product.discount,
                                analog:   product.analog,
                                samples:  product.samples,
                                total:    product.sale * pro.qty,
                            });
                        }
                    });
                });

                return list;
            }

        },

        methods: {

	     toggleFilter: function () {
	        this.showFilter = ! this.showFilter;
	     },

            setPosition: function (index) {

                let position = $('#brand-' + index).offset().top;
                let scrolled = $(document).scrollTop();
                let scrolledNavigation = $('.navigation').scrollTop();
                position = position - scrolled + scrolledNavigation;


                $('#filter-brands-button').show();
                $('#filter-brands-button').css('top', position - 15);
                $('#filter-brands-button').css('left', 120);

            },

	    reloadSliderNew: function () {
	       $(".regular2").slick({
			dots: true,
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			dots: false,
			responsive: [
			    {
				breakpoint: 990,
				settings: {slidesToShow: 3}
			    }, {
				breakpoint: 800,
				settings: {slidesToShow: 2}
			    }, {
				breakpoint: 400,
				settings: {slidesToShow: 1}
			    }
			]
		    });
	    },

	    reloadSliderTop: function () {
	       $(".regular").slick({
			dots: true,
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			dots: false,
			responsive: [
			    {
				breakpoint: 990,
				settings: {slidesToShow: 3}
			    }, {
				breakpoint: 800,
				settings: {slidesToShow: 2}
			    }, {
				breakpoint: 400,
				settings: {slidesToShow: 1}
			    }
			]
		    });
	    },

            productsNewPrepare: function () {
            	var groups = [];
            	var that   = this;
            	var limit  = 10;
            	let products = JSON.parse(JSON.stringify(that.products));

            	$.each(products, function (ind, product) {

            	    if (product.new == 1) {

            	    	let artParts = product.art.split('-');
	    	        let art = artParts[0];

	    	        let index = that.findInArrByAttr(groups, 'art', art);

	    	        if (index < 0) {

	    	            if (groups.length <= limit - 1 && product.volume == 30) {

            	    	        let pro = [];
	    	    	        product.show = true;

	    	    	        pro.push(product);
	    	    	        groups.push({
	    	    	           art: art,
	    	    	           products: pro,
	    	    	           man: parseInt(product.man),
	    	    	           woman: parseInt(product.woman),
	    	    	           show: true,
	    	    	        });

            	            }

	    	        } else {
	    	      	    product.show = false;
	    	    	    groups[index].products.push(product);
	    	        }
            	    }
            	});

            	that.productsNew = groups;

            	setTimeout(function(){ that.reloadSliderNew(); }, 500);

            	return that.productsNew;
            },

            productsTopPrepare: function () {
            	var groups = [];
            	var that   = this;
            	var limit  = 10;
            	let products = JSON.parse(JSON.stringify(that.products));

            	$.each(products, function (ind, product) {

            	    if (product.hit == 1) {

            	    	let artParts = product.art.split('-');
	    	        let art = artParts[0];

	    	        let index = that.findInArrByAttr(groups, 'art', art);

	    	        if (index < 0) {

	    	            if (groups.length <= limit - 1 && product.volume == 30) {

            	    	        let pro = [];
	    	    	        product.show = true;

	    	    	        pro.push(product);
	    	    	        groups.push({
	    	    	            art: art,
	    	    	            products: pro,
	    	    	            man: parseInt(product.man),
	    	    	            woman: parseInt(product.woman),
	    	    	            show: true,
	    	    	        });

            	            }

	    	        } else {
	    	      	    product.show = false;
	    	    	    groups[index].products.push(product);
	    	        }
            	    }
            	});

            	that.productsTop = groups;

            	setTimeout(function(){ that.reloadSliderTop(); }, 500);

            	return that.productsTop;
            },

            productsGrouppedPrepare: function () {
            	var groups = [];
            	var that = this;
            	var countMan = 0;
            	var countWoman = 0;

            	let products = JSON.parse(JSON.stringify(that.products));

            	$.each(products, function (ind, product) {

            	    product.arrow = true;

            	    let artParts = product.art.split('-');
            	    let art = artParts[0];

            	    let index = that.findInArrByAttr(groups, 'art', art);

            	    if (index < 0) {

            	   	let show = false;

            	   	if (product.man === "1") {
            	    	    countMan++;
            	    	    if (countMan <= that.countManMax) {
            	    	    	show = true;
            	    	    }
            	    	}

            	    	if (product.woman === "1") {
            	    	    countWoman++;
            	    	    if (countWoman <= that.countWomanMax) {
            	    	    	show = true;
            	    	    }
            	    	}

            	    	if ( that.brandsSelected.length === 0 || (that.brandsSelected.length > 0 && that.brandsSelected.indexOf(product.bname) >= 0) ) {
            		    let pro = [];
	    	    	    product.show = true;
	    	    	    pro.push(product);
	    	    	    groups.push({
	    	    	       art: art,
	    	    	       products: pro,
	    	    	       man: parseInt(product.man),
	    	    	       woman: parseInt(product.woman),
	    	    	       show: show,

	    	    	    });
                    	}

            	    } else {
            	    	product.show = false;
            	    	groups[index].products.push(product);
            	    }

            	});

            	that.productsGroupped = groups;

            	return that.productsGroupped;
            },

            prevProductInGroup(group) {
                console.log('prev');
            	let count = group.products.length;
            	let index = this.findInArrByAttr(group.products, 'show', true);

            	index--;

            	if (index < 0) {
            	   index = count - 1;
            	}

            	$.each(group.products, function (ind, product) {
            	    if (index === ind) {
            	    	product.show = true;
            	    } else {
            	    	product.show = false;
            	    }
            	});
            },

            nextProductInGroup(group) {
                console.log('next');
            	let count = group.products.length;
            	let index = this.findInArrByAttr(group.products, 'show', true);

            	index++;

            	if (index > count - 1) {
            	   index = 0;
            	}

            	$.each(group.products, function (ind, product) {
            	    if (index === ind) {
            	    	product.show = true;
            	    } else {
            	    	product.show = false;
            	    }
            	});
            },

            findInArrByAttr(array, attr, value) {
	        for(var i = 0; i < array.length; i += 1) {
		    if(array[i][attr] === value) {
		        return i;
		    }
	        }
    	        return -1;
            },

            filterBrands: function () {
                this.countManMax = 1000;
                this.countWomanMax = 1000;
                this.brandsSelected = Object.assign([], this.brandsPreSelected);

                this.productsGrouppedPrepare();
                $('.show-more-all').hide();
                $('#filter-brands-button').hide();


                if (window.location.hash !== '#man' && window.location.hash !== '#woman') {
                    location.href="/#woman";
                }

                $('.navigation').removeClass('active');
                $('.overlay-black').hide();
            },

            clearBrands: function () {
                this.brandsPreSelected = [];
                this.brandsSelected = [];
                this.countManMax = 12;
                this.countWomanMax = 12;
                this.productsGrouppedPrepare();
                $('.show-more-all').show();
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
                    this.searchStreets();
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

                if ( that.order.pay == 'Отделение' && ! that.order.name) {
                    $('input[name="name"]').addClass('issue');
                    error = true;
                }

                if ( that.order.pay == 'Отделение' && ! that.order.city) {
                    $('input[name="city"]').addClass('issue');
                    $('input.city').addClass('issue');
                    error = true;
                }

                if ( that.order.pay == 'Отделение' && ! that.order.office) {
                    $('input[name="office"]').addClass('issue');
                    $('input.office').addClass('issue');
                    error = true;
                }

                if ( that.order.pay == 'Курьером' && ! that.order.city) {
                    $('input[name="city"]').addClass('issue');
                    $('input.city').addClass('issue');
                    error = true;
                }

                if ( that.order.pay == 'Курьером' && ! that.order.street) {
                    $('input.street').addClass('issue');
                    error = true;
                }

                if ( that.order.pay == 'Курьером' && ! that.order.house) {
                    $('input.house').addClass('issue');
                    error = true;
                }

                if ( that.order.pay == 'Отделение' || that.order.pay == 'Курьером') {
                    if ( ! that.order.name) {
                         $('input[name="name"]').addClass('issue');
                         error = true;
                    }

                    if ( ! that.order.lastname) {
                         $('input[name="lastname"]').addClass('issue');
                         error = true;
                    }
                }

                if ( that.order.pay == 'Отделение' && that.order.city && ! that.order.cityId) {
                    $('.city-issue').html('Выберите город из списка');
                    error = true;
                }

                if ( that.order.pay == 'Отделение' && ! that.order.office) {
                    $('.postindex-issue').html('Выберите Отделение из списка');
                    error = true;
                }

                if ( that.order.pay == 'Курьером' && ! that.order.house) {
                    $('.postindex-issue').html('Выберите номер дома из списка');
                    error = true;
                }

                if (error) {
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
                this.basket.push({art: product.art, qty: 1});
                this.$cookies.set('basket', JSON.stringify(this.basket));
            },

            // add to cart from extended product page
            extendProductCart: function (art, event) {
                this.switcherCart({ art: art }, event);
            },

            closeBasket: function () {
                this.closeModal('modal__cart-promocode');
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
                }, 100);
            },

            checkout: function () {
                this.closeModal('modal__cart-promocode');
                this.openModal('modal__order');
            },

            getSamples: function () {
                var that = this;
                $.get('/api/samples', function(data) {
                    that.products = JSON.parse(data);
                    that.productsGrouppedPrepare();
                    that.productsTopPrepare();
                    that.productsNewPrepare();
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

            showMoreGroup: function (category) {
                if (category === 'man') {
                    this.countManMax = this.countManMax + this.pagination;
                }

                if (category === 'woman') {
                    this.countWomanMax = this.countWomanMax + this.pagination;
                }

                if (this.productsGroupped.filter(function (group) {return (group.show === false && group[category] == 1) }).length === 0) {
                        $('#show-more-' + category).hide();
                   }
            },

            showMore: function (category) {
                let that = this;
                let count = 0;
                let categoryNames = {3:"woman50", 4:"man50", 5:"woman100", 6:"man100", 7:"woman500", 8:"man500",};

                $.each(that.productsVisible, function (index, product) {
                    if (product.category == category && product.show === 0 && count < 12) {
                      product.show = 1;
                      count++;
                    }
                });

                if (this.productsVisible.filter(function (product) {return (product.show === 0 && product.category == category) }).length === 0) {
                    //$('#show-more-' + category).hide();//this not work on pages /parfumes50 (100,500)
                    $('#show-more-' + categoryNames[category]).hide();
                }
            },


        }
    });
}
