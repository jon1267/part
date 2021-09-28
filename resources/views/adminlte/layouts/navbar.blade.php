<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav mx-auto">

        @if(auth()->user()->domain != '')

            <div class="row">
                <!--<div id="donesite" class="col-md-6 col-sm-10">-->
                <div id="donesite" class="col-sm-12">
                    <div class="input-group input-group-sm align-items-center pb-1">
                        <span class="mr-3">Ваш сайт</span>
                        <input id="done-site-input" class="form-control" style="text-align: center; font-size: 16px; " type="text" onclick="copyToClipboard()" value="{{ auth()->user()->domain.'.pdparis.com' }}" readonly >
                    </div>
                </div>
                {{--<div class="col-md-6 col-sm-10">
                    <div class="input-group input-group-sm align-items-center">
                        <span class="mr-2">Украшения</span>
                        <input class="form-control " style="font-size: 16px; " type="text" value="http://luxury-sets.com.ua/?p={{ auth()->user()->kod }}" readonly > <span class="m-2"></span>
                    </div>
                </div>--}}
            </div>
        @endif

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ">
        <!-- Navbar Search -->

        <li class="nav-item">
            <!--<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>-->
            <form id="logout-form-navbar" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

            <a class="nav-link" href="{{ route('logout') }}" title="Выход"
               onclick="event.preventDefault();
                        document.getElementById('logout-form-navbar').submit();">
                <i class="fas fa-sign-out-alt nav-icon "></i>
            </a>
        </li>
    </ul>
</nav>
<script>
    function copyToClipboard() {
        let copyText = document.getElementById("done-site-input"); /* Get the text field */

        copyText.select(); /* select the text field */
        copyText.setSelectionRange(0, 99999); /* for mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);
    }
</script>
