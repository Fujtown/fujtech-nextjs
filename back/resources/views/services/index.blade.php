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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Services /</span> All Services</h4>

              <a href="{{ route('add-service') }}" class="btn btn-primary mb-3">Add Service</a>
              <!-- Basic Bootstrap Table -->
               @if(session('success'))
               <div class="alert alert-success">
               
                   {{ session('success') }}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
               @endif
              <div class="card">
                <h5 class="card-header">All Services</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                          <th>Title</th>
                          <th>Icon</th>
                          <th>Points</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @if($services->isEmpty())
                      <tr>
                        <td colspan="4" class="text-center">No services found</td>
                      </tr>
                      @else
                      @foreach ($services as $service)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $service->title }}</strong></td>
                        
                        <td>
                          <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}" style="width: 100px; height: auto;">
                        </td>

                        <td>
                    @if($service->points)
                    <button type="button" class="btn btn-info view-points" data-points="{{ json_encode(json_decode($service->points)) }}" data-bs-toggle="modal" data-bs-target="#pointsModal">

                            View Points
                        </button>
                    @else
                        <span class="badge bg-secondary">No points available</span>
                    @endif
                </td>
                       
                        <td>
                        <a href="#" class="text-primary edit-service" data-id="{{ $service->id }}" data-title="{{ $service->title }}" data-description="{{ $service->description }}" data-icon="{{ $service->icon }}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a href="javascript:void(0);" class="text-danger delete-service" data-id="{{ $service->id }}">
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                            <form id="delete-form-{{ $service->id }}" action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: none;">
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

            <div class="modal fade" id="pointsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Service Points</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="pointsList" class="list-group">
                    <!-- Points will be populated here -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
            <!-- / Content -->
            <div class="modal fade" id="editServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editServiceForm" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-service-name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="edit-service-name" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-service-icon" class="form-label">Service Icon</label>
                        <input type="file" class="form-control" id="edit-service-icon" name="icon" accept="image/*">
                        <div id="current-icon-container" class="mt-2">
                        <img id="current-icon-image" src="" alt="Current Icon" style="max-width: 100px; max-height: 100px; display: none;">
                    </div>

                    </div>
                    <div class="mb-3">
                        <label for="edit-service-description" class="form-label">Service Description</label>
                        <textarea class="form-control" id="edit-service-description" name="description" rows="3" required></textarea>
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
        const viewPointsButtons = document.querySelectorAll('.view-points');

        viewPointsButtons.forEach(button => {
            button.addEventListener('click', function() {
                const pointsJson = this.getAttribute('data-points');
                const points = JSON.parse(pointsJson);
                const pointsList = document.getElementById('pointsList');

                // Clear previous points
                pointsList.innerHTML = '';

                // Create an ordered list
                const orderedList = document.createElement('ol'); // Create an ordered list

                // Populate the ordered list with points
                points.forEach(point => {
                    const listItem = document.createElement('li'); // Create list item
                    listItem.className = 'list-group-item'; // Optional: Add class for styling
                    listItem.textContent = point; // Set the text content
                    orderedList.appendChild(listItem); // Append list item to ordered list
                });

                // Append the ordered list to the points list container
                pointsList.appendChild(orderedList);
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const editLinks = document.querySelectorAll('.edit-service');
const editModal = new bootstrap.Modal(document.getElementById('editServiceModal'));
const editForm = document.getElementById('editServiceForm');
const editNameInput = document.getElementById('edit-service-name');
const editIconInput = document.getElementById('edit-service-icon');
const currentIconImage = document.getElementById('current-icon-image');
const editDescriptionInput = document.getElementById('edit-service-description');

editLinks.forEach(link => {
    link.addEventListener('click', function() {
        const serviceId = this.dataset.id;
        const serviceName = this.dataset.title;
        const serviceIcon = this.dataset.icon;
        const serviceDescription = this.dataset.description;

        editForm.action = "{{ route('update-service', '') }}/" + serviceId;
        editNameInput.value = serviceName;
        
        // Display the current icon image
        if (serviceIcon) {
            currentIconImage.src = "{{ asset('storage') }}/" + serviceIcon;
            currentIconImage.style.display = 'block';
        } else {
            currentIconImage.style.display = 'none';
        }
        
        // Clear the file input
        editIconInput.value = '';
        
        editDescriptionInput.value = serviceDescription;

        editModal.show();
    });
});

// Add event listener for new file selection
editIconInput.addEventListener('change', function(event) {
    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            currentIconImage.src = e.target.result;
            currentIconImage.style.display = 'block';
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