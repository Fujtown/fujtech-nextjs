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
               
              <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Team /</span> Add Team</h4>
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
                      <h5 class="mb-0">Team Content</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('store-team') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Team Employee Name</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="name"
                                placeholder="Team Employee Name"
                                aria-label="Team Employee Name"
                                aria-describedby="basic-icon-default-category2"
                                required
                            />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Team Image</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="file"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="image"
                                placeholder="Team Image"
                                aria-label="Team Image"
                                aria-describedby="basic-icon-default-category2"
                                required
                            />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Team Employee Designation</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="designation"
                                placeholder="Team Employee Designation"
                                aria-label="Team Employee Designation"
                                aria-describedby="basic-icon-default-category2"
                                required
                            />
                        </div>
                    </div>
                    <div class="mb-3">
                      <div class="row">
                        <div class="col-md-6">
                          <label class="form-label" for="basic-icon-default-category">Twitter</label>
                          <input type="text" class="form-control" name="twitter" placeholder="Twitter" aria-label="Twitter" aria-describedby="basic-icon-default-category2" required/>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label" for="basic-icon-default-category">Linkedin</label>
                          <input type="text" class="form-control" name="linkedin" placeholder="Linkedin" aria-label="Linkedin" aria-describedby="basic-icon-default-category2" required/>
                        </div>
                      </div>    
                    

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
               
              
              </div>
            </div>
            </div>
            <!-- / Content -->

@endsection

