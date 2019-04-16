<header class="site-header">
  <a href="#" class="brand-main">
    <img src="<?php echo e(asset('/assets/admin/img/logo-desk.png')); ?>" id="logo-desk" alt="Laraspace Logo"
      class="d-none d-md-inline ">
    <img src="<?php echo e(asset('/assets/admin/img/logo-mobile.png')); ?>" id="logo-mobile" alt="Laraspace Logo" class="d-md-none">
  </a>
  <a href="#" class="nav-toggle">
    <div class="hamburger hamburger--htla">
      <span>toggle menu</span>
    </div>
  </a>

  <ul class="action-list">
    
    <li>
      <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="avatar">
      <?php if(Auth::user()->photo != NULL): ?>
      <img src="/employeesPhoto/<?php echo e(Auth::user()->photo); ?>" alt="<?php echo e(Auth::user()->photo); ?>"></a>
      <?php else: ?>
      <img src="<?php echo e(asset('/assets/admin/img/avatars/user.png')); ?>" alt="Avatar"></a>
      <?php endif; ?>
      <div class="dropdown-menu dropdown-menu-right notification-dropdown">
        <?php if(Auth::user()->hasRole('admin')): ?>
        <a class="dropdown-item" href=<?php echo e(route("users.show",Auth::user()->id)); ?>><i class="icon-fa icon-fa-user"></i> Profile</a>
        <?php else: ?>
        <a class="dropdown-item" href=<?php echo e(route("profiles.index")); ?>><i class="icon-fa icon-fa-user"></i> Profile</a>
        
        <?php endif; ?>
        <a class="dropdown-item" href="/logout"><i class="icon-fa icon-fa-sign-out"></i> Logout</a>
      </div>
    </li>
  </ul>
</header>