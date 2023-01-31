 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         {{-- <img src="storage/images/' . "{{  Auth::user()->avatar }}" . '" width="50"  alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8"> --}}
    <img src="storage/images/' . {{ Auth::user()->avatar }} . '" width="50" class="img-thumbnail rounded-circle">

         <span class="brand-text font-weight-light">{{ Auth::user()->first_name .'  '.  Auth::user()->last_name}}</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">Dashboard</a>
             </div>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <li class="nav-item">
                     <a href="{{ route('all_users') }}" class="nav-link">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             my orders
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('all_properties') }}" class="nav-link">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                            my offers
                        </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('all_offers') }}" class="nav-link">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             home

                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            logout
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            my profile
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
