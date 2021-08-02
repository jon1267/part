@extends('adminlte.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="mb-3">
                    <p class="h4 text-center ">Фото пробников</p>
                    <img style="max-width: 800px;"  src="{{ asset('/images/tester.jpg') }}" alt="pic">
                    <p class="h4 text-center ">Заказать пробники вы можете по данной ссылке</p>
                    <p class="h4 text-center ">
                        <a href="https://pdparfum.com/19">https://pdparfum.com/19</a>
                    </p>

                    <p class="h4 text-center mt-4">Макеты-баннеры для instagram / социальных сетей </p>
                    <p class="h4 text-center">(нажмите для открытия полного размера)</p>
                </div>

            </div>

            <div class="row">

                <div class="d-flex align-items-end">
                    <div class="mr-2">
                        <img style="width: 300px;" src="{{ asset('/images/insta_stories_250.jpg') }}" alt="pic">
                    </div>

                    <div class="mr-2">
                        <img style="width: 300px; vertical-align: bottom;" src="{{ asset('/images/insta_250.jpg') }}" alt="pic">
                    </div>

                    <div class="mr-2">
                        <img style="width: 300px; vertical-align: bottom;" src="{{ asset('/images/fb_post_250.jpg') }}" alt="pic">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
