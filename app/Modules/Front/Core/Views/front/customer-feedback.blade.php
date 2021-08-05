<section class="instagram-box">
    <div class="wrapper">
        <div class="instagram-box__inner">
            <div class="instagram-box__header">
                <div class="instagram-box__icon"></div>
                <div class="instagram-box__title">
                    #PDPARIS
                </div>
                <div class="instagram-box__text">
                    <!--Следите за новинками в нашем Instagram-->
                    Впечатления наших клиентов
                </div>
            </div>


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

            <div class="instagram-box__slider">
                <?php
                $slides = [];
                for ($i=1; $i<=352; $i++) {
                    $slides[] = $i.'.png?5';
                }
                shuffle($slides);
                array_slice($slides, 0, 15);
                foreach ($slides as $slide) {
                ?>

                <div style="width: 450px;height: 550px;margin: 0 10px;overflow: hidden; border: 1px solid #cccccc;">
                    <img style="padding: 0" src="/images/comments/<?=$slide ?>" alt="">
                </div>

                <?php } ?>
            </div>


            <!--<a target="_blank" href="https://www.instagram.com/pd_paris/" class="instagram-box__btn">
                ОТКРЫТЬ InSTAGRAM
            </a>-->

        </div>

    </div>
</section>