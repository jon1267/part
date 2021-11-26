<section class="instagram-box">
    <div class="wrapper">
        <div class="instagram-box__inner">
            <!--<div class="instagram-box__header">-->

                <!--<div class="instagram-box__title">#PDPARIS</div>-->

                {{--<div class="instagram-box__text" >

                    <p style="text-align: justify">
                    {{ __('А это — наш') }} <a target="_blank" href="https://www.instagram.com/pd_paris/"> Instagram </a>
                    {{__('в котором вы найдете отзывы клиентов, полезную информацию о парфюмерии и не только, а также — много всего интересного. Присоединяйтесь') }} <i class="fas fa-smile" style="color: #e8b024; margin-top: 5px;"></i>
                    </p>

                </div>--}}
                <!--<div style="margin-top: 25px;">
                    <a target="_blank"  href="https://www.instagram.com/pd_paris/" title="Instagram" >
                        <div class="instagram-box__icon"></div>
                    </a>
                </div>-->

            <!--</div>-->


            <!--<div class="instagram-box__slider">
                <img style="width:285px;" src="/images/instagram-2.jpg" alt="">
                <img style="width:285px;" src="/images/instagram-1.jpg" alt="">
                <img style="width:285px;" src="/images/instagram-3.jpg" alt="">
                <img style="width:285px;" src="/images/instagram-4.jpg" alt="">
                <img style="width:285px;" src="/images/instagram-5.jpg" alt="">
                <img style="width:285px;" src="/images/instagram-6.jpg" alt="">
                <img style="width:285px;" src="/images/instagram-7.jpg" alt="">
                <img style="width:285px;" src="/images/instagram-9.jpg" alt="">
            </div>-->

            {{--<div class="instagram-box__slider">
                @php
                    $slides = [];
                    for ($i=1; $i<=352; $i++) {
                        $slides[] = $i.'.png?5';
                    }
                    shuffle($slides);
                    $slides = array_slice($slides, 0, 10);
                @endphp

                @foreach($slides as $index => $slide)
                    <div style="width: 450px;height: 550px;margin: 0 10px;overflow: hidden; border: 1px solid #cccccc;">
                        <img style="padding: 0" src="/images/comments/{{ $slide }}" alt="фото отзыв {{ $index }}">
                    </div>
                @endforeach
            </div>--}}


            <!--<a target="_blank" href="https://www.instagram.com/pd_paris/" class="instagram-box__btn">
                ОТКРЫТЬ InSTAGRAM
            </a>-->

            <!-- эти 2 дива, новый блок инста с телефоном ... -->
            <div class="instagram-box__text  instagram-box__back" >
                <div class="instagram-box__desktop ">
                    <div style="margin-left: 50px; padding: 25px;">

                        <p class="instagram-box__title">
                            {{ __('А это — наш ') }}<a target="_blank" href="https://www.instagram.com/pd_paris/"> Instagram </a>
                        </p><br />
                        {{__('в котором вы найдете отзывы клиентов, полезную информацию о парфюмерии и не только, а также — много всего интересного.') }}<br /><br />
                        <strong>{{__('Присоединяйтесь:)')}}</strong> <br /><br />
                    </div>
                    <div  style="position: absolute; right: 75px;">
                        <img src="{{ asset('/images/phone-des.png') }}" alt="phone"  >
                    </div>
                </div>
            </div>

            <div style="position: relative;">
                <div class="instagram-box__mobile text-center" >
                    <p class="instagram-box__title">
                        {{ __('А это — наш ') }}<a target="_blank" href="https://www.instagram.com/pd_paris/"> Instagram </a>
                    </p><br />
                    <p>
                        {{__('в котором вы найдете отзывы клиентов, полезную информацию о парфюмерии и не только, а также — много всего интересного.') }}
                    </p>
                    <br />
                    <strong>{{__('Присоединяйтесь:)')}}</strong> <br /><br />
                </div>
                <div class="instagram-mobile-phone" >
                    <img src="{{ asset('/images/phone-des.png') }}" alt="phone-mobile" width="225px;" >
                </div>
            </div>

        </div>

    </div>
</section>
