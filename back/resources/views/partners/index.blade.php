@extends('layouts.admin')
@section('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection
@section('content') 
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('common.menu')
        
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('common.navbar')

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Partners /</span> All Partners</h4>
              <a href="{{ route('add-partner') }}" class="btn btn-primary mb-3">Add Partner</a>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">All Partners</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Sr.No</th>
                        <th>Title</th>
                          <th>Image</th>
                        <th>URL</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if($partners->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">No partners found.</td>
                            </tr>
                        @else 
                        
                        @foreach ($partners as $partner)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $partner->title }}</strong></td>
                        <td><img src="{{ asset('storage/' . $partner->image) }}" alt="{{ $partner->title }}" style="width: 100px; height: 100px;"></td>
                        <td>{{ $partner->url }}</td>
                        <td>
                        <a href="javascript:void(0);" class="text-primary edit-partner" data-id="{{ $partner->id }}" data-name="{{ $partner->title }}" data-url="{{ $partner->url }}" data-image="{{ $partner->image }}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a href="javascript:void(0);" class="text-danger delete-partner" data-id="{{ $partner->id }}">
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                            <form id="delete-form-{{ $partner->id }}" action="{{ route('delete-partner', $partner->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            
                            </td>
                      </tr>
                      @endforeach
                      @endif
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
<div class="modal fade" id="editPartnerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Partner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form id="editPartnerForm" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-partner-title" class="form-label">Partner Title</label>
                        <input type="text" class="form-control" id="edit-partner-title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-partner-url" class="form-label">Partner URL</label>
                        <input type="text" class="form-control" id="edit-partner-url" name="url" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-partner-image" class="form-label">Partner Image</label>
                        <input type="file" class="form-control" id="edit-partner-image" name="image" >
                        <img id="current-partner-image" src="" alt="Current Partner Image" style="max-width: 100px; max-height: 100px; display: none;"> 
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

      const deleteLinks = document.querySelectorAll('.delete-partner');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const partnerId = this.dataset.id;
                
                if (confirm('Are you sure you want to delete this partner?')) {
                    document.getElementById('delete-form-' + partnerId).submit();
                }
            });
        });


        const editLinks = document.querySelectorAll('.edit-partner');
        const editModal = new bootstrap.Modal(document.getElementById('editPartnerModal'));
        const editForm = document.getElementById('editPartnerForm');
        const editNameInput = document.getElementById('edit-partner-title');
        const editUrlInput = document.getElementById('edit-partner-url');
        const currentPartnerImage = document.getElementById('current-partner-image');
        const editImageInput = document.getElementById('edit-partner-image');

        editLinks.forEach(link => {
            link.addEventListener('click', function() {
                const partnerId = this.dataset.id;
                const partnerName = this.dataset.name;
                const partnerUrl = this.dataset.url;
                const partnerImage = this.dataset.image;
                editForm.action = "{{ route('update-partner', '') }}/" + partnerId;
                editNameInput.value = partnerName;
                editUrlInput.value = partnerUrl;
                // Display the current icon image
                if (partnerImage) {
                    currentPartnerImage.src = "{{ asset('storage') }}/" + partnerImage;
                    currentPartnerImage.style.display = 'block';
                } else {
                    currentPartnerImage.style.display = 'none';
                }
        
                // Clear the file input
                editImageInput.value = '';


                editModal.show();
            });
        });
    });
</script>
@endpush