@if (Auth::user()->user_type == 'Seller')
    @include('layouts.head-home')
    @include('layouts.navbar-home')
@elseif(Auth::user()->user_type == 'Customer')
    @include('layouts.head-home')
    @include('layouts.navbar-home_customer')
@endif

<body>
    <div class="container bootstrap snippets bootdey">
        <h1 class="text-primary"> تعديل حسابك</h1>
        <hr>


        <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <div class="text-center">
                    <img src="{{ Auth::user()->avatar }} " width="50" class="avatar img-circle img-thumbnail"
                        alt="avatar">
                    <h6> {{ Auth::user()->email }}</h6>

                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label"> تاريخ إنشاء الحساب:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="{{ Auth::user()->created_at }} " disabled>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label"> اخر تعديل : </label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="{{ Auth::user()->updated_at }} " disabled>
                    </div>
                </div>
                <div class="my-2">
                    @if (Auth::user()->user_type == 'Seller')
                        <label for="user_type"> عدد العروض التي تم بيعها عن طريق الموقع </label>
                        <br>

                        <label for="user_type"> <b>
                                <h6 style="color:green"></h6>{{ Auth::user()->Rank }} </h6>
                            </b></label>
                        <br>
                    @endif
                    <label for="user_type"> نوع الحساب </label>
                    @if (Auth::user()->user_type == 'Seller')
                        <b>
                            <h6 style="color:green">بائع</h6>
                        </b>
                        <label for="user_type"> <b>
                                <h6 style="color:green">الرتبة</h6>
                            </b> </label>
                        <br>
                        @if (Auth::user()->Rank >= 5)
                            <label for="user_type"> بائع مميز </label>
                        @else
                            <label for="user_type"> بائع جديد </label>
                        @endif


                    @endif
                    @if (Auth::user()->user_type == 'Customer')
                        <b>
                            <h6 style="color:green">مشتري</h6>
                        </b>
                        <label for="user_type"> الرتبة </label>
                        <br>
                        @if (Auth::user()->Rank >= 3 && Auth::user()->Rank <= 8)
                            <label for="user_type"><b>
                                    <h6 style="color:green">مشتري مميز </h6>
                                </b> </label>
                        @elseif(Auth::user()->Rank >= 9)
                            <label for="user_type"><b>
                                    <h6 style="color:green"> مشتري vip</h6>
                                </b> </label>
                        @else
                            <label for="user_type"> مشتري جديد </label>
                        @endif

                    @endif
                    @if (Auth::user()->user_type == 'Admin')
                        <b>
                            <h6 style="color:green">مدير الموقع</h6>
                        </b>
                    @endif
                </div>
            </div>

            <div class="col-md-9 personal-info">

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <h3>المعلومات الشخصية</h3>




                <form action="{{ route('update_user_web') }}" method="POST" id="edit_user_form"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value={{ Auth::user()->id }}>
                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="col-lg">
                                <label for="first_name">الاسم </label>
                                <input type="text" name="first_name" id="first_name" class="form-control"
                                    placeholder="First Name" value="{{ Auth::user()->first_name }}" required>
                            </div>
                            <div class="col-lg">
                                <label for="last_name">اسم العائلة </label>
                                <input type="text" name="last_name" id="last_name" class="form-control"
                                    placeholder="Last Name" value="{{ Auth::user()->last_name }}" required>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="email">البريد الالكتروني</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="E-mail" value="{{ Auth::user()->email }}" required>
                        </div>
                        <div class="my-2">
                            <label for="password">كلمة المرور</label>
                            <input type="password" id="password" name="password"
                                value="{{ Auth::user()->password }}"class="form-control" placeholder="Password"
                                required>
                        </div>

                        <div class="my-2">
                            <label for="avatar">اختيار صورة جديدة </label>
                            <input type="file" name="avatar" class="form-control" required>
                        </div>

                        <div class="my-2">
                            <label for="bio">السيرة الذاتية</label>
                            <textarea id="bio" class="bio form-control" name="bio" rows="4" cols="50">
                                {{ Auth::user()->bio }}
                            </textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="edit_user_btn" class="btn btn-success">حفظ التعديلات</button>
                        </div>
                </form>
            </div>

        </div>

    </div>
    </div>
    @include('layouts.footer-home')


    <hr>

    <style type="text/css">
        body {
            margin-top: 20px;
        }

        .avatar {
            width: 200px;
            height: 200px;
        }
    </style>
</body>

</html>
