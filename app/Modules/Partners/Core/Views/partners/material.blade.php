@extends('adminlte.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card col-md-8 col-sm-12 mx-auto pt-2">
                <div class="mb-3">
                    <p class="h4 text-center ">Фото пробников</p>
                    <img style="max-width: 100%;"  src="{{ asset('/images/tester.jpg') }}" alt="pic">
                    <p class="h4 text-center ">Заказать пробники вы можете по данной ссылке</p>
                    <p class="h4 text-center ">
                        <a href="https://pdparfum.com/19" target="_blank" >https://pdparfum.com/19</a>
                    </p>

                    <p class="h4 text-center mt-4">Макеты-баннеры для instagram / социальных сетей </p>
                    <p class="h4 text-center">(нажмите для открытия полного размера)</p>
                </div>
                </div>

            </div>

            {{--<div class="row">

                <div class="d-flex align-items-end">
                    <div class="mr-2">
                        <a href="#" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-xl">
                            <img style="width: 300px;" src="{{ asset('/images/insta_stories_250.jpg') }}" alt="pic">
                        </a>
                    </div>

                    <div class="mr-2">
                        <img style="width: 300px; vertical-align: bottom;" src="{{ asset('/images/insta_250.jpg') }}" alt="pic">
                    </div>

                    <div class="mr-2">
                        <img style="width: 300px; vertical-align: bottom;" src="{{ asset('/images/fb_post_250.jpg') }}" alt="pic">
                    </div>
                </div>
            </div>--}}

            <div class="card col-md-8 col-sm-12 mx-auto pt-2">
                <div class="row align-items-end" >

                    <div class="col-sm-2">
                        <a href="{{ asset('/images/insta_stories_250.jpg') }}?text=1" data-toggle="lightbox" data-title="Макет-баннер 1" data-gallery="gallery">
                            <img src="{{ asset('/images/insta_stories_250.jpg') }}?text=1" class="img-fluid mb-2" alt="white sample"/>
                        </a>
                    </div>
                    <div class="col-sm-2 align-bottom">
                        <a href="{{ asset('/images/insta_250.jpg') }}?text=2" data-toggle="lightbox" data-title="Макет-баннер 2" data-gallery="gallery">
                            <img src="{{ asset('/images/insta_250.jpg') }}?text=2" class="img-fluid mb-2" alt="black sample"/>
                        </a>
                    </div>
                    <div class="col-sm-2 align-bottom">
                        <a href="{{ asset('/images/fb_post_250.jpg') }}?text=3" data-toggle="lightbox" data-title="Макет-баннер 3" data-gallery="gallery">
                            <img src="{{ asset('/images/fb_post_250.jpg') }}?text=3" class="img-fluid mb-2" alt="red sample"/>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
