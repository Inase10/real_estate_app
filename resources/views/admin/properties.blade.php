@extends('layouts.master')

@section('content')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>properties managment</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

</head>
{{-- add new property modal start --}}

<div class="container-fluid container">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-light elevation-1"><i class="fas fa-building"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">عدد الشقق </span>
                <span class="info-box-number">{{ $property_appartment }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-light elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">عدد الأراضي </span>
                <span class="info-box-number">{{ $property_land }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-light elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">عدد الشاليهات</span>
                <span class="info-box-number">{{ $property_chalet }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-light elevation-1"><i class="fas fa-home"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">عدد البيوت العربية </span>
                <span class="info-box-number">{{ $property_house}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-light   elevation-1"><i class="far fa-building"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">عدد المكاتب </span>
                <span class="info-box-number">{{ $property_office }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
        </div>
    </div>
<div class="modal fade" id="addpropertyModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="add_property_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="seller_id" name="seller_id" value="{{ Auth::user()->id }}">
                <div class="modal-body p-4 bg-light ">
                    <div class="row">
                        <div class="col-lg">
                            <label for="area">area</label>
                            <input type="text" id="area"name="area" class="form-control" placeholder="area"
                                required>
                        </div>
                        <div class="col-lg">
                            <label for="price">price</label>
                            <input type="text" id="price" name="price" class="form-control" placeholder="price"
                                >
                        </div>
                        <div class="col-lg">
                            <label for="price">price per day</label>
                            <input type="text" id="price_per_day" name="price_per_day" class="form-control" placeholder="price per day"
                                >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                        <label for="room_num">room number</label>
                        <input type="room_num" id="room_num"name="room_num" class="form-control" placeholder="room number" >
                    </div>
                    <div class="col-lg">
                        <label for="storey">storey</label>
                        <input type="storey" id="storey" name="storey" class="form-control"
                            placeholder="storey" required>
                    </div>
                    <div class="col-lg">
                        <label for="city_name">city</label>
                        <input type="city_name" id="city_name" name="city_name" class="form-control"
                            placeholder="city" required>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-lg">
                        <label for="disc">disc</label>
                        <textarea id="disc" name="disc" rows="4" cols="50" class="form-control bio"></textarea>
                    </div>
                </div>
                    <div class="row">

                        <div class="col-lg">
                        <label for="bath_num">bath number</label>
                        <input type="bath_num" name="bath_num" id="bath_num" class="form-control" placeholder="bath number" >
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg">
                        <label for="disc">disc</label>
                        <textarea id="disc"name="disc" cols="50" rows="6"></textarea>
                    </div> --}}
                    <div class="col-lg">
                        <label for="images">images</label>
                        <input type="file" name="images[]" id="images"multiple class="form-control" accept="image/*">
                    </div>
                    <div class="my-2">
                        <label for="avatar">cover image</label>
                        <input type="file" id="cover_image" name="cover_image" class="form-control">
                    </div>
                    <div class="col-lg">
                        <label for="property_type">Select type</label>
                        <select name="property_type" id="property_type" class="form-control">
                            <option value="land">land</option>
                            <option value="chalet">chalet</option>
                            <option value="office">office</option>
                            <option value="house">house</option>
                            <option value="apartment">appartment</option>


                        </select>
                    </div>
                    </div>
                    <div class="row mapform">
                        <div class="col-lg">
                            <label for="lat">lat</label>
                            <input type="text" class="form-control" placeholder="lat" name="lat" id="lat">
                         </div>
                         <div class="col-lg">
                            <label for="lng">lng</label>
                            <input type="text" class="form-control" placeholder="lng" name="lng" id="lng">
                          </div>
                          <div class="col-lg">
                            <label for="offer_type">offer type</label>
                            <select name="offer_type" id="offer_type" class="form-control">
                                <option value="rent">rent</option>
                                <option value="Sale">Sale</option>
                            </select>
                         </div>
                        </div>
                        <div id="map" style="height:400px; width: auto;" class="my-3 map"></div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_property_btn" class="btn btn-primary">Add property</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new property modal end --}}

{{-- edit property modal start --}}
<div class="modal fade" id="editpropertyModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="edit_property_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="property_id" id="property_id">
                <input type="hidden" id="seller_id" name="seller_id" value="{{ Auth::user()->id }}">
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="area">area</label>
                            <input type="text" id="area"name="area" class="form-control" placeholder="area"
                                required>
                        </div>
                        <div class="col-lg">
                            <label for="price">price</label>
                            <input type="text" id="price" name="price" class="form-control" placeholder="price"
                                >
                        </div>
                        <div class="col-lg">
                            <label for="price">price per day</label>
                            <input type="text" id="price_per_day" name="price_per_day" class="form-control" placeholder="price per day">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                        <label for="room_num">room number</label>
                        <input type="room_num" id="room_num"name="room_num" class="form-control" placeholder="room number" >
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg">
                        <label for="disc">disc</label>
                        <textarea id="disc"name="disc" cols="50" rows="6"></textarea>
                    </div> --}}
                    <div class="col-lg">
                        <label for="storey">storey</label>
                        <input type="storey" id="storey" name="storey" class="form-control"
                            placeholder="storey" required>
                    </div>
                    <div class="col-lg">
                        <label for="city_name">city</label>
                        <input type="city_name" id="city_name" name="city_name" class="form-control"
                            placeholder="city" required>
                    </div>
                    </div>
                    <div class="row">

                        <div class="col-lg">
                        <label for="bath_num">bath number</label>
                        <input type="bath_num" name="bath_num" id="bath_num" class="form-control" placeholder="bath number" >
                    </div>
                    <div class="col-lg">
                        <label for="images">images</label>
                        <input type="file" name="images[]" id="images"multiple class="form-control" accept="image/*">
                    </div>
                    <div class="my-2">
                        <label for="avatar">cover image</label>
                        <input type="file" id="cover_image" name="cover_image" class="form-control">
                    </div>
                    <div class="col-lg">
                        <label for="property_type">Select type</label>
                        <select name="property_type" id="property_type" class="form-control">
                            <option value="land">land</option>
                            <option value="chalet">chalet</option>
                            <option value="office">office</option>
                            <option value="house">house</option>
                            <option value="apartment">appartment</option>


                        </select>
                    </div>
                    </div>
                    <div class="row mapform">
                        <div class="col-lg">
                            <label for="lat">lat</label>
                            <input type="text" class="form-control" placeholder="lat_edit" name="lat_edit" id="lat_edit">
                         </div>
                         <div class="col-lg">
                            <label for="lng">lng</label>
                            <input type="text" class="form-control" placeholder="lng_edit" name="lng_edit" id="lng_edit">
                          </div>
                          <div class="col-lg">
                            <label for="offer_type">offer type</label>
                            <select name="offer_type" id="offer_type" class="form-control">
                                <option value="rent">rent</option>
                                <option value="Sale">Sale</option>
                            </select>
                         </div>
                        </div>
                        <div id="map_edit" style="height:400px; width: auto;" class="my-3 map"></div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="edit_property_btn" class="btn btn-success">Update property</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit property modal end --}}

