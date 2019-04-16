<div class="sidebar-left <?php if($type == 'icon'): ?> sidebar-large-icons <?php endif; ?>" id="mobile-nav">
    <div class="sidebar-body scroll-pane">
        <?php echo $__env->make('admin.layouts.partials.nav.menu-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</div>

