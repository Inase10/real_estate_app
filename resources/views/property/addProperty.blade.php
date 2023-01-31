@include('layouts.head-home')

@include('layouts.navbar-home')

@include('layouts.js.messger_alert')

<section>
    <h3 class="text-center text-primary mb-5"> اضافة عقار </h3>
    <form action="{{ route('store_property_seller') }}" method="POST" id="add_property_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="city_name" id="city_name" class="form-control" placeholder="المحافظة">
        <input type="hidden" class="form-control" placeholder="lat" name="lat" id="lat">
        <input type="hidden" class="form-control" placeholder="lng" name="lng" id="lng">
        <input type="hidden" id="seller_id" name="seller_id" value="{{ Auth::user()->id }}">
        <div class="modal-body p-4 bg-light">
            <div class="row">
                <div class="col-lg">
                    <label for="area">المساحة</label>
                    <input type="text" id="area"name="area" class="form-control" placeholder="المساحة"
                        required>
                </div>
                <div class="col-lg">
                    <label for="price">السعر</label>
                    <input type="text" id="price" name="price" class="form-control" placeholder="السعر">
                </div>
                <div class="col-lg">
                    <label for="price">السعر لليوم الواحد في حال الإيجار</label>
                    <input type="text" id="price_per_day" name="price_per_day" class="form-control"
                        placeholder="السعر لليوم الواحد في حال الإيجار" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <label for="room_num">عدد غرف النوم </label>
                    <input type="text" id="room_num"name="room_num" class="form-control"
                        placeholder="عدد غرف النوم ">
                </div>
                <div class="col-lg">
                    <label for="storey">الطابق</label>
                    <input type="text" id="storey" name="storey" class="form-control" placeholder="الطابق">
                </div>
                <div class="col-lg">
                    <label for="city_name">اسم المحافظة </label>
                    <input type="text" name="city_name1" id="city_name1" class="form-control" placeholder="المحافظة"
                        disabled>
                </div>

            </div>
            <div class="row">

                <div class="col-lg">
                    <label for="bath_num">عدد الحمامات</label>
                    <input type="text" name="bath_num" id="bath_num" class="form-control"
                        placeholder=" عدد الحمامات">
                </div>
                <div class="col-lg">
                    <label for="images">صور للعقار</label>
                    <input type="file" name="images[]" id="images"multiple class="form-control" accept="image/*">
                </div>


                <div class="my-2">
                    <label for="avatar"> صورة الغلاف للعرض</label>
                    <input type="file" id="cover_image" name="cover_image" class="form-control">
                </div>
                <div class="my-2">
                    <div> <label for="disc">وصف العقار</label></div>
                    <textarea id="disc"name="disc" cols="166" rows="6"></textarea>
                </div>
                <div class="col-lg">
                    <label for="property_type"> نوع العقار</label>
                    <select name="property_type" id="property_type" class="form-control">
                        <option value="apartment">شقة</option>
                        <option value="land">أرض</option>
                        <option value="chalet">شاليه</option>
                        <option value="office">مكتب</option>
                        <option value="house">بيت عربي</option>
                        {{-- <option value="villa">فيلا</option> --}}
                        z

                    </select>
                </div>
            </div>
            <div class="row mapform">
                <div class="col-lg">
                    <label for="lat">خطوط العرض</label>
                    <input type="text" class="form-control" placeholder="lat" name="lat1" id="lat1"
                        disabled>
                </div>
                <div class="col-lg">
                    <label for="lng">خطوط الطول</label>
                    <input type="text" class="form-control" placeholder="lng" name="lng1" id="lng1"
                        disabled>
                </div>
                <div class="col-lg">
                    <label for="offer_type">توع العرض</label>
                    <select name="offer_type" id="offer_type" class="form-control">
                        <option value="Sale">بيع</option>
                        <option value="rent">إيجار</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="projectinput1"> العنوان </label>
                <input type="text" id="addres" class="form-control" placeholder="العنوان" name="address"
                    disabled>


            </div>

            <div id="map" style="height:400px; width: auto;" class="my-3 map"></div>


        </div>
        <div class="modal-footer">
            <button type="submit" id="add_property_btn" class="btn btn-primary">اضافة العقار </button>
        </div>
    </form>
</section>


<script>
    document.getElementById('property_type').onchange = function() {
        if (this.value == 'land') {
            document.getElementById("storey").disabled = true;
            document.getElementById("room_num").disabled = true;
            document.getElementById("bath_num").disabled = true;
        } else if (this.value == 'house') {
            document.getElementById("storey").disabled = true;

        } else {
            document.getElementById("storey").disabled = false;
            document.getElementById("room_num").disabled = false;
            document.getElementById("bath_num").disabled = false;
        }


    }

    document.getElementById('offer_type').onchange = function() {
        if (this.value == 'rent') {
            document.getElementById("price").disabled = true;
            document.getElementById("price_per_day").disabled = false;
        } else {
            document.getElementById("price").disabled = false;
            document.getElementById("price_per_day").disabled = true;
        }
    }
</script>

<div id="map" style="height: 300px;width: 1000px;"></div>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy_WwZRPLvcel7UsxRkSR7lAZKQDDUYck&callback=initMap"></script>
<script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 24.774265,
                lng: 46.738586
            },
            zoom: 8,
            scrollwheel: true,
        });

        const uluru = {
            lat: 24.774265,
            lng: 46.738586
        };
        let marker = new google.maps.Marker({
            position: uluru,
            map: map,
            draggable: true
        });
        google.maps.event.addListener(marker, 'position_changed',
            function() {
                let lat = marker.position.lat()
                let lng = marker.position.lng()
                $('#lat').val(lat)
                $('#lng').val(lng)
                $('#lat1').val(lat)
                $('#lng1').val(lng)

            })
        google.maps.event.addListener(map, 'click',
            function(event) {
                pos = event.latLng
                marker.setPosition(pos)

                $.ajax({
                    type: "post",
                    url: '{{ route('positionstack-api') }}',

                    data: {
                        lat: $('#lat').val(),
                        long: $('#lng').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {

                        $("#city_name").val(response.data[0].region);
                        $("#city_name1").val(response.data[0].region);

                        $("#addres").val("region :" + response.data[0].region + ",,name :" + response
                            .data[0].name + ",,street:" + response.data[0].street + ",,county:" +
                            response.data[0].county)

                    },
                    error: function() {}
                });
            });

    }
</script>

@include('layouts.footer-home')
@include('layouts.footer-script-home')