<body class="bg-light">
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                        <h3 class="text-light">Manage properties</h3>
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addpropertyModal"><i
                                class="bi-plus-circle me-2"></i>Add New property</button>
                    </div>
                    <div class="card-body" id="show_all_properties">
                        <h1 class="text-center text-secondary my-5">Loading...</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
                            let map;
                            let map_edit;

                            function initMap() {
                                map = new google.maps.Map(document.getElementById("map"), {
                                    center: {   lat: 24.774265,lng: 46.738586},
                                    zoom: 8,
                                    scrollwheel: true,
                                });

                                const uluru = {   lat: 24.774265,lng: 46.738586};
                                let marker = new google.maps.Marker({
                                    position: uluru,
                                    map: map,
                                    draggable: true
                                });
                                google.maps.event.addListener(marker,'position_changed',
                                    function (){
                                        let lat = marker.position.lat()
                                        let lng = marker.position.lng()
                                        $('#lat').val(lat)
                                        $('#lng').val(lng)

                                    })
                                    google.maps.event.addListener(map,'click',
                                function (event){
                                    pos = event.latLng
                                    marker.setPosition(pos)
                                })
                                map_edit = new google.maps.Map(document.getElementById("map_edit"), {
                                    center: { lat: 24.774265,lng: 46.738586},
                                    zoom: 8,
                                    scrollwheel: true,
                                });
                                let marker_edit = new google.maps.Marker({
                                    position: uluru,
                                    map: map_edit,
                                    draggable: true
                                });


                                    google.maps.event.addListener(marker_edit,'position_changed',
                                    function (){
                                        let lat_edit = marker_edit.position.lat()
                                        let lng_edit = marker_edit.position.lng()
                                       $('#lat_edit').val(lat_edit)
                                         $('#lng_edit').val(lng_edit)
                                    })

                                google.maps.event.addListener(map_edit,'click',
                                function (event){
                                    pos_edit = event.latLng
                                    marker_edit.setPosition(pos_edit)
                                })

                            }


                        </script>

                        <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
                                type="text/javascript"></script>
    <script>
        $(function() {

            // add new property ajax request
            $("#add_property_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_property_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('store_property') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Added!',
                                'property Added Successfully!',
                                'success'
                            )
                            fetchAllProperties();
                        }
                        $("#add_property_btn").text('Add Property');
                        $("#add_property_form")[0].reset();
                        $("#addpropertyModal").modal('hide');
                    }
                });
            });

            // edit property ajax request
            $(document).on('click', '.editIcon', function(e) {

                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('edit_property') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#area").val(response.are);
                        $("#lat").val(response.lat);
                        $("#lng").val(response.lng);
                        $("#price").val(response.price);
                        $("#price_per_day").val(response.price_per_day);
                        $("#property_type").val(response.property_type);
                        $("#property_id").val(response.id);
                        $("#bath_num").val(response.bath_num);
                        $("#room_num").val(response.room_num);
                        $('#cover_image').val(response.cover_image)
                        $('#disc').val(response.disc)

                    }
                });
            });

            // update property ajax request
            $("#edit_property_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_property_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('update_property') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Updated!',
                                'property Updated Successfully!',
                                'success'
                            )
                            fetchAllProperties();
                        }
                        $("#edit_property_btn").text('Update property');
                        $("#edit_property_form")[0].reset();
                        $("#editpropertyModal").modal('hide');
                    }
                });
            });

            // delete property ajax request
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('delete_property') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                fetchAllProperties();
                            }
                        });
                    }
                })
            });

            // fetch all properties ajax request
            fetchAllProperties();

            function fetchAllProperties() {
                $.ajax({
                    url: '{{ route('fetchAll_properties') }}',
                    method: 'get',
                    success: function(response) {
                        $("#show_all_properties").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }
        });
    </script>

@endsection
