@extends('layouts.admin')
@section('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection
@section('content') 
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('admin.common.menu')
        
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('admin.common.navbar')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
             
              <div class="row">
               @if(session('success'))
              <div class="alert alert-success">
                    <h4>{{ session('success') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  {{ session('success') }}
              </div>
              @endif
              <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Categories /</span> All Categories</h4>
              <a href="{{ route('add-category') }}" class="btn btn-primary mb-3">Add Category</a>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">All Categories</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                          <th>Title</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach ($categories as $category)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $category->title }}</strong></td>
                        <td>{{ $category->slug }}</td>
                        <td>
                          {{ $category->created_at }}
                        </td>
                        <td>
                        <a href="javascript:void(0);" class="text-primary edit-category" data-id="{{ $category->id }}" data-name="{{ $category->title }}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a href="javascript:void(0);" class="text-danger delete-category" data-id="{{ $category->id }}">
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                            <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            
                            </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->



           

              <!--/ Responsive Table -->
            </div>
               
              
              </div>
            </div>
            <!-- / Content -->

            <!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-category-name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="edit-category-name" name="title" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

      const deleteLinks = document.querySelectorAll('.delete-category');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const categoryId = this.dataset.id;
                
                if (confirm('Are you sure you want to delete this category?')) {
                    document.getElementById('delete-form-' + categoryId).submit();
                }
            });
        });


        const editLinks = document.querySelectorAll('.edit-category');
        const editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        const editForm = document.getElementById('editCategoryForm');
        const editNameInput = document.getElementById('edit-category-name');

        editLinks.forEach(link => {
            link.addEventListener('click', function() {
                const categoryId = this.dataset.id;
                const categoryName = this.dataset.name;

                editForm.action = "{{ route('update-category', '') }}/" + categoryId;
                editNameInput.value = categoryName;

                editModal.show();
            });
        });
    });
</script>
@endpush