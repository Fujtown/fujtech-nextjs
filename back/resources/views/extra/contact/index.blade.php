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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Contact /</span> Add Contact</h4>
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
                      <h5 class="mb-0">Contact Content</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('store-contact') }}" method="POST">
                    @csrf

                  
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Contact Phone</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="number"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="phone"
                                placeholder="Contact Phone"
                                aria-label="Contact Phone"
                                aria-describedby="basic-icon-default-category2"
                                required
                                value="{{ $contact->phone ?? '' }}"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Contact Email</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span> 
                            <input
                                type="email"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="email"
                                placeholder="Contact Email"
                                aria-label="Contact Email"
                                aria-describedby="basic-icon-default-category2" 
                                required
                                value="{{ $contact->email ?? '' }}"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Contact Address</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="address"
                                placeholder="Contact Address"
                                aria-label="Contact Address"
                                aria-describedby="basic-icon-default-category2" 
                                required
                                value="{{ $contact->address ?? '' }}"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Contact Map</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="text"   
                                class="form-control"
                                id="basic-icon-default-category"
                                name="map"
                                placeholder="Contact Map"
                                aria-label="Contact Map"
                                aria-describedby="basic-icon-default-category2" 
                                required
                                value="{{ $contact->map ?? '' }}"
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

