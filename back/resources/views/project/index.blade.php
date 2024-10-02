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
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  {{ session('success') }}
              </div>
              @endif
              <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Projects /</span> All Projects</h4>
              <a href="{{ route('add-project') }}" class="btn btn-primary mb-3">Add Project</a>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">All Projects</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Sr No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Service</th>
                        <th>Cover Image</th>
                        <th>Images</th>
                        <th>Publish Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach ($projects as $project)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $project->title }}</strong></td>
                        <td>{!! Str::limit($project->description, 100) !!}</td>
                        <td>{{ $project->service->title }}</td>
                        <td>
                          <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" style="width: 100px; height: 100px;">
                        </td>
                        <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#viewImagesModal" data-id="{{ $project->id }}"  class="text-primary view-images" data-images="{{ json_encode($project->images) }}" >View Images</a>
                        </td>
                        <td>{{ $project->publish_date->format('d-m-Y') }}</td>
                        <td>
                        <a href="{{ route('edit-project', $project->id) }}" class="text-primary edit-project" data-id="{{ $project->id }}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a href="javascript:void(0);" class="text-danger delete-project" data-id="{{ $project->id }}">
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                            <form id="delete-form-{{ $project->id }}" action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: none;">
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

<!-- View Images Modal -->
<div class="modal fade" id="viewImagesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Project Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="projectImagesContainer"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {

        const viewImagesLinks = document.querySelectorAll('.view-images');
        viewImagesLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const projectId = this.dataset.id;
                const images = JSON.parse(this.dataset.images);
                
                const modal = document.getElementById('viewImagesModal');
                modal.querySelector('#projectImagesContainer').innerHTML = '';
                var storageUrl = "{{ asset('storage') }}";

                modal.classList.add('show');  

                images.forEach(image => {
                        const imgContainer = document.createElement('div');
                        imgContainer.innerHTML = `<img src="${storageUrl}/${image}" alt="Project Image" style="width: 100px; height: 100px;margin: 10px;">`;    
                        modal.querySelector('#projectImagesContainer').appendChild(imgContainer);
        
                        modal.classList.add('show');
                    });
            });
        });

        const deleteLinks = document.querySelectorAll('.delete-project');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const projectId = this.dataset.id;
                
                if (confirm('Are you sure you want to delete this project?')) {
                    document.getElementById('delete-form-' + projectId).submit();
                }
            });
        });


    });
</script>
@endpush