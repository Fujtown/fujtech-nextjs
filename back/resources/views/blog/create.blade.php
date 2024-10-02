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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blogs /</span> Add Blog</h4>

              <!-- Basic Layout -->
              <div class="row">
              
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Blog Content</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                      <form action="{{ route('store-blog') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Blog Title</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                               name="title"
                              class="form-control"
                              id="basic-icon-default-fullname"
                              placeholder="John Doe"
                              aria-label="John Doe"
                              aria-describedby="basic-icon-default-fullname2"
                              required
                              value="{{ old('title') }}"
                            />
                          </div>
                        </div>
                        <div class="mb-3">
                        <div class="row">
                          <div class="col-md-9">
                          <label for="exampleFormControlSelect1" class="form-label">Select Category</label>
                          <select  name="category_id" id="category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option  value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                        @endforeach
                    </select>
                          </div>
                          <div class="col-md-3">
                            <label for="exampleFormControlSelect1" class="form-label">&nbsp;</label>
                            <input type="button" class="btn btn-primary w-100 add-category" value="Add Category">
                         
                          </div>
                        </div>
                      </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-company">Blog Cover Image</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-company2" class="input-group-text"
                              ><i class="bx bx-image"></i
                            ></span>
                            <input
                              type="file"
                              name="cover_image" 
                              id="basic-icon-default-company"
                              class="form-control"
                              placeholder="ACME Inc."
                              aria-label="ACME Inc."
                              aria-describedby="basic-icon-default-company2"
                            />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-keywords">Keywords</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-hash"></i></span>
                            <input
                              type="text"
                              
                              id="basic-icon-default-keywords"
                              class="form-control"
                              placeholder="Enter keywords"
                              aria-label="keywords"
                              aria-describedby="basic-icon-default-keywords2"
                              
                            
                            />
                          </div>
                          <div id="keyword-tags" class="mt-2"></div>
                          <input type="hidden" id="keywords-hidden" name="keywords" value="{{ old('keywords') }}" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-tags">Tags</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-hash"></i></span>
                            <input
                              type="text"
                              id="basic-icon-default-tags"
                              class="form-control"
                              placeholder="Enter tags"  
                              aria-label="tags"
                              aria-describedby="basic-icon-default-tags2"
                             
                            />
                          </div>
                          <div id="tag-tags" class="mt-2"></div>
                          <input type="hidden" id="tags-hidden" name="tags" value="{{ old('tags') }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-message">Description</label>
                            <div id="editor-container" style="height: 300px;">
                            {!! old('content') !!}

                            </div>
                            <input type="hidden" name="content" id="content-input" value="{!! old('content') !!}">
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

            <!-- Add this at the end of your file, just before the closing </body> tag -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="newCategoryName" class="form-label">Category Name</label>
          <input type="text" class="form-control" id="newCategoryName" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveNewCategory">Save</button>
      </div>
    </div>
  </div>
</div>
            
            <!-- / Content -->

  @section('script')
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

  <script>
document.addEventListener('DOMContentLoaded', function() {
    const addCategoryBtn = document.querySelector('.add-category');
    const modal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
    const saveNewCategoryBtn = document.getElementById('saveNewCategory');
    const newCategoryNameInput = document.getElementById('newCategoryName');
    const categoryDropdown = document.querySelector('select[name="category_id"]');

    addCategoryBtn.addEventListener('click', function() {
        modal.show();
    });

    saveNewCategoryBtn.addEventListener('click', function() {
        const newCategoryName = newCategoryNameInput.value.trim();
        if (newCategoryName) {
            // Send AJAX request
            fetch('{{ route("store-category") }}', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'X-Requested-With': 'XMLHttpRequest'  // This line is crucial
              },
                body: JSON.stringify({ title: newCategoryName })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add new category to dropdown
                    const option = new Option(data.category.title, data.category.id);
                    categoryDropdown.add(option);
                    
                    // Select the new category
                    categoryDropdown.value = data.category.id;

                    // Close modal and clear input
                    modal.hide();
                    newCategoryNameInput.value = '';

                    // Show success message
                    alert('Category added successfully!');
                } else {
                    alert('Error adding category: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding the category.');
            });
        } else {
            alert('Please enter a category name.');
        }
    });
});
</script>

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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const keywordInput = document.getElementById('basic-icon-default-keywords');
    const keywordTags = document.getElementById('keyword-tags');
    const hiddenInput = document.getElementById('keywords-hidden');
    // let keywords = [];
    let keywords = hiddenInput.value ? hiddenInput.value.split(',') : [];


    keywordInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ',' || e.key === 'Tab') {
            e.preventDefault();
            addKeyword();
        }
    });

    
    function addKeyword() {
        const keyword = keywordInput.value.trim();
        if (keyword && !keywords.includes(keyword)) {
            keywords.push(keyword);
            renderKeywords();
            keywordInput.value = '';
        }
    }

    function renderKeywords() {
        keywordTags.innerHTML = '';
        keywords.forEach((keyword, index) => {
            const tag = document.createElement('span');
            tag.className = 'badge bg-primary me-1 mb-1';
            tag.textContent = keyword;
            
            const removeBtn = document.createElement('span');
            removeBtn.className = 'ms-1 cursor-pointer';
            removeBtn.innerHTML = '&times;';
            removeBtn.onclick = () => removeKeyword(index);
            
            tag.appendChild(removeBtn);
            keywordTags.appendChild(tag);
        });
        hiddenInput.value = keywords.join(',');
    }

    function removeKeyword(index) {
        keywords.splice(index, 1);
        renderKeywords();
    }

    renderKeywords();

    const tagInput = document.getElementById('basic-icon-default-tags');
    const tagTags = document.getElementById('tag-tags');
    const hiddenInput1 = document.getElementById('tags-hidden');
    // let tags = [];
    let tags = hiddenInput1.value ? hiddenInput1.value.split(',') : [];

    tagInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ',' || e.key === 'Tab') {
            e.preventDefault();
            addTag();
        }
    });

    function addTag() {
        const tag = tagInput.value.trim();
        if (tag && !tags.includes(tag)) {
            tags.push(tag);
            renderTags();
            tagInput.value = '';
        }
    }
     
    function renderTags() {
        tagTags.innerHTML = '';
        tags.forEach((tag, index) => {
            const tagElement = document.createElement('span');
            tagElement.className = 'badge bg-success me-1 mb-1';
            tagElement.textContent = tag;
            
            const removeBtn = document.createElement('span');     
            removeBtn.className = 'ms-1 cursor-pointer';
            removeBtn.innerHTML = '&times;';
            removeBtn.onclick = () => removeTag(index);
            
            tagElement.appendChild(removeBtn);
            tagTags.appendChild(tagElement);
        });
        hiddenInput1.value = tags.join(',');
    }

    function removeTag(index) {
        tags.splice(index, 1);
        renderTags();
    }

    renderTags();

});
  </script>
  @endsection
@endsection

