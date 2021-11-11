<!-- slider from parfumdeparis.biz -->
<!--<div class="slider main-slider" style="max-height: 730px !important; overflow-y:hidden !important;">-->
<div class="owl-carousel" style="max-height: 730px !important; overflow-y:hidden !important;">

    <div>
        <div class="desktop" style="width:100%;">
            <a href="#woman"><img src="{{ app()->getLocale()==='ru' ? '/images/main_des_ru.jpg' : '/images/main_des_ua.jpg' }}" style="width: 100%; border: 0;"></a>
        </div>
        <div class="mobile" style="width:100%;">
            <a href="#woman"><img src="{{ app()->getLocale()==='ru' ? '/images/main_mob_ru.jpg' : '/images/main_mob_ua.jpg' }}" style="width: 100%; border: 0;"></a>
        </div>
    </div>

    <div>
        <div class="desktop" style="width:100%;">
            <a href="#woman"><img src="{{ app()->getLocale()==='ru' ? '/images/woman_des_ru.jpg' : '/images/woman_des_ua.jpg' }}" style="width: 100%; border: 0;"></a>
        </div>
        <div class="mobile" style="width:100%;">
            <a href="#woman"><img src="{{ app()->getLocale()==='ru' ? '/images/woman_mob_ru.jpg' : '/images/woman_mob_ua.jpg' }}" style="width: 100%; border: 0;"></a>
        </div>
    </div>

    <div>
        <div class="desktop" style="width:100%;">
            <a href="#man"><img src="{{ app()->getLocale()==='ru' ? '/images/man_des_ru.jpg' : '/images/man_des_ua.jpg' }}" style="width: 100%; border: 0;"></a>
        </div>
        <div class="mobile" style="width:100%;">
            <a href="#man"><img src="{{ app()->getLocale()==='ru' ? '/images/man_mob_ru.jpg' : '/images/man_mob_ua.jpg' }}" style="width: 100%; border: 0;"></a>
        </div>
    </div>

    {{--<div>
        <div class="desktop" style="width:100%;">
            <a href="#auto"><img src="{{ app()->getLocale()==='ru' ? '/images/auto_des_ru.jpg' : '/images/auto_des_ua.jpg' }}" style="width: 100%; border: 0;"></a>
        </div>
        <div class="mobile" style="width:100%;">
            <a href="#auto"><img src="{{ app()->getLocale()==='ru' ? '/images/auto_mob_ru.jpg' : '/images/auto_mob_ua.jpg' }}" style="width: 100%; border: 0;"></a>
        </div>
    </div>--}}
    <div>
        @if(app()->getLocale()==='ru')
            <div class="desktop" style="width:100%;">
                <a :href="[countAuto ? '#auto' : '#woman']"><img :src="[countAuto ? '/images/auto_des_ru.jpg' : '/images/woman_des_ru.jpg']" style="width: 100%; border: 0;"></a>
            </div>
            <div class="mobile" style="width:100%;">
                <a :href="[countAuto ? '#auto' : '#woman']"><img :src="[countAuto ? '/images/auto_mob_ru.jpg' : '/images/woman_mob_ru.jpg']" style="width: 100%; border: 0;"></a>
            </div>
        @elseif(app()->getLocale()==='ua')
            <div class="desktop" style="width:100%;">
                <a :href="[countAuto ? '#auto' : '#woman']"><img :src="[countAuto ? '/images/auto_des_ua.jpg' : '/images/woman_des_ua.jpg']" style="width: 100%; border: 0;"></a>
            </div>
            <div class="mobile" style="width:100%;">
                <a :href="[countAuto ? '#auto' : '#woman']"><img :src="[countAuto ? '/images/auto_mob_ua.jpg' : '/images/woman_mob_ua.jpg']" style="width: 100%; border: 0;"></a>
            </div>
        @endif
    </div>

    <div>
        @if(app()->getLocale()==='ru')
            <div class="desktop" style="width:100%;">
                <a :href="[countSeptics ? '#septics' : '#man']"><img :src="[countSeptics ? '/images/anti_des_ru.jpg' : '/images/man_des_ru.jpg']" style="width: 100%; border: 0;"></a>
            </div>
            <div class="mobile" style="width:100%;">
                <a :href="[countSeptics ? '#septics' : '#man']"><img :src="[countSeptics ? '/images/anti_mob_ru.jpg' : '/images/man_mob_ru.jpg']" style="width: 100%; border: 0;"></a>
            </div>
        @elseif(app()->getLocale()==='ua')
            <div class="desktop" style="width:100%;">
                <a :href="[countSeptics ? '#septics' : '#man']"><img :src="[countSeptics ? '/images/anti_des_ua.jpg' : '/images/man_des_ua.jpg']" style="width: 100%; border: 0;"></a>
            </div>
            <div class="mobile" style="width:100%;">
                <a :href="[countSeptics ? '#septics' : '#man']"><img :src="[countSeptics ? '/images/anti_mob_ua.jpg' : '/images/man_mob_ua.jpg']" style="width: 100%; border: 0;"></a>
            </div>
        @endif
    </div>

    <div>
        @if(app()->getLocale()==='ru')
        <div class="desktop" style="width:100%;">
            <a :href="[countGel ? '#gel' : '#woman']"><img :src="[countGel ? '/images/gel_des_ru.jpg' : '/images/woman_des_ru.jpg']" style="width: 100%; border: 0;"></a>
        </div>
        <div class="mobile" style="width:100%;">
            <a :href="[countGel ? '#gel' : '#woman']"><img :src="[countGel ? '/images/gel_mob_ru.jpg' : '/images/woman_mob_ru.jpg']" style="width: 100%; border: 0;"></a>
        </div>
        @elseif(app()->getLocale()==='ua')
        <div class="desktop" style="width:100%;">
            <a :href="[countGel ? '#gel' : '#woman']"><img :src="[countGel ? '/images/gel_des_ua.jpg' : '/images/woman_des_ua.jpg']" style="width: 100%; border: 0;"></a>
        </div>
        <div class="mobile" style="width:100%;">
            <a :href="[countGel ? '#gel' : '#woman']"><img :src="[countGel ? '/images/gel_mob_ua.jpg' : '/images/woman_mob_ua.jpg']" style="width: 100%; border: 0;"></a>
        </div>
        @endif
    </div>

</div>
<!-- slider -->
