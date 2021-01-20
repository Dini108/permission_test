
<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Category</h4>
            </div>
            <form action="<?php echo e(route('add.category')); ?>" method="post">
                <?php echo e(method_field('post')); ?>

                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <input type="hidden" name="parent_id" id="parent_id" value="0">
                    <input type="hidden" name="category_id" id="category_id" value="0">
                    <?php echo $__env->make('category.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
            </div>
            <form action="<?php echo e(route('edit.category')); ?>" method="post">
                <?php echo e(method_field('patch')); ?>

                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <input type="hidden" name="parent_id" id="parent_id" value="0">
                    <input type="hidden" name="category_id" id="category_id" value="0">
                    <?php echo $__env->make('category.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Delete Confirmation</h4>
            </div>
            <form action="<?php echo e(route('delete.category')); ?>" method="post">
                <?php echo e(method_field('delete')); ?>

                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <p class="text-center">
                        Are you sure you want to delete this?
                    </p>
                    <input type="hidden" name="category_id" id="category_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                    <button type="submit" class="btn btn-warning">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal modal-danger fade" id="file" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="modalLabel">Upload File</h4>
            </div>
            <form role="form" id="category" method="POST" action="<?php echo e(route('add.file')); ?>"
                  enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
                    <div class="modal-body">
                        <input type="file" id="file" name="file" class="form-control">
                        <input type="hidden" name="category_id" id="category_id" value="2">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\nexumtest\resources\views/category/modals.blade.php ENDPATH**/ ?>