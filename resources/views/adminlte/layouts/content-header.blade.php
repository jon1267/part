<div class="content-header">
    <div class="container-fluid">
        <!--<div class="row mb-2">-->
        <div class="row ">
            <div class="col-sm-8">
                {{--<div>
                    <h1 class="m-0">{{ $title ?? 'Кабинет Партнера' }}</h1>
                </div>--}}
                <div>
                    @if(auth()->user()->domain == '')
                        @include('partners.create-site')
                    @else
                        {{--<div>
                            <h1 class="m-0">{{ $title ?? 'Кабинет Партнера' }}</h1>
                        </div>--}}
                    @endif
                </div>
            </div>

            <!--<div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Starter Page</li>
                </ol>
            </div>-->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
