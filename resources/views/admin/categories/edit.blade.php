@extends('admin.include.main')
@section('title', 'Edit Category')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
 <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" id="editCategoryForm">
                    @csrf
                    @method('PUT')
                    @include('admin.categories._form')
                    <!-- Submit Button -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary configreset" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="editCategoryBtn">Save Category</button>
            </div>
        </div>
    </div>
</div>

@endsection