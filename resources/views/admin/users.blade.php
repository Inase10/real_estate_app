
@extends('layouts.master')

@section('content')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users managment</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

</head>
<div class="container-fluid container">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">عدد البائعين </span>
                <span class="info-box-number">{{ $seller_num }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">عدد الزبائن </span>
                <span class="info-box-number">{{ $customer_num }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
        </div>



    </div>
{{-- add new user modal start --}}

<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="add_user_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="First Name"
                                required>
                        </div>
                        <div class="col-lg">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name"
                                required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="my-2">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Password" required>
                    </div>
                    <div class="my-2">
                        <label for="avatar">Select Avatar</label>
                        <input type="file" name="avatar" class="form-control">
                    </div>
                    <div class="my-2">
                        <label for="bio">bio</label>
                        <textarea id="bio" name="bio" rows="4" cols="50" class="form-control bio"></textarea>
                    </div>
                    <div class="my-2">
                        <label for="user_type">Select type user</label>
                        <select name="user_type" id="user_type" class="form-control">
                            <option value="seller">seller</option>
                            <option value="customer">custmer</option>

                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_user_btn" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new user modal end --}}

{{-- edit user modal start --}}
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="edit_user_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" id="user_id">
                {{-- <input type="hidden" name="user_avatar" id="user_avatar"> --}}
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control"
                                placeholder="First Name" required>
                        </div>
                        <div class="col-lg">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="E-mail" required>
                    </div>
                    <div class="my-2">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Password" required>
                    </div>

                    <div class="my-2">
                        <label for="avatar">Select Avatar</label>
                        <input type="file" name="avatar" class="form-control">
                    </div>
                    <div class="mt-2" id="avatar">

                    </div>
                    <div class="my-2">
                        <label for="bio">bio</label>
                        <textarea id="bio" class="bio form-control" name="bio" rows="4" cols="50"></textarea>
                    </div>
                    <div class="my-2">
                        <label for="user_type">Select type user</label>
                        <select name="user_type" class="user_type" id="user_type" class="form-control">
                            <option value="seller">seller</option>
                            <option value="customer">custmer</option>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="edit_user_btn" class="btn btn-success">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit user modal end --}}

<body class="bg-light">
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                        <h3 class="text-light">Manage Users</h3>
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addUserModal"><i
                                class="bi-plus-circle me-2"></i>Add New User</button>
                    </div>
                    <div class="card-body" id="show_all_users">
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
        $(function() {

            // add new user ajax request
            $("#add_user_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_user_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('store_user') }}',
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
                                'User Added Successfully!',
                                'success'
                            )
                            fetchAllUsers();

                        }
                        $("#add_user_btn").text('Add User');
                        $("#add_user_form")[0].reset();
                        $("#addUserModal").modal('hide');

                    }

                });
            });

            // edit user ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('edit_user') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#first_name").val(response.first_name);
                        $("#last_name").val(response.last_name);
                        $("#email").val(response.email);
                        $("#password").val(response.password);
                        $(".bio").val(response.bio);
                        $(".user_type").val(response.user_type);
                        $("#avatar").html(
                            `<img src="${response.avatar}" width="100" class="img-fluid img-thumbnail">`
                        );
                        $("#user_id").val(response.id);
                        $("#user_avatar").val(response.avatar);
                    }
                });
            });

            // update user ajax request
            $("#edit_user_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_user_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('update_user') }}',
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
                                'User Updated Successfully!',
                                'success'
                            )
                            fetchAllUsers();
                        }
                        $("#edit_user_btn").text('Update User');
                        $("#edit_user_form")[0].reset();
                        $("#editUserModal").modal('hide');
                    }
                });
            });

            // delete user ajax request
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
                            url: '{{ route('delete_user') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                // console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                fetchAllUsers();
                            }
                        });
                    }
                })
            });

            // fetch all users ajax request
            fetchAllUsers();

            function fetchAllUsers() {
                $.ajax({
                    url: '{{ route('fetchAll_users') }}',
                    method: 'get',
                    success: function(response) {
                        $("#show_all_users").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }
        });
    </script>

@endsection
