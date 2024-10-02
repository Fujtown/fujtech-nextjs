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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Categories /</span> Add Category</h4>

              <!-- Basic Layout -->
              <div class="row">
              
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Category Content</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('store-category') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Category Title</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="title"
                                placeholder="Category Title"
                                aria-label="Category Title"
                                aria-describedby="basic-icon-default-category2"
                                required
                            />
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

@endsection

