    <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>U</b>FG</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Inkardex</b>UFG</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          @if (Auth::guest())
              <li>
                  <a class="waves-effect waves-light" href="{{ route('login') }}">
                  <i class="ti-user"></i> Login</span></a>
              </li>
              <li>
                  <a class="waves-effect waves-light" href="{{ route('register') }}">
                  <i class="ti-write"></i> Register</span></a>
              </li>
          @else
            <?php
              $user = Auth::user();
            ?>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="{{ $user->profileImage() ? asset($user->profileImage()->path) : 'http://placehold.it/150x150' }}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ $user->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="{{ $user->profileImage() ? asset($user->profileImage()->path) : 'http://placehold.it/150x150' }}" class="img-circle" alt="User Image">
                  <p>
                    {{ $user->name }}
                    <small>Member since {{ $user->created_at->diffForHumans() }}</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                      <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          <i class="fa fa-power-off"></i> Logout</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </div>
                </li>
              </ul>
            </li>          
          @endif

        </ul>
      </div>
    </nav>
  </header>