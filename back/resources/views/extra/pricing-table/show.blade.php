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
               @if(session('success'))
              <div class="alert alert-success">
                    <h4>{{ session('success') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  {{ session('success') }}
              </div>
              @endif
              <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pricing Table /</span> All Pricing Table</h4>
              <a href="{{ route('add-pricing-table') }}" class="btn btn-primary mb-3">Add Pricing Table</a>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">All Pricing Table</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                          <th>Title</th>
                        <th>Price</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Points</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if($pricingTable->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">No pricing table found.</td>
                        </tr>
                        @else
                      @foreach($pricingTable as $table)
                        <tr>
                          <td>{{ $table->title }}</td>
                          <td>{{ $table->price }}</td>  
                          <td>{{ $table->month }}</td>
                          <td>{{ $table->year }}</td>
                          <td>
                          @php
                                $points = json_decode($table->points, true);
                            @endphp

                            @foreach ($points as $point)
                                <li style="list-style: decimal;">
                                    {{ $point['point'] }}
                                    @if ($point['available'])
                                    
                                    @if($point['available'] == 'yes')
                                    <span class="text-success" style="font-size: 12px;text-transform: uppercase;">{{ $point['available'] }}</span>
                                    @else
                                        <span class="text-danger" style="font-size: 12px;text-transform: uppercase;">{{ $point['available'] }}</span>  
                                     
                                   @endif     
                                    @endif
                                </li>
                            @endforeach
                          </td>
                          <td>
                            <a href="{{ route('edit-pricing-table', $table->id) }}" class="btn btn-primary">Edit</a>
                            <a href="javascript:void(0);" class="btn btn-danger delete-pricing-table" data-id="{{ $table->id }}">Delete</a>
                            <form id="delete-form-{{ $table->id }}" action="{{ route('delete-pricing-table', $table->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                        </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->

             
              </div>



           

              <!--/ Responsive Table -->
            </div>
               
              
              </div>
            </div>
            <!-- / Content -->

            <!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-category-name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="edit-category-name" name="title" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

      const deleteLinks = document.querySelectorAll('.delete-pricing-table');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const pricingTableId = this.dataset.id;
                
                if (confirm('Are you sure you want to delete this pricing table?')) {
                    document.getElementById('delete-form-' + pricingTableId).submit();
                }
            });
        });


        const editLinks = document.querySelectorAll('.edit-category');
        const editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        const editForm = document.getElementById('editCategoryForm');
        const editNameInput = document.getElementById('edit-category-name');

        editLinks.forEach(link => {
            link.addEventListener('click', function() {
                const categoryId = this.dataset.id;
                const categoryName = this.dataset.name;

                editForm.action = "{{ route('update-category', '') }}/" + categoryId;
                editNameInput.value = categoryName;

                editModal.show();
            });
        });
    });
</script>
@endpush