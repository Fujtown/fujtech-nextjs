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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Clients Feedback /</span> Add Client Feedback</h4>

              <!-- Basic Layout -->
              <div class="row">
              
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Client Feedback Content</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                      @endif  
                    <form action="{{ route('store-client') }}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Client Name</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="name"
                                placeholder="Client Name"
                                aria-label="Client Name"
                                aria-describedby="basic-icon-default-category2"
                                required
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-category">Client Image</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-image"></i>
                            </span>
                            <input
                                type="file"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="image"
                                placeholder="Client Image"
                                aria-label="Client Image"
                                aria-describedby="basic-icon-default-category2"
                                required
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-category">Client Message</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-message-square-detail"></i>
                            </span>
                            <textarea
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="message"
                                placeholder="Client Message"
                                aria-label="Client Message"
                                aria-describedby="basic-icon-default-category2"
                                required
                            ></textarea>
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

