<button class="btn btn-success"
        id="new-category"
        data-mytitle="<?php echo e($category->title); ?>"
        data-parentid="<?php echo e($category->parent_id); ?>"
        data-catid="<?php echo e($category->id); ?>"
        data-toggle="modal"
        data-target="#add">New category
</button>

<button class="btn btn-info"
        id="edit-category"
        data-mytitle="<?php echo e($category->title); ?>"
        data-catid="<?php echo e($category->id); ?>"
        data-parentid="<?php echo e($category->parent_id); ?>"
        data-toggle="modal"
        data-target="#edit">Edit
</button>


<?php if($category->parent_id !== 0): ?>
    <button class="btn btn-info"
            id="upload-file"
            data-mytitle="<?php echo e($category->title); ?>"
            data-catid="<?php echo e($category->id); ?>"
            data-toggle="modal"
            data-target="#file">UploadFile
    </button>
<?php endif; ?>

<?php if($category->parent_id !== 0): ?>
    <button class="btn btn-danger"
            id="delete-category"
            data-catid="<?php echo e($category->id); ?>"
            data-toggle="modal"
            data-target="#delete">Delete
    </button>
<?php endif; ?>
<?php /**PATH C:\laragon\www\nexumtest\resources\views/category/operationsView.blade.php ENDPATH**/ ?>