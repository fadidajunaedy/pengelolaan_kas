<style>
  .navbar-foto-profile {
    width: 75px;
    height: 75px;
    border-radius: 50%;
    overflow: hidden;
  }

  .navbar-foto-profile img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

</style>
<nav id="navbar-main" class="navbar is-fixed-top">
    <div class="navbar-brand">
      <a class="navbar-item mobile-aside-button">
        <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
      </a>
    </div>
    <div class="navbar-brand is-right">
      <a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
        <span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
      </a>
    </div>
    <div class="navbar-menu" id="navbar-menu">
      <div class="navbar-end">
        <div class="navbar-item dropdown has-divider has-user-avatar">
          <a class="navbar-link">
            <div class="is-user-name">
              <span>
                @if (Auth::guard('admins')->check())
                  {{Auth::guard('admins')->user()->fullname}}
                @endif
                @if (Auth::guard('web')->check())
                  {{Auth::guard('web')->user()->fullname}}
                @endif
              </span>
            </div>
            <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
          </a>
          <div class="navbar-dropdown">
            <div class="navbar-foto-profile mx-auto my-4">
              @if (Auth::guard('admins')->check())
                <img src="{{ asset('foto'.'/'.Auth::guard('admins')->user()->foto)}}" alt="Foto User">
              @endif
              @if (Auth::guard('web')->check())
                <img src="{{ asset('foto'.'/'.Auth::guard('web')->user()->foto)}}" alt="Foto User">                  
              @else
                <img src="{{ url('images/user-default.png')}}" alt="Foto User">                  
              @endif
            </div>
            <hr class="navbar-divider">
            <a href="{{ url('profile/')}}" class="navbar-item">
              <span class="icon"><i class="mdi mdi-account"></i></span>
              <span>My Profile</span>
            </a>
            <hr class="navbar-divider">
            <a href="{{ url('logout/') }}" class="navbar-item">
              <span class="icon"><i class="mdi mdi-logout"></i></span>
              <span>Log Out</span>
            </a>
          </div>
        </div>
      </div>
    </div>
</nav>