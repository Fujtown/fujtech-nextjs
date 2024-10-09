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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">About /</span> Add About</h4>
              @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
              @endif
              @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
              @endif
              <!-- Basic Layout -->
              <div class="row">
              @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">About Content</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('store-about') }}" enctype="multipart/form-data" method="POST">
                    @csrf

                  
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">About Image</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="file"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="image"
                                placeholder="About Image"
                                aria-label="About Image"
                                aria-describedby="basic-icon-default-category2"
                                required
                            />
                          
                        </div>
                        <br>
                            @if($about != null)
                            <img src="{{ asset('storage/' . $about->image) }}" alt="About Image" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                            @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">About Description</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span> 
                            <textarea
                                class="form-control"
                                id="basic-icon-default-category"
                                name="description"
                                placeholder="About Description"
                                aria-label="About Description"
                                aria-describedby="basic-icon-default-category2" 
                                required
                            >{{ $about->description ?? '' }}</textarea>
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

