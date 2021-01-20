
<ul id="files">
    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <?php if($permission): ?>
                <a href="<?php echo e(route('download.file', ['id' => $file->id ])); ?>"><?php echo e($file->name); ?></a>
            <?php else: ?>
             <?php echo e($file->name); ?>

            <?php endif; ?>
            <small>From user:<?php echo e($file->user->name); ?></small>
            <small>Date: <?php echo e($file->created_at); ?></small>
            <small>Version: v<?php echo e($file->version); ?></small>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH C:\laragon\www\nexumtest\resources\views/file/fileView.blade.php ENDPATH**/ ?>