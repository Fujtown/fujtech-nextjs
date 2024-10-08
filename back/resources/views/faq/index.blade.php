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
               @if(session('success'))
              <div class="alert alert-success">
                    <h4>{{ session('success') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  {{ session('success') }}
              </div>
              @endif
              <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">FAQ /</span> All Faq</h4>
              <a href="{{ route('add-faq') }}" class="btn btn-primary mb-3">Add Faq</a>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">All FAQ</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                          <th>Title</th>
                        <th>Created At</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach ($faqs as $faq)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $faq->question }}</strong></td>
                        
                        <td>
                          {{ $faq->created_at }}
                        </td>
                        <td>
                        <a href="{{ route('edit-faq', $faq->id) }}" class="text-primary " data-id="{{ $faq->id }}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a href="javascript:void(0);" class="text-danger delete-faq" data-id="{{ $faq->id }}">
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                            <form id="delete-form-{{ $faq->id }}" action="{{ route('delete-faq', $faq->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            
                            </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->



           

              <!--/ Responsive Table -->
            </div>
               
              
              </div>
            </div>
            <!-- / Content -->


@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

      const deleteLinks = document.querySelectorAll('.delete-faq');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const faqId = this.dataset.id;
                
                if (confirm('Are you sure you want to delete this FAQ?')) {
                    document.getElementById('delete-form-' + faqId).submit();
                }
            });
        });


        
    });
</script>
@endpush