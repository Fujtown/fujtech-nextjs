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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blogs /</span> All Blogs</h4>
              <a href="{{ route('add-blog') }}" class="btn btn-primary mb-3">Add Blog</a>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">All Blogs</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Keywords</th>
                          <th>Tags</th>
                          <th>Cover Image</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @if($blogs->isEmpty())
                      <tr>
                        <td colspan="4" class="text-center">No blogs found</td>
                      </tr>
                      @else
                      @foreach ($blogs as $blog)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $blog->title }}</strong></td>
                        <td>{{ $blog->category->title }}</td>
                        <td>
                            @foreach (explode(',', $blog->keywords) as $keyword)
                                <span class="badge bg-primary me-1 mb-1">{{ $keyword }}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach (explode(',', $blog->tags) as $tag)
                                <span class="badge bg-secondary me-1 mb-1">{{ $tag }}</span>
                            @endforeach
                        </td>
                        <td>
                          <img src="{{ asset('storage/' . $blog->cover_image_resized) }}" alt="{{ $blog->title }}" style="width: 100px; height: auto;">
                        </td>
                       
                        <td>
                        <a href="{{ route('edit-blog', $blog->id) }}" class="text-primary edit-blog"  >
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a href="javascript:void(0);" class="text-danger delete-blog" data-id="{{ $blog->id }}">
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                            <form id="delete-form-{{ $blog->id }}" action="{{ route('delete-blog', $blog->id) }}" method="POST" style="display: none;">
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



           

              <!--/ Responsive Table -->
            </div>
               
              
              </div>
            </div>
            <!-- / Content -->

   
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

      const deleteLinks = document.querySelectorAll('.delete-blog');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const blogId = this.dataset.id;
                
                if (confirm('Are you sure you want to delete this blog?')) {
                    document.getElementById('delete-form-' + blogId).submit();
                }
            });
        });

    });
</script>
@endpush