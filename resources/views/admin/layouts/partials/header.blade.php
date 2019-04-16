<header class="site-header">
  <a href="#" class="brand-main">
    <img src="{{asset('/assets/admin/img/logo-desk.png')}}" id="logo-desk" alt="Laraspace Logo"
      class="d-none d-md-inline ">
    <img src="{{asset('/assets/admin/img/logo-mobile.png')}}" id="logo-mobile" alt="Laraspace Logo" class="d-md-none">
  </a>
  <a href="#" class="nav-toggle">
    <div class="hamburger hamburger--htla">
      <span>toggle menu</span>
    </div>
  </a>

  <ul class="action-list">
    {{-- <li>
        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-fa icon-fa-plus"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="#"><i class="icon-fa icon-fa-edit"></i> New Post</a>
          <a class="dropdown-item" href="#"><i class="icon-fa icon-fa-tag"></i> New Category</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"><i class="icon-fa icon-fa-star"></i> Separated link</a>
        </div>
      </li>
      <li>
        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-fa icon-fa-bell"></i></a>
        <div class="dropdown-menu dropdown-menu-right notification-dropdown">
          <h6 class="dropdown-header">Notifications</h6>
          <a class="dropdown-item" href="#"><i class="icon-fa icon-fa-user"></i> New User was Registered</a>
          <a class="dropdown-item" href="#"><i class="icon-fa icon-fa-comment"></i> A Comment has been posted.</a>
        </div>
      </li> --}}
    <li>
      <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="avatar">
      @if(Auth::user()->photo != NULL)
      <img src="/employeesPhoto/{{ Auth::user()->photo }}" alt="{{ Auth::user()->photo }}"></a>
      @else
      <img src="{{asset('/assets/admin/img/avatars/user.png')}}" alt="Avatar"></a>
      @endif
      <div class="dropdown-menu dropdown-menu-right notification-dropdown">
        @if(Auth::user()->hasRole('admin'))
        <a class="dropdown-item" href={{ route("users.show",Auth::user()->id) }}><i class="icon-fa icon-fa-user"></i> Profile</a>
        @else
        <a class="dropdown-item" href={{ route("profiles.index") }}><i class="icon-fa icon-fa-user"></i> Profile</a>
        
        @endif
        <a class="dropdown-item" href="/logout"><i class="icon-fa icon-fa-sign-out"></i> Logout</a>
      </div>
    </li>
  </ul>
</header>