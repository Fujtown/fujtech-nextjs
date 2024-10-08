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
                
               
              <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Team /</span> All Team</h4>
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <a href="{{ route('add-team') }}" class="btn btn-primary mb-3">Add Team</a>
              <!-- Basic Bootstrap Table -->
               @if(session('success'))
               <div class="alert alert-success">
               
                   {{ session('success') }}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
               @endif
              <div class="card">
                <h5 class="card-header">All Team</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                          <th>Name</th>
                          <th>Image</th>
                          <th>Designation</th>
                          <th>Twitter</th>
                          <th>Linkedin</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @if($team->isEmpty())
                      <tr>
                        <td colspan="6" class="text-center">No Team Member found</td>
                      </tr>
                      @else
                      @foreach ($team as $team)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $team->name }}</strong></td>
                        
                        <td>
                          <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}" style="width: 100px; height: auto;">
                        </td>
                        <td>{{ $team->designation }}</td>
                        <td>{{ $team->twitter }}</td>
                        <td>{{ $team->linkedin }}</td>

                    
                       
                        <td>
                        <a href="#" class="text-primary edit-team" data-id="{{ $team->id }}" data-name="{{ $team->name }}" 
                        data-designation="{{ $team->designation }}" data-twitter="{{ $team->twitter }}" data-linkedin="{{ $team->linkedin }}" data-image="{{ $team->image }}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a href="javascript:void(0);" class="text-danger delete-team" data-id="{{ $team->id }}">
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                            <form id="delete-form-{{ $team->id }}" action="{{ route('delete-team', $team->id) }}" method="POST" style="display: none;">
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
            <div class="modal fade" id="editTeamModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Team Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editTeamForm" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-team-name" class="form-label">Team Member Name</label>
                        <input type="text" class="form-control" id="edit-team-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-team-image" class="form-label">Team Member Image</label>
                        <input type="file" class="form-control" id="edit-team-image" name="image" accept="image/*">
                        <div id="current-icon-container" class="mt-2">
                        <img id="current-image" src="" alt="Current Icon" style="max-width: 100px; max-height: 100px; display: none;">
                    </div>

                    </div>
                    <div class="mb-3">
                        <label for="edit-team-designation" class="form-label">Team Member Designation</label>
                        <input type="text" class="form-control" id="edit-team-designation" name="designation" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-team-twitter" class="form-label">Team Member Twitter</label>
                        <input type="text" class="form-control" id="edit-team-twitter" name="twitter" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-team-linkedin" class="form-label">Team Member Linkedin</label>
                        <input type="text" class="form-control" id="edit-team-linkedin" name="linkedin" required>
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

        const editLinks = document.querySelectorAll('.edit-team');
const editModal = new bootstrap.Modal(document.getElementById('editTeamModal'));
const editForm = document.getElementById('editTeamForm');
const editNameInput = document.getElementById('edit-team-name');
const editImageInput = document.getElementById('edit-team-image');
const currentImage = document.getElementById('current-image');
const editDesignationInput = document.getElementById('edit-team-designation');
const editTwitterInput = document.getElementById('edit-team-twitter');
const editLinkedinInput = document.getElementById('edit-team-linkedin');

editLinks.forEach(link => {
    link.addEventListener('click', function() {
        const serviceId = this.dataset.id;
        const serviceName = this.dataset.name;
        const serviceImage = this.dataset.image;
        // console.log(serviceImage);
        const serviceDesignation = this.dataset.designation;
        const serviceTwitter = this.dataset.twitter;
        const serviceLinkedin = this.dataset.linkedin;

        editForm.action = "{{ route('update-team', '') }}/" + serviceId;
        editNameInput.value = serviceName;
        
        // Display the current icon image
        if (serviceImage) {
            currentImage.src = "{{ asset('storage') }}/" + serviceImage;
            currentImage.style.display = 'block';
        } else {
            currentImage.style.display = 'none';
        }
        
        // Clear the file input
        editImageInput.value = '';
        
        editDesignationInput.value = serviceDesignation;
        editTwitterInput.value = serviceTwitter;
        editLinkedinInput.value = serviceLinkedin;

        editModal.show();
    });
});

// Add event listener for new file selection
editImageInput.addEventListener('change', function(event) {
    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            currentImage.src = e.target.result;
            currentImage.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
});

        const deleteLinks = document.querySelectorAll('.delete-service');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const serviceId = this.dataset.id;
                
                if (confirm('Are you sure you want to delete this service?')) {
                    document.getElementById('delete-form-' + serviceId).submit();
                }
            });
        });

    });
</script>
@endpush