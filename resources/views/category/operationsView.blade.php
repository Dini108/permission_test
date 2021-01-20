<button class="btn btn-success"
        id="new-category"
        data-mytitle="{{$category->title}}"
        data-parentid="{{$category->parent_id}}"
        data-catid="{{$category->id}}"
        data-toggle="modal"
        data-target="#add">New category
</button>

<button class="btn btn-info"
        id="edit-category"
        data-mytitle="{{$category->title}}"
        data-catid="{{$category->id}}"
        data-parentid="{{$category->parent_id}}"
        data-toggle="modal"
        data-target="#edit">Edit
</button>


@if($category->parent_id !== 0)
    <button class="btn btn-info"
            id="upload-file"
            data-mytitle="{{$category->title}}"
            data-catid="{{$category->id}}"
            data-toggle="modal"
            data-target="#file">UploadFile
    </button>
@endif

@if($category->parent_id !== 0)
    <button class="btn btn-danger"
            id="delete-category"
            data-catid="{{$category->id}}"
            data-toggle="modal"
            data-target="#delete">Delete
    </button>
@endif
