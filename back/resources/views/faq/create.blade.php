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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">FAQ /</span> Add Faq</h4>

              <!-- Basic Layout -->
              <div class="row">
              
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">FAQ Content</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('store-faq') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-category">FAQ Title</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-category2" class="input-group-text">
                                <i class="bx bx-book"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-category"
                                name="title"
                                placeholder="FAQ Title"
                                aria-label="FAQ Title"
                                aria-describedby="basic-icon-default-category2"
                                required
                            />
                        </div>
                    </div>
                    <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-message">Description</label>
                            <div id="editor-container" style="height: 300px;"></div>
                            <input type="hidden" name="content" id="content-input" value="">
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



@section('script')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'direction': 'rtl' }],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'font': [] }],
                    [{ 'align': [] }],
                    ['clean'],
                    ['link', 'image', 'video']
                ]
            }
        });

        // When the form is submitted, update the hidden input with the editor content
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('content-input').value = quill.root.innerHTML;
        });
    });
</script>
@endsection
@endsection