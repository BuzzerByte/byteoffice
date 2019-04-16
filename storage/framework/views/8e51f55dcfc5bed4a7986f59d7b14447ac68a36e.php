<ul class="side-nav metismenu" id="menu">
    <?php if(Auth::user()->hasRole('admin')): ?>
    <?php $__currentLoopData = config('menu.sidebar'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="<?php echo e(set_active($menu['active'],'active')); ?>">
            <a href="<?php echo e(url($menu['link'])); ?>"><i class="<?php echo e($menu['icon']); ?>"></i> <?php echo e($menu['title']); ?> <?php if(isset($menu['children'])): ?><span class="icon-fa arrow icon-fa-fw"></span> <?php endif; ?></a>
            <?php if(isset($menu['children'])): ?>
                <ul aria-expanded="true" class="collapse">
                    <?php $__currentLoopData = $menu['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="<?php echo e(set_active($child['active'],'active')); ?>">
                            <a href="<?php echo e(url($child['link'])); ?>"><?php echo e($child['title']); ?><?php if(isset($child['children'])): ?><span class="icon-fa arrow icon-fa-fw"></span> <?php endif; ?></a>
                            <?php if(isset($child['children'])): ?>
                                <ul aria-expanded="true" class="collapse submenu">
                                    <?php $__currentLoopData = $child['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subchild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="<?php echo e(set_active($subchild['active'])); ?>"><a href="<?php echo e(url($subchild['link'])); ?>"><?php echo e($subchild['title']); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php elseif(Auth::user()->hasRole('user')): ?>
    <?php $__currentLoopData = config('menu.userSidebar'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="<?php echo e(set_active($menu['active'],'active')); ?>">
            <a href="<?php echo e(url($menu['link'])); ?>"><i class="<?php echo e($menu['icon']); ?>"></i> <?php echo e($menu['title']); ?> <?php if(isset($menu['children'])): ?><span class="icon-fa arrow icon-fa-fw"></span> <?php endif; ?></a>
            <?php if(isset($menu['children'])): ?>
                <ul aria-expanded="true" class="collapse">
                    <?php $__currentLoopData = $menu['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="<?php echo e(set_active($child['active'],'active')); ?>">
                            <a href="<?php echo e(url($child['link'])); ?>"><?php echo e($child['title']); ?><?php if(isset($child['children'])): ?><span class="icon-fa arrow icon-fa-fw"></span> <?php endif; ?></a>
                            <?php if(isset($child['children'])): ?>
                                <ul aria-expanded="true" class="collapse submenu">
                                    <?php $__currentLoopData = $child['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subchild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="<?php echo e(set_active($subchild['active'])); ?>"><a href="<?php echo e(url($subchild['link'])); ?>"><?php echo e($subchild['title']); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    
</ul>