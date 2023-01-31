
   @if (Auth::user()->user_type=="Seller")
   @include('layouts.head-home')
   @include('layouts.navbar-home')
   @elseif(Auth::user()->user_type=="Customer")
   @include('layouts.head-home')
   @include('layouts.navbar-home_customer')

   @endif
 <section id="feature">
    <div class="container">
        <div class="col-md-12 mx-auto">

            @if($myorders_approved->isEmpty())
لايوجد طلبات تم الموافقة عليها
            @else
            <h6 class="h6 color-accent text-center">طلبات الشراء التي تمت الموافقة عليها...</h6>

            <div class="row">

                @foreach ($myorders_approved as $order )

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="style_property">
            <div class="property-list shadow">
                <div class="image">
                    <img src="{{ $order->cover_image }}" alt="">
                </div>
                <div class="text-start">
                    <h4 class="h5">{{ $order->price }}ل.س</h4>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <div class="item">
                        <h5 class="h5 m-0"><i class="bi bi-geo-alt"></i> الموقع</h4>
                            <p class="m-0">{{ $order->city_name}} , syria</p>
                    </div>
                    <div class="item">
                        @if($order->offer_type=="Sale")
                      <p class="m-0"> عرض للبيع</p>
                      @endif
                      @if($order->offer_type=="rent")
                        <p class="m-0"> عرض للإيجار</p>
                        @endif
                    </div>
                    <div class="item d-flex">
                        <i class="mx-1 align-self-center fas fa-bed align-self-center"></i>
                        <span class="align-self-center">{{ $order->room_num}}</span>
                        <i class="mx-1 align-self-center fas fa-bath"></i>
                        <span class="align-self-center">{{ $order->bath_num}}</span>
                    </div>
                </div>
            </div>
            </div>
        </div>
        @endforeach


        </div>
        @endif
    </div>




</section>
<section id="feature">
    <div class="container">
        <div class="col-md-12 mx-auto">
            @if($myorders_rejected->isEmpty())
            لايوجد طلبات تم رفضها
                        @else
            <h6 class="h6 color-accent text-center">طلبات الشراء التي تم رفضها  ...</h6>

            <div class="row">

                @foreach ($myorders_rejected as $order )
                {{-- @if($order->status=="approved") --}}
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="style_property">
            <div class="property-list shadow">
                <div class="image">
                    <img src="{{ $order->cover_image }}" alt="">
                </div>
                <div class="text-start">
                    <h4 class="h5">{{ $order->price }}ل.س</h4>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <div class="item">
                        <h5 class="h5 m-0"><i class="bi bi-geo-alt"></i> الموقع</h4>
                            <p class="m-0">{{ $order->city_name}} , syria</p>
                    </div>
                    <div class="item">
                        @if($order->offer_type=="Sale")
                      <p class="m-0"> عرض للبيع</p>
                      @endif
                      @if($order->offer_type=="rent")
                        <p class="m-0"> عرض للإيجار</p>
                        @endif
                    </div>
                    <div class="item d-flex">
                        <i class="mx-1 align-self-center fas fa-bed align-self-center"></i>
                        <span class="align-self-center">{{ $order->room_num}}</span>
                        <i class="mx-1 align-self-center fas fa-bath"></i>
                        <span class="align-self-center">{{ $order->bath_num}}</span>
                    </div>
                </div>
            </div>
            </div>
        </div>

        @endforeach


        </div>
        @endif
    </div>




</section>
<section id="feature">
    <div class="container">
        <div class="col-md-12 mx-auto">
            @if($myorders_pending->isEmpty())
            لايوجد طلبات معلقة
                        @else
            <h6 class="h6 color-accent text-center">طلبات الشراء المعلقة من قبل مدير الموقع...</h6>

            <div class="row">

                @foreach ($myorders_pending as $order )
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="style_property">
            <div class="property-list shadow">
                <div class="image">
                    <img src="{{ $order->cover_image }}" alt="">
                </div>
                <div class="text-start">
                    <h4 class="h5">{{ $order->price }}ل.س</h4>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <div class="item">
                        <h5 class="h5 m-0"><i class="bi bi-geo-alt"></i> الموقع</h4>
                            <p class="m-0">{{ $order->city_name}} , syria</p>
                    </div>
                    <div class="item">
                        @if($order->offer_type=="Sale")
                      <p class="m-0"> عرض للبيع</p>
                      @endif
                      @if($order->offer_type=="rent")
                        <p class="m-0"> عرض للإيجار</p>
                        @endif
                    </div>
                    <div class="item d-flex">
                        <i class="mx-1 align-self-center fas fa-bed align-self-center"></i>
                        <span class="align-self-center">{{ $order->room_num}}</span>
                        <i class="mx-1 align-self-center fas fa-bath"></i>
                        <span class="align-self-center">{{ $order->bath_num}}</span>
                    </div>
                </div>
            </div>
            </div>
        </div>
        @endforeach


        </div>
        @endif
    </div>




</section>
@include('layouts.footer-home')
@include('layouts.footer-script-home')
