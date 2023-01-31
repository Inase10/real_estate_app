<header class="header">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard') }}"><i class="bi bi-building"></i>  عقاراتي</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">الرئيسية </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('addProerty') }}"> <span style="width: 5px; size:5px;">+</span>  اضف عرض جديد</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/myOffers/{{  Auth::user()->id }}">عروضي </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"  href="/myOrders/{{  Auth::user()->id }}">مشترياتي </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#footer">اتصل بنا</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center ">

                    {{-- <a type="button"  href="{{ route('logout') }}"class="btn btn-primary px-3 me-2" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                        </a> --}}
                    <a href={{ route('dashboard.myprofile') }} class="mx-auto">
                        <span>
                            <img src="{{ Auth::user()->avatar }} " width="50"
                                class="img-thumbnail   rounded-circle">
                    </a>

                </div>

            </div>

        </div>




        <form method="POST" action="{{ route('logout') }}" style="margin-left: 10px;">
            @csrf

            <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                {{ __('تسجيل الخروج') }}
            </x-responsive-nav-link>
        </form>



    </nav>
</header>



