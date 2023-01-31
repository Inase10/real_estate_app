@if (Auth::user()->user_type == 'Seller')
    @include('layouts.head-home')
    @include('layouts.navbar-home')
@elseif(Auth::user()->user_type == 'Customer')
    @include('layouts.head-home')
    @include('layouts.navbar-home_customer')
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Image Change</title>
    <link rel="stylesheet" href=" {{ asset('css/style_detail.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    @include('layouts.js.messger_alert')

    <div class="main-wrapper">
        <div class="container">
            <div class="product-div">
                <div class="product-div-left">
                    <div class="img-container">
                        <img class="img_detail"src="images/w1.png" alt="watch">
                    </div>
                    <div class="hover-container">
                        @foreach ($property as $item)
                            <div><img class="img_detail" src="{{ $item->path }}"></div>
                        @endforeach
                        <div><img class="img_detail" src="{{ $item->cover_image }}"></div>
                    </div>
                </div>
                <div class="product-div-right">
                    <span class="product-name">مواصفات العقار</span>
                    <span class="product-price">ل.س{{ $property[0]->price }}</span>
                    <div class="product-rating">


                    </div>
                    <div class="product-description">
                        <div>
                            عدد غرف النوم: {{ $property[0]->room_num }}.
                            <br>
                        </div>
                        <div>
                            عدد الحمامات: {{ $property[0]->bath_num }}.
                            <br>
                        </div>
                        <div>
                            وصف العقار:
                            <br>
                            {{ $property[0]->disc }}.
                            <br>
                        </div>
                        <div>


                            المحافظة : {{ $property[0]->city_name }}.
                            <br>
                        </div>
                        <div>
                            مساحة العقار : {{ $property[0]->area }}.
                            <br>
                        </div>
                        @if ($property[0]->offer_type == 'rent')
                            <div>
                                سعر الإيجار لليوم الواحد : {{ $property[0]->price_rent_per_day }}.
                                <br>
                            </div>
                        @endif
                        @if ($property[0]->type != 'land' && $property[0]->type != 'house')
                            <div>
                                الطابق : {{ $property[0]->storey }}.
                                <br>
                            </div>
                        @endif
                        @if ($property[0]->offer_type == 'Sale')
                            <div>
                                السعر للبيع : {{ $property[0]->price }}.
                                <br>
                            </div>
                        @endif
                        <div>
                            نوع العقار : {{ $property[0]->type }}.
                        </div>

                    </div>
                    <form method="post" action="{{ route('store_order_buy') }}">
                        @csrf

                        <input type="hidden" id="offer_id" name="offer_id" value="{{ $offer[0]->id }}">

                        <input type="hidden" id="customer_id" name="customer_id" value="{{ Auth::user()->id }}">
                        <div class="btn-groups">
                            @if ($property[0]->offer_type == 'rent')
                                <button onclick="openFormDate()" type="button" class="add-cart-btn"><i
                                        class="fas fa-shopping-cart"></i>طلب إيجار الأن</button>
                            @endif
                            @if ($property[0]->offer_type == 'Sale')
                                <button type="submit" href="{{ route('store_order_buy') }}" class="buy-now-btn"><i
                                        class="fas fa-wallet"></i>طلب شراء الأن</button>
                            @endif
                        </div>
                    </form>
                    <form method="post" action="{{ route('store_order_rent') }}">
                        @csrf

                        <input type="hidden" id="offer_id" name="offer_id" value="{{ $offer[0]->id }}">

                        <input type="hidden" id="customer_id" name="customer_id" value="{{ Auth::user()->id }}">
                        <br><br><br>
                        <div id="date" style="display: none;">

                            <label for="start">تاريخ تسليم العقار لصاحبه :</label>

                            <input type="date" id="end_date" name="end_date" value="2022-9-1" min="2022-01-01"
                                max="2025-12-31"
                                style=" border-style: solid;
                               border-width: 15px;">
                            <br>
                            <br>
                            <br>
                            <button class="btn btn-danger" onclick="closeFormDate()" type="button"
                                class="add-cart-btn">الغاء طلب الإيجار </button>
                            <button class="btn btn-primary" onclick="closeFormDate()"
                                href="{{ route('store_order_rent') }}" type="submit" class="add-cart-btn">إرسال الطلب
                                الأن </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src={{ asset('js/script_detail.js') }}></script>

</body>

</html>
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("end_date").setAttribute("min", today);
    // end_date.min = new Date().toISOString().split("T")[0];
    function openFormDate() {
        document.getElementById("date").style.display = "block";
    }

    function closeFormDate() {
        document.getElementById("date").style.display = "none";
    }
</script>
@include('layouts.footer-home')
@include('layouts.footer-script-home')
