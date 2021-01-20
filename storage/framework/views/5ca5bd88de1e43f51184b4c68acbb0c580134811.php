<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <h3>Category List</h3>
                    <ul id="tree1">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li data-id="<?php echo e($category->id); ?>">
                                <span class="title"><?php echo e($category->title); ?></span>
                                <?php if(count($category->childs)): ?>
                                    <?php echo $__env->make('category.manageChild',['childs' => $category->childs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="col-md-6">
                    <input type="hidden" name="category_id" id="category_id" value="1">
                    <h3>Permissions</h3>
                    <form role="form" id="category" method="POST" action="<?php echo e(route('add.category')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                        <label>Upload:</label>
                        <input type="checkbox" id="upload_permission">
                        <label>Download:</label>
                        <input type="checkbox" id="download_permission">
                    </form>
                    <h3>Operations</h3>
                    <div id="operations_container"></div>
                </div>
                <div class="col-md-12">
                    <h3>Files</h3>
                    <div id="files_container"></div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('category.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<script src="<?php echo e(asset('js/treeview.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexumtest\resources\views/category/categoryTreeview.blade.php ENDPATH**/ ?>