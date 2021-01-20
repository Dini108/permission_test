@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <h3>Category List</h3>
                    <ul id="tree1">
                        @foreach($categories as $category)
                            <li data-id="{{ $category->id }}">
                                <span class="title">{{ $category->title }}</span>
                                @if(count($category->childs))
                                    @include('category.manageChild',['childs' => $category->childs])
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <input type="hidden" name="category_id" id="category_id" value="1">
                    <h3>Permissions</h3>
                    <form role="form" id="category" method="POST" action="{{ route('add.category') }}" enctype="multipart/form-data">
                    @csrf
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
    @include('category.modals')
</div>

<script src="{{ asset('js/treeview.js') }}"></script>
@endsection
