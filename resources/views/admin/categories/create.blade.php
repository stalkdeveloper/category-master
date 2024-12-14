@extends('admin.include.main')
@section('title', 'Create Category')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
 <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="createCategoryForm">
                    @csrf
                    @include('admin.categories._form')
                    <!-- Submit Button -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary configreset" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="createCategoryBtn">Save Category</button>
            </div>
        </div>
    </div>
</div>

@endsection