<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>عقارات، مرحبا بك في بيتك</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet" />
    <!-- swiper js -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>

<body>

    <!-- header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="#"><i class="bi bi-building"></i> عقاراتي</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">الرئيسية </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">من نحن؟</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#services">الخدمات </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#properties"> العقارات </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#work">اعمالنا </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#testimonials">أراء عملائنا </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#mail">اتصل بنا</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <a type="button" class="btn px-3 me-2" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                            الدخول
                        </a>
                        <a href="{{ route('register') }}"type="button" class="btn btn-primary me-3">
                            تسجيل حساب جديد
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- modal -->
    <div class="modal top fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-mdb-backdrop="static" data-mdb-keyboard="true">
        <div class="modal-dialog  ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تسجيل الدخول</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <!-- Session Status -->

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-outline mb-4">
                            <input type="email" name="email" id="form1Example1" class="form-control" required />
                            <label class="form-label" for="form1Example1">البريد الالكتروني</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="password" name="password"id="form1Example2" class="form-control"
                                required />
                            <label class="form-label" for="form1Example2">كلمة المرور</label>
                        </div>
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="form1Example3" checked />
                                    <label class="form-check-label" for="form1Example3"> ذكرني </label>
                                </div>
                            </div>
                            <div class="col">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                        href="{{ route('password.request') }}">
                                        {{ __('نسيت كلمة السر؟') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                                إغلاق
                            </button>
                            <button type="submit" class="btn btn-primary">الدخول</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <!-- /modal -->
    <!-- /header -->
    <!-- hero section -->
    <section id="hero">
        <div class="container">
            <div class="row">
                <div class="col-md-5 me-auto my-auto">
                    <h1 class="h1 h1-responsive mb-4">
                        ابحث عن بيتك المناسب لدينا
                    </h1>
                    <p>تعمل على تطوير مجتمعات سكنية متكاملة توفر أسلوب حياة عصري وفق أرقى المعايير للشعب السعودي.
                        شركة تطوير عقارية وطنية مملوكة بالكامل لصندوق الاستثمارات العامة.</p>
                    <button class="button" class="btn px-3 me-2" data-mdb-toggle="modal"
                        data-mdb-target="#exampleModal">المزيد</button>
                    <button class="button" href="{{ route('register') }}">ابدأ</button>
                </div>
                <div class="col-md-5 ms-auto my-md-auto mt-4">
                    <div class="image">

                        <img src="{{ asset('/img/restate 1.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /hero section -->

    <!-- about section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="image">
                        <img src="{{ asset('/img/restate 2.jpg') }}" alt="">

                    </div>
                </div>
                <div col-lg-5 class="col-md-6 mt-4">
                    <h6 class="h6 color-accent">من نحن؟</h6>
                    <h1 class="h1 responsive">نقدم لك أفضل العقارات..</h1>
                    <p>تعمل على تطوير مجتمعات سكنية متكاملة توفر أسلوب حياة عصري وفق أرقى المعايير للشعب السعودي.
                        شركة تطوير عقارية وطنية مملوكة بالكامل لصندوق الاستثمارات العامة.</p>
                    <p>تعمل على تطوير مجتمعات سكنية متكاملة توفر أسلوب شركة تطوير عقارية وطنية مملوكة بالكامل لصندوق
                        الاستثمارات العامة.</p>
                    <p>تعمل على تطوير مجتمعات سكنية متكاملة توفر أسلوب شركة .</p>
                    <button class="button" class="btn px-3 me-2" data-mdb-toggle="modal"
                        data-mdb-target="#exampleModal">المزيد</button>
                    <button class="button" href="{{ route('register') }}">ابدأ</button>
                </div>
            </div>
        </div>
    </section>
    <!-- /about section -->
    <!-- services section -->
    <section id="services">
        <div class="container">
            <div class="col-md-12 mx-auto">
                <h6 class="h6 color-accent text-center">ما هي خدماتنا؟</h6>
                <h3 class="h3 responsive text-center mb-5">نقدم لك أفضل الخدمات..</h3>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="shadow service-card">
                            <i class="bi bi-person-circle"></i>
                            <h5 class="h5">اجعل حلمك حقيقة</h5>
                            <p>تعمل على تطوير مجتمعات سكنية متكاملة.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="shadow service-card">
                            <i class="bi bi-laptop"></i>
                            <h5 class="h5">ابدأ عضويتك</h5>
                            <p>تعمل على تطوير مجتمعات سكنية متكاملة.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="shadow service-card">
                            <i class="bi bi-house"></i>
                            <h5 class="h5">استمتع بمنزلك الجديد</h5>
                            <p>تعمل على تطوير مجتمعات سكنية متكاملة.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /services section -->
    <!-- properties section -->
    <section id="properties">
        <div class="container">
            <div class="col-md-12 mx-auto">
                <h6 class="h6 color-accent text-center">ماالجديد؟</h6>
                <h3 class="h3 responsive text-center mb-5">آخر العقارات إضافة..</h3>
                <div class="text-start me-2">
                    <span>مشاهدة المزيد<i class="bi bi-arrow-left ms-1"></i></span>
                </div>
                <!-- property slider -->
                <div id="property-slider">
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach ($offers as $offer)
                                <div class="swiper-slide">
                                    <a data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                                        <div class="style_property">
                                            <div class="property-list shadow">
                                                <div class="image">

                                                    <img src="{{ $offer->cover_image }}" alt="">
                                                </div>
                                                <div class="text-start">
                                                    <h4 class="h5">{{ $offer->price }}</h4>
                                                </div>
                                                <div class="d-flex justify-content-between mb-4">
                                                    <div class="item">
                                                        <h5 class="h5 m-0"><i class="bi bi-geo-alt"></i> الموقع</h4>
                                                            <p class="m-0">{{ $offer->city_name }} , Saudi</p>
                                                    </div>
                                                    <div class="item d-flex">
                                                        <i
                                                            class="mx-1 align-self-center fas fa-bed align-self-center"></i>
                                                        <span class="align-self-center">{{ $offer->room_num }}</span>
                                                        <i class="mx-1 align-self-center fas fa-bath"></i>
                                                        <span class="align-self-center">{{ $offer->bath_num }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- If we need navigation buttons -->
                    </div>
                </div>
                <!-- /property slider -->
            </div>
        </div>
    </section>
    <!-- /properties section -->
    <!-- work section -->
    <section id="work">
        <div class="container">
            <div class="col-md-12 mx-auto">
                <h6 class="h6 color-primary text-center">كيف تعمل؟</h6>
                <h3 class="h3 responsive text-center">أعمالي..</h3>
                <p class="text-center mb-5">تعمل على تطوير مجتمعات سكنية متكاملة توفر أسلوب حياة عصري تطوير <br> عقارية
                    وطنية مملوكة بالكامل لصندوق الاستثمارات العامة.</p>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="service-card">
                            <i class="bi bi-search"></i>
                            <h5 class="h5">منزل جيد</h5>
                            <p>تعمل على تطوير مجتمعات سكنية على تطوير مجتمعات سكنية متكاملة.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="service-card">
                            <i class="bi bi-people"></i>
                            <h5 class="h5">لقاء رفقاء الغرفة</h5>
                            <p>تعمل على تطوير مجتمعات سكنية على تطوير مجتمعات سكنية متكاملة.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="service-card">
                            <i class="bi bi-shield-shaded"></i>
                            <h5 class="h5">اجعلها رسمية</h5>
                            <p>تعمل على تطوير مجتمعات سكنية على تطوير مجتمعات سكنية متكاملة.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /work section -->
    <!--feature section -->
    <section id="feature">
        <div class="container">
            <div class="col-md-12 mx-auto">
                <h6 class="h6 color-accent text-center">ما المميز؟</h6>
                <h3 class="h3 responsive text-center">عقاراتنا المميزة..</h3>
                <p class="text-center mb-5">تعمل على تطوير مجتمعات سكنية متكاملة توفر أسلوب حياة عصري تطوير <br> عقارية
                    وطنية مملوكة بالكامل لصندوق الاستثمارات العامة.</p>
                <div class="row">

                    @foreach ($offers_nice as $offer)
                        <div class="col-md-6 col-lg-3 mb-3">
                            <a data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                                <div class="style_property">
                                    <div class="property-list shadow">
                                        <div class="image">
                                            <img src="{{ $offer->cover_image }}" alt="">
                                        </div>
                                        <div class="text-start">
                                            <h4 class="h5">{{ $offer->price }}</h4>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="item">
                                                <h5 class="h5 m-0"><i class="bi bi-geo-alt"></i> الموقع</h4>
                                                    <p class="m-0">{{ $offer->city_name }} , Saudi</p>
                                            </div>
                                            <div class="item d-flex">
                                                <i class="mx-1 align-self-center fas fa-bed align-self-center"></i>
                                                <span class="align-self-center">{{ $offer->room_num }}</span>
                                                <i class="mx-1 align-self-center fas fa-bath"></i>
                                                <span class="align-self-center">{{ $offer->bath_num }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
                {{-- <div class="text-start my-2">
                    <button class="button">مشاهدة المزيد</button>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- /feature section -->
    <!-- testimonials section -->
    <section id="testimonials">
        <div class="container">
            <div class="col-md-12 mx-auto">
                <h6 class="h6 color-primary text-center">ماذا قال الزبائن؟</h6>
                <h3 class="h3 responsive text-center">قالوا عنا..</h3>
                <p class="text-center mb-5">تعمل على تطوير مجتمعات سكنية متكاملة توفر أسلوب حياة عصري تطوير <br> عقارية
                    وطنية مملوكة بالكامل لصندوق الاستثمارات العامة.</p>
                <!-- testimonials slider -->
                <div id="testimonials-slider">
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide">
                                <div class="testimonial-list">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="image shadow">
                                                <img src="{{ asset('/img/restate 3.jpg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="offset-md-1 col-md-6">
                                            <i class="fas fa-quote-right fa-8x"></i>
                                            <p class="my-3">تعمل على تطوير مجتمعات سكنية متكاملة توفر أسلوب حياة عصري
                                                وفق أرقى المعايير للشعب السعودي. شركة تطوير عقارية وطنية مملوكة
                                                بالكامل لصندوق الاستثمارات العامة.</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- If we need navigation buttons -->
                    </div>
                </div>
                <!-- /testimonials slider -->
            </div>
        </div>
    </section>
    <!-- /testimonials section -->
    <!-- mail section -->
    <section id="mail">
        <div class="container">
            <div class="col-md-12 mx-auto">
                <h1 class="h1 responsive text-center">لديك استفسارات؟</h1>
                <h1 class="h1 responsive text-center mb-4"> لا تتردد في طلب المساعدة..</h1>
            </div>
            <div class="form col-md-8 mx-auto shadow">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <input dir="rtl" type="email" class="form-control" placeholder="yourmail@domain.com">
                    </div>
                    <div class="col-md-3">
                        <button class="button">إرسال</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /mail section -->
    <!-- footer section -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 logo pb-5">
                    <i class="bi bi-building"></i><span> عقاراتي</span>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h6 class="h6 m-0">روابط سريعة</h6>
                    <hr>
                    <ul>
                        <li><i class="bi bi-chevron-left"></i><a href="#">هندسة معمارية</a></li>
                        <li><i class="bi bi-chevron-left"></i><a href="#">وكالة</a></li>
                        <li><i class="bi bi-chevron-left"></i><a href="#">تقلب الأصول</a></li>
                        <li><i class="bi bi-chevron-left"></i><a href="#">بناء</a></li>
                        <li><i class="bi bi-chevron-left"></i><a href="#">معدلات الأعمال</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h6 class="h6 m-0">المناطق</h6>
                    <hr>
                    <ul>
                        <li><i class="bi bi-chevron-left"></i><a href="#">الشمال</a></li>
                        <li><i class="bi bi-chevron-left"></i><a href="#">الوسط</a></li>
                        <li><i class="bi bi-chevron-left"></i><a href="#">الجنوب</a></li>
                        <li><i class="bi bi-chevron-left"></i><a href="#">الشرق</a></li>
                        <li><i class="bi bi-chevron-left"></i><a href="#">الغرب</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h6 class="h6 m-0">معلومات الاتصال</h6>
                    <hr>
                    <ul>
                        <li><i class="bi bi-telephone"></i> <span style="direction: ltr !important;"> +966 xxx xxx xxx</span></li>
                        <li><i class="bi bi-phone"></i> +966 xxx xxx xxx</li>
                        <li><i class="bi bi-envelope"></i>contact@gmail.com</li>
                        <li><i class="bi bi-geo"></i> الرياض , السعودية</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- /footer section -->

    <!-- swiper js -->
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/js/script.js') }}"></script>


</body>

</html>
