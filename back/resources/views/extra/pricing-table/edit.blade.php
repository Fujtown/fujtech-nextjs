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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pricing Table /</span> Edit Pricing Table</h4>
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
                    <form action="{{ route('update-pricing-table', $pricingTable->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                  
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
                                value="{{ $pricingTable->title }}"
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
                                value="{{ $pricingTable->price }}"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Pricing Table Month</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-dollar"></i>
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
                                value="{{ $pricingTable->month }}"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">Pricing Table Year</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-dollar"></i>
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
                                value="{{ $pricingTable->year }}"
                            />
                        </div>
                    </div>

                    @php
                                $points = json_decode($pricingTable->points, true);
                                $pointCount = is_array($points) ? count($points) : 0;

                            @endphp
                    @foreach ($points as $point)
                    <div class="mb-3 point-container">
                        <label class="form-label" for="basic-icon-default-category">Pricing Table Points {{ $loop->iteration }}</label>
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
                                value="  {{ $point['point'] }}"
                            />
                            <button type="button" class="btn btn-danger remove-point">Remove Point</button>
                        </div>  
                            </div>
                            <div class="col-4">
                               <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                              <span class="text-muted"> Available Point {{ $loop->iteration }}</span>
                            </span>
                            <select class="form-control" name="available_point[]" id="available_point">
                                <option value="yes" {{ $point['available'] == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $point['available'] == 'no' ? 'selected' : '' }}>No</option>
                               </select>
                        </div>   
                            </div>
                        </div>
                        
                    </div>
                    @endforeach
                    <div class="points"></div>
                    <button type="button" class="btn btn-info add-point">Add Point</button>
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
    let pointCounter = '{{ $pointCount }}';


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
        pointCounter--;
    });
});
  </script>
  @endsection          
@endsection

