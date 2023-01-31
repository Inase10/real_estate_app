@include('layouts.head-home')
@include('layouts.navbar-home')

@include('layouts.js.messger_alert')

<section id="feature">
    <div class="container">
        <div class="col-md-12 mx-auto">
            @if ($myoffers_approved->isEmpty())


                لايوجد عروض للبيع أو الإيجار
            @else
                <h6 class="h6 color-accent text-center"> العقارات المعروضة للبيع...</h6>
                <div class="row">
                    @foreach ($myoffers_approved as $offer)
                        <div class="col-md-6 col-lg-3 mb-3">
                            <a href="edit_offer/{{ $offer->property_id }}">
                                <div class="style_property">
                                    <div class="property-list shadow">
                                        <div class="image">
                                            <img src="{{ $offer->cover_image }}" alt="">
                                        </div>
                                        <div class="text-start">
                                            <h4 class="h5">{{ $offer->price }}ريال سعودي</h4>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="item">
                                                <h5 class="h5 m-0"><i class="bi bi-geo-alt"></i> الموقع</h4>
                                                    <p class="m-0">{{ $offer->city_name }} , Saudi</p>
                                            </div>
                                            <div class="item">
                                                @if ($offer->offer_type == 'Sale')
                                                    <p class="m-0"> عرض للبيع</p>
                                                @endif
                                                @if ($offer->offer_type == 'rent')
                                                    <p class="m-0"> عرض للإيجار</p>
                                                @endif
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
            @endif

        </div>
    </div>
</section>

<section id="feature">

    <div class="container">
        <div class="col-md-12 mx-auto">
            @if ($myoffers_rejected->isEmpty())


                لايوجد عروض تم رفضها
            @else
                <h6 class="h6 color-accent text-center"> العقارات التي تم رفضها ...</h6>

                <div class="row">

                    @foreach ($myoffers_rejected as $offer)
                        <div class="col-md-6 col-lg-3 mb-3">
                            <a href="edit_offer/{{ $offer->property_id }}">
                                <div class="style_property">
                                    <div class="property-list shadow">
                                        <div class="image">
                                            <img src="{{ $offer->cover_image }}" alt="">
                                        </div>
                                        <div class="text-start">
                                            <h4 class="h5">{{ $offer->price }}ريال سعودي</h4>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="item">
                                                <h5 class="h5 m-0"><i class="bi bi-geo-alt"></i> الموقع</h4>
                                                    <p class="m-0">{{ $offer->city_name }} , Saudi</p>
                                            </div>
                                            <div class="item">
                                                @if ($offer->offer_type == 'Sale')
                                                    <p class="m-0"> عرض للبيع</p>
                                                @endif
                                                @if ($offer->offer_type == 'rent')
                                                    <p class="m-0"> عرض للإيجار</p>
                                                @endif
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
            @endif

        </div>
    </div>
</section>
<section id="feature">


    <div class="container">
        <div class="col-md-12 mx-auto">
            @if ($myoffers_pending->isEmpty())


                لايوجد عروض معلقة
            @else
                <h6 class="h6 color-accent text-center"> العقارات المعلقة من قبل مدير الموفع ...</h6>

                <div class="row">

                    @foreach ($myoffers_pending as $offer)
                        <div class="col-md-6 col-lg-3 mb-3">
                            <a href="edit_offer/{{ $offer->property_id }}">
                                <div class="style_property">
                                    <div class="property-list shadow">
                                        <div class="image">
                                            <img src="{{ $offer->cover_image }}" alt="">
                                        </div>
                                        <div class="text-start">
                                            <h4 class="h5">{{ $offer->price }}ريال سعودي</h4>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="item">
                                                <h5 class="h5 m-0"><i class="bi bi-geo-alt"></i> الموقع</h4>
                                                    <p class="m-0">{{ $offer->city_name }} , Saudi</p>
                                            </div>
                                            <div class="item">
                                                @if ($offer->offer_type == 'Sale')
                                                    <p class="m-0"> عرض للبيع</p>
                                                @endif
                                                @if ($offer->offer_type == 'rent')
                                                    <p class="m-0"> عرض للإيجار</p>
                                                @endif
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
            @endif

        </div>
    </div>

</section>
<section id="feature">

    <div class="container">
        <div class="col-md-12 mx-auto">
            @if ($myoffers_sold->isEmpty())


                لايوجد عروض تم بيعها عن طريق الموقع
            @else
                <h6 class="h6 color-accent text-center"> العقارات التي تم بيعها ...</h6>

                <div class="row">

                    @foreach ($myoffers_sold as $offer)
                        <div class="col-md-6 col-lg-3 mb-3">

                            <div class="style_property">
                                <div class="property-list shadow">
                                    <div class="image">
                                        <img src="{{ $offer->cover_image }}" alt="">
                                    </div>
                                    <div class="text-start">
                                        <h4 class="h5">{{ $offer->price }}ريال سعودي</h4>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <div class="item">
                                            <h5 class="h5 m-0"><i class="bi bi-geo-alt"></i> الموقع</h4>
                                                <p class="m-0">{{ $offer->city_name }} , Saudi</p>
                                        </div>
                                        <div class="item">
                                            @if ($offer->offer_type == 'Sale')
                                                <p class="m-0"> عرض للبيع</p>
                                            @endif
                                            @if ($offer->offer_type == 'rent')
                                                <p class="m-0"> عرض للإيجار</p>
                                            @endif
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
                        </div>
                    @endforeach

                </div>
            @endif

        </div>
    </div>
</section>


@include('layouts.footer-home')
@include('layouts.footer-script-home')
