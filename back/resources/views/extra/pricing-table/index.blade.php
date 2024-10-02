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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pricing Table /</span> Add Pricing Table</h4>
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
                      <h5 class="mb-0">Pricing Table Content</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('store-pricing-table') }}" method="POST">
                    @csrf

                  
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Pricing Table Title</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-heading"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="title"
                                placeholder="Pricing Table Title"
                                aria-label="Pricing Table Title"
                                aria-describedby="basic-icon-default-category2"
                                required
                                value="{{ old('title') }}"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Pricing Table Price</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-dollar"></i>
                            </span> 
                            <input
                                type="number"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="price"
                                placeholder="Pricing Table Price"
                                aria-label="Pricing Table Price"
                                aria-describedby="basic-icon-default-category2" 
                                required
                                value="{{ old('price') }}"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Pricing Table Month</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-calendar"></i>
                            </span> 
                            
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="month"
                                placeholder="Pricing Table Month"
                                aria-label="Pricing Table Month"
                                aria-describedby="basic-icon-default-category2" 
                                required
                                value="{{ old('month') }}"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Pricing Table Year</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-calendar"></i>
                            </span> 
                            
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="year"
                                placeholder="Pricing Table Year"
                                aria-label="Pricing Table Year"
                                aria-describedby="basic-icon-default-category2" 
                                required
                                value="{{ old('year') }}"
                            />
                        </div>
                    </div>

                    

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Pricing Table Points 1</label>
                        <div class="row">
                            <div class="col-8">
                            <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="points[]"
                                placeholder="Pricing Table Points"
                                aria-label="Pricing Table Points"
                                aria-describedby="basic-icon-default-category2" 
                                required
                                value="{{ old('points') }}"
                            />
                            <button type="button" class="btn btn-primary add-point">Add Point</button>
                        </div>  
                            </div>
                            <div class="col-4">
                               <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                              <span class="text-muted"> Available Point 1</span>
                            </span>
                            <select class="form-control" name="available_point[]" id="available_point">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                               </select>
                        </div>   
                            </div>
                        </div>
                        
                    </div>
                    <div class="points"></div>
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
 $(document).ready(function(){
    let pointCounter = 1;

    $('.add-point').click(function(){
        pointCounter++;
        const newPoint = `
            <div class="mb-3 point-container">
                <label class="form-label" for="point-${pointCounter}">Pricing Table Point ${pointCounter}</label>
                <div class="row">
                    <div class="col-8">
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <input type="text" class="form-control" id="point-${pointCounter}" name="points[]" placeholder="Pricing Table Point" aria-label="Pricing Table Point" required>
                    <button type="button" class="btn btn-danger remove-point">Remove</button>
                </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><span class="text-muted"> Available Point ${pointCounter}</span></span>
                            <select class="form-control" name="available_point[]" id="available_point">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('.points').append(newPoint);
    });

    // Use event delegation for dynamically added elements
    $(document).on('click', '.remove-point', function(){
        $(this).closest('.point-container').remove();
    });
});
  </script>
  @endsection          
@endsection

