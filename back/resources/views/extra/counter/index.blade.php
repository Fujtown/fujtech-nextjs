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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Counter /</span> Add Counter</h4>
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
              
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Counter Content</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('store-counter') }}" method="POST">
                    @csrf

                  
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Years Experience</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="number"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="years_experience"
                                placeholder="Counter Number"
                                aria-label="Counter Number"
                                aria-describedby="basic-icon-default-category2"
                                required
                                value="{{ $counter->years_experience ?? '' }}"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Projects Done</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span> 
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="projects_done"
                                placeholder="Projects Done"
                                aria-label="Projects Done"
                                aria-describedby="basic-icon-default-category2" 
                                required
                                value="{{ $counter->projects_done ?? '' }}"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Happy Clients</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-user"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="happy_clients"
                                placeholder="Happy Clients"
                                aria-label="Happy Clients"
                                aria-describedby="basic-icon-default-category2" 
                                required
                                value="{{ $counter->happy_clients ?? '' }}"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Expert Members</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-user"></i>
                            </span>
                            <input
                                type="text"   
                                class="form-control"
                                id="basic-icon-default-category"
                                name="expert_members"
                                placeholder="Expert Members"
                                aria-label="Expert Members"
                                aria-describedby="basic-icon-default-category2" 
                                required
                                value="{{ $counter->expert_members ?? '' }}"
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

