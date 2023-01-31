<div id="map" style="height: 400px; width: 100%;">


</div>
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

        let uluru = {
            lat: 24.774265,
            lng: 46.738586
        };


        let lati = [];
        let lngi = [];
        let offers = {!! json_encode($offers->toArray()) !!};
        for (let i = 0; i < offers.data.length; i++)

        {

            lati[i] = offers.data[i].latitude;
            lngi[i] = offers.data[i].longitude;
        }

        console.log(lati)

        var map = new google.maps.Map(
            document.getElementById('map'), {
                zoom: 4,
                center: uluru
            });

        for (i = 0; i < lati.length; i++) {
            // var location ={ lat:  lati[i], lng: lngi[i]};
            // console.log(location)
            var myLatLng = new google.maps.LatLng(lati[i], lngi[i]);
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                draggable: true
            });

        }
    }
</script>
