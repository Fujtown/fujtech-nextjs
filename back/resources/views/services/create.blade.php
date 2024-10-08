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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Services /</span> Add Service</h4>
              @if ($errors->any())
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
                      <h5 class="mb-0">Service Content</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('store-service') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Service Title</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="title"
                                placeholder="Service Title"
                                aria-label="Service Title"
                                aria-describedby="basic-icon-default-category2"
                                required
                            />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Service Icon</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="file"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="icon"
                                placeholder="Service Icon"
                                aria-label="Service Icon"
                                aria-describedby="basic-icon-default-category2"
                                required
                            />
                        </div>
                    </div>
                    <div class="mb-3" id="points-container">

                    <div class="input-group input-group-merge mb-2 mt-3">
                                <span class="input-group-text">
                                    <i class="bx bx-book"></i>
                                </span>
                                <input type="text" class="form-control" name="points[]" placeholder="Service Point" aria-label="Service Point" required="">
                                <button type="button" class="btn btn-secondary" id="add-point">Add Point</button>
                            </div>
                       
                            <button type="button" class="btn btn-danger remove-point" style="display:none;">Remove</button>
                       
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Service Description</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <textarea
                                class="form-control"
                                id="basic-icon-default-category"
                                name="description"
                                placeholder="Service Description"
                                aria-label="Service Description"
                                aria-describedby="basic-icon-default-category2"
                                required
                            /></textarea>
                        </div>
                    </div>
                    

                    <button type="submit" class="btn btn-primary">Submit</button>
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
            <script>
                        document.getElementById('add-point').addEventListener('click', function() {
                            const container = document.getElementById('points-container');
                            const newInputGroup = document.createElement('div');
                            newInputGroup.className = 'input-group input-group-merge mb-2';
                            newInputGroup.innerHTML = `
                                <span class="input-group-text">
                                    <i class="bx bx-book"></i>
                                </span>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="points[]"
                                    placeholder="Service Point"
                                    aria-label="Service Point"
                                    required
                                />
                                <button type="button" class="btn btn-danger remove-point">Remove</button>
                            `;
                            container.appendChild(newInputGroup);
                        });

                        document.getElementById('points-container').addEventListener('click', function(e) {
                            if (e.target.classList.contains('remove-point')) {
                                e.target.parentElement.remove();
                            }
                        });
                    </script>
            @endsection
@endsection

