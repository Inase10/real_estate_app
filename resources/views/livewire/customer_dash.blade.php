<section id="feature">
    @include('layouts.search')

    <div>
        <div class="container">
            <div class="col-md-12 mx-auto">
                <h3 class="h3 color-accent text-center">ما المميز؟</h3>

                <h3 class="h3 responsive text-center"> يوجد حسم وخصومات مميزة لعملاءنا المميزين<h3>
                        <h6 class="h6 color-accent text-center">مشتري مميز يحصل على تخفيض 5% </h6>
                        <h6 class="h6 color-accent text-center">مشتري vip يحصل على تخفيض 10% </h6>

                        <h3 class="h3 responsive text-center">عقاراتنا المميزة..</h3>
                        <p class="text-center mb-5">تعمل على تطوير مجتمعات سكنية متكاملة توفر أسلوب حياة عصري تطوير <br>
                            عقارية
                            وطنية مملوكة بالكامل لصندوق الاستثمارات العامة.</p>
                        <div class="row">
                            @foreach ($offers as $offer)
                                <div class="col-md-6 col-lg-3 mb-3">
                                    <a href="detail/{{ $offer->property_id }}">
                                        <div class="style_property">

                                            <div class="property-list shadow">
                                                <div class="image">
                                                    <img src="{{ $offer->cover_image }}" alt="">
                                                </div>
                                                <div class="text-start">
                                                    @if (Auth::user()->Rank >= 9)
                                                        <del style="color:red;">
                                                            <h4 class="h5">{{ $offer->price }}ريال سعودي</h4>
                                                        </del>
                                                        <h4 class="h5">{{ $offer->price * 0.9 }}ريال سعودي</h4>
                                                    @elseif(Auth::user()->Rank >= 3 && Auth::user()->Rank <= 8)
                                                        <del style="color:red;">
                                                            <h4 class="h5">{{ $offer->price }}ريال سعودي</h4>
                                                        </del>
                                                        <h4 class="h5">{{ $offer->price * 0.95 }}ريال سعودي</h4>
                                                    @else
                                                        <h4 class="h5">{{ $offer->price }}ريال سعودي</h4>
                                                    @endif
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
                        @if ($offers->total() > 0 && $offers->count() < $offers->total())
                            <div class="text-start my-2">
                                <button wire:click='load_more()' class="button">مشاهدة المزيد</button>
                            </div>
                        @endif
            </div>

        </div>

</section>


@include('livewire.section_map')
