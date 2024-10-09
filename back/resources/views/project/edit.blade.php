@extends('layouts.admin')
@section('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Projects /</span> Edit Project</h4>

              @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              <!-- Basic Layout -->
              <div class="row">
              
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Edit Project</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('update-project', $project->id) }}" enctype="multipart/form-data" method="POST">
                    
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Project Title</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="title"
                                placeholder="Project Title"
                                aria-label="Project Title"
                                aria-describedby="basic-icon-default-category2"
                                value="{{ $project->title }}"
                                required
                            />
                        </div>
                    </div>
                    <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-company">Project Cover Image</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-company2" class="input-group-text"
                              ><i class="bx bx-image"></i
                            ></span>
                            <input
                              type="file"
                              name="cover_image" 
                              id="basic-icon-default-company"
                              class="form-control"
                              placeholder="Project Cover Image"
                              aria-label="Project Cover Image"
                              aria-describedby="basic-icon-default-company2"
                            />
                          </div>
                          <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" style="width: 100px; height: 100px;margin-top: 10px;">
                        </div>
                    <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-message">Description</label>
                            <div id="editor-container" style="height: 300px;">
                            {!! $project->description !!}

                            </div>
                            <input type="hidden" name="description" id="content-input" value="{{ $project->description }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-message">Service</label>
                            <select class="form-select" id="basic-icon-default-message" name="service_id">
                                <option value="">Select Service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" {{ $project->service_id == $service->id ? 'selected' : '' }}>{{ $service->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                       
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-company">Project images</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-company2" class="input-group-text"
                              ><i class="bx bx-image"></i
                            ></span>
                            <input
                              type="file"
                              multiple
                              name="images[]" 
                              id="basic-icon-default-company"
                              class="form-control"
                              placeholder="ACME Inc."
                              aria-label="ACME Inc."
                              aria-describedby="basic-icon-default-company2"
                            />
                          </div>
                          @foreach ($project->images as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $project->title }}" style="width: 100px; height: 100px; margin: 10px;">
                          @endforeach
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-message">Publish Date</label>
                            <input type="text" class="form-control flatpickr-date" id="basic-icon-default-message" name="publish_date" required placeholder="Select Publish Date" value="{{ $project->publish_date }}">
                        </div>      



                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
               
              
              </div>
            </div>
            <!-- / Content -->



@section('script')
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    flatpickr(".flatpickr-date", {
        dateFormat: "Y-m-d",
        allowInput: true,
        altInput: true,
        altFormat: "F j, Y",
    });
});
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'direction': 'rtl' }],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'font': [] }],
                    [{ 'align': [] }],
                    ['clean'],
                    ['link', 'image', 'video']
                ]
            }
        });

        // When the form is submitted, update the hidden input with the editor content
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('content-input').value = quill.root.innerHTML;
        });
    });
</script>
@endsection

@endsection