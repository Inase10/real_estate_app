 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="{{  route('profile-admin')}}" class="brand-link">

    <img src="{{ Auth::user()->avatar }}" width="50" class="img-thumbnail rounded-circle">

         <span class="brand-text font-weight-light">{{ Auth::user()->first_name .'  '.  Auth::user()->last_name}}</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                 <li class="nav-item">
                     <a href="{{ route('all_users') }}" class="nav-link">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             users
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('all_properties') }}" class="nav-link">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             properties </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('all_offers') }}" class="nav-link">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             offers

                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                    <a href="{{ route('all_orders') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            orders
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
