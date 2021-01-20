<ul>

    <?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <li data-id="<?php echo e($child->id); ?>" class="child">

            <span class="title"><?php echo e($child->title); ?></span>

            <?php if(count($child->childs)): ?>

                <?php echo $__env->make('category.manageChild',['childs' => $child->childs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php endif; ?>

        </li>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</ul>
<?php /**PATH C:\laragon\www\nexumtest\resources\views/category/manageChild.blade.php ENDPATH**/ ?>