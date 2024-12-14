@extends('admin.include.main')
@section('title', 'All Category')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Category</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Category</a></li>
                        <li class="breadcrumb-item"><a href="{{route('categories.index')}}">All Category</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ Hover-table ] start -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>Category</h5>
                    <span class="d-block m-t-5">Here, your <code>Category</code> will be available</span>
                    @can('has_permission', 'category_create')
                        <a href="javascript:void(0)" class="btn  btn-outline-primary float-right createCategory">Create Category</a>
                    @endcan
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        {{$dataTable->table(['class' => 'table table-hover mb-0', 'style' => 'width:100%;'])}}
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Hover-table ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
{!! $dataTable->scripts() !!}
<script>
        $(document).on('click', '.createCategory', function(e) {
            e.preventDefault();
            $('#spinner-div').addClass('show');
            $.ajax({
                type: 'GET',
                url: "{{ route('categories.create') }}",
                dataType: 'json',
                success: function(response) {
                    $('#spinner-div').removeClass('show');
                    
                    if (response.success) {
                        $('.popup_render_div').html(response.htmlView);
                        $('#addCategoryModal').modal('show');
                    } else {
                        toastr.error('Unable to fetch the category form.', 'Error');
                    }
                },
                error: function(xhr, status, error) {
                    $('#spinner-div').removeClass('show');       
                    toastr.error('Unable to fetch the category form.', 'Error');
                },
                complete: function(res){
                    $('#spinner-div').removeClass('show');
                }
            });
        });

        $(document).on('click', '#createCategoryBtn', function(e) {
            e.preventDefault();        
            $(".validation-error-block").remove();
            $('#spinner-div').addClass('show');

            var formData = new FormData($('#createCategoryForm')[0]);
            $.ajax({
                url: "{{ route('categories.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#spinner-div').removeClass('show');
                    if (response.success) {
                        $('#addCategoryModal').modal('hide');
                        toastr.success(response.message, 'Success');
                        location.reload();
                        $('.popup_render_div').html('');
                    }
                },
                error: function (response) {
                    $('#spinner-div').removeClass('show');            
                    var errorLabelTitle = '';
                    $.each(response.responseJSON.errors, function (key, item) {
                        errorLabelTitle = '<span class="validation-error-block text-danger">' + item[0] + '</span>';
                        if ($('select[name="' + key + '"]').length > 0) {
                            $('select[name="' + key + '"]').after(errorLabelTitle);
                        } else {
                            $('input[name="' + key + '"]').after(errorLabelTitle);
                        }
                    });
                },
                complete: function(res){
                    $('#spinner-div').removeClass('show');
                }

            });
        });

        function editBtn(id){
            $('#spinner-div').addClass('show');
            let url = `{{ route('categories.edit', ':id') }}`.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function(response) {
                    $('#spinner-div').removeClass('show');
                    
                    if (response.success) {
                        $('.popup_render_div').html(response.htmlView);
                        $('#editCategoryModal').modal('show');
                    } else {
                        toastr.error('Unable to fetch the category form.', 'Error');
                    }
                },
                error: function(xhr, status, error) {
                    $('#spinner-div').removeClass('show');         
                    toastr.error('Something went wrong while fetching the category form.', 'Error');       
                },
                complete: function(res){
                    $('#spinner-div').removeClass('show');
                }
            });
        }

        $(document).on('click', '#editCategoryBtn', function(e) {
            e.preventDefault();        
            $(".validation-error-block").remove();
            $('#spinner-div').addClass('show');

            var formData = new FormData($('#editCategoryForm')[0]);
            var url = $('#editCategoryForm').attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#spinner-div').removeClass('show');
                    if (response.success) {
                        $(document).find('.popup_render_div').html('');
                        $('#editCategoryModal').modal('hide');
                        toastr.success(response.message, 'Success');
                        location.reload();
                    }
                },
                error: function(response) {
                    $('#spinner-div').removeClass('show');            
                    var errorLabelTitle = '';
                    $.each(response.responseJSON.errors, function(key, item) {
                        errorLabelTitle = '<span class="validation-error-block text-danger">' + item[0] + '</span>';
                        if ($('select[name="' + key + '"]').length > 0) {
                            $('select[name="' + key + '"]').after(errorLabelTitle);
                        } else {
                            $('input[name="' + key + '"]').after(errorLabelTitle);
                        }
                    });
                },
                complete: function(res){
                    $('#spinner-div').removeClass('show');
                }
            });
        });

        $(document).on("click",".deleteCategoryBtn", function() {
            var url = $(this).data('href');
            Swal.fire({
                title: "Are You Sure?",
                text: "Are you sure you want to delete this category?",
                icon: "warning",
                showDenyButton: true,  
                confirmButtonText: "Yes, Delete it",  
                denyButtonText: "Cancel!",
            })
            .then(function(result) {
                if (result.isConfirmed) {  
                    $('#spinner-div').addClass('show');
                    $.ajax({
                        type: 'DELETE',
                        url: url,
                        dataType: 'json',
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            if(response.success) {
                                $('#spinner-div').removeClass('show');
                                toastr.success(response.message, 'Success');
                                location.reload();
                            } else {
                                toastr.error(response.message, 'Error');
                                $('#spinner-div').removeClass('show');
                            }
                        },
                        error: function(res) {
                            toastr.error(res.responseJSON.error, 'Error');
                            $('#spinner-div').removeClass('show');
                        },
                        complete: function(res){
                            $('#spinner-div').removeClass('show');
                        }
                    });
                }
            });
        });

        function toggleCategoryStatus(event) {
            event.preventDefault();

            let button = $(event.target);
            let categoryId = button.data('category-id');
            let currentStatus = button.data('status');
            let confirmationMessage = currentStatus === 1
                ? 'Are you sure you want to disable this category?'
                : 'Are you sure you want to enable this category?';

            Swal.fire({
                title: 'Are you sure?',
                text: confirmationMessage,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, toggle it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = `{{ route('categories.toggleStatus', ':categoryId') }}`.replace(':categoryId', categoryId);

                    $.post(url, { _token: '{{ csrf_token() }}' })
                        .done(response => {
                            button.data('status', response.status);
                            toastr.success(response.message, 'Success');
                            location.reload();
                        })
                        .fail(() => {
                            toastr.error('Something went wrong. Please try again later.', 'Error');
                        });
                }
            });
        }

        $(document).on('click', '.configreset', function() {
            $('#editCategoryForm')[0].reset();
            $('#addCategoryForm')[0].reset();
            $('.popup_render_div').html('');
        });
</script>
@endpush
