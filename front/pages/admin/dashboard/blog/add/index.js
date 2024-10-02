import React, { useState } from 'react';
import dynamic from 'next/dynamic'; // Import dynamic from Next.js
import 'react-quill/dist/quill.snow.css'; // Import Quill styles


// Dynamically import ReactQuill to avoid SSR issues
const ReactQuill = dynamic(() => import('react-quill'), { ssr: false });


const AddBlog = () => {
  const [blogTitle, setBlogTitle] = useState('');
  const [selectedCategory, setSelectedCategory] = useState('');
  const [coverImage, setCoverImage] = useState(null);
  const [keywords, setKeywords] = useState('');
  const [tags, setTags] = useState('');
  const [description, setDescription] = useState('');
  const [keywordList, setKeywordList] = useState([]);
  const [TagList, setTagList] = useState([]);

  const handleSubmit = (e) => {
    e.preventDefault();
    // Handle form submission logic here
    console.log({
      blogTitle,
      selectedCategory,
      coverImage,
      keywords,
      tags,
      description,
    });
  };

  const handleKeywordKeyDown = (e) => {
    if (e.key === 'Tab' || e.key === 'Enter') {
      e.preventDefault();
      if (keywords.trim() !== '') {
        setKeywordList([...keywordList, keywords.trim()]);
        setKeywords('');
      }
    }
  };
  const handleTagKeyDown = (e) => {
    if (e.key === 'Tab' || e.key === 'Enter') {
      e.preventDefault();
      if (tags.trim() !== '') {
        setTagList([...TagList, tags.trim()]);
        setTags('');
      }
    }
  };

  const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      setCoverImage(URL.createObjectURL(file)); // Create a URL for the selected file
    }
  };


   // Custom toolbar options
  const modules = {
    toolbar: [
      [{ 'header': [1, 2, false] }],
      [{ 'size': ['small', false, 'large', 'huge'] }], // Add font size options

      // Add color and background color options
      [{ 'color': [] }, { 'background': [] }],
      ['bold', 'italic', 'underline', 'blockquote'],
      [{ 'list': 'ordered' }, { 'list': 'bullet' }],
      ['link', 'image'],
       
      ['clean'], // Remove formatting button
    ],
  };
  return (
    <div className="card mt-3">
      <div className="card-body">
        <h5 className="card-title">Blog Content</h5>
        <form onSubmit={handleSubmit}>
          <div className="mb-3">
            <label htmlFor="blogTitle" className="form-label">Blog Title</label>
            <input
              type="text"
              className="form-control"
              id="blogTitle"
              value={blogTitle}
              onChange={(e) => setBlogTitle(e.target.value)}
              placeholder="Enter blog title"
              required
            />
          </div>

          <div className="mb-3">
           <div className='row'>
          <div className='col-md-10'>
          <label htmlFor="category" className="form-label">Select Category</label>
            <select
              className="form-select"
              id="category"
              value={selectedCategory}
              onChange={(e) => setSelectedCategory(e.target.value)}
              required
            >
              <option value="">Select Category</option>
              <option value="category1">Category 1</option>
              <option value="category2">Category 2</option>
              <option value="category3">Category 3</option>
            </select>
          
          </div>
          <div className='col-md-2'>
          <label htmlFor="category" className="form-label"></label>
          <button style={{marginTop: '30px'}}  className="btn">Add Category</button>
          </div>
           </div>
          </div>

          <div className="mb-3">
            <label htmlFor="coverImage" className="form-label">Blog Cover Image</label>
            <input
              type="file"
              className="form-control"
              id="coverImage"
              onChange={handleImageChange}

            />
              {coverImage && (
            <div className="mb-3">
              <img src={coverImage} alt="Cover Preview" className="img-fluid mt-2 custom-upload" />
            </div>
          )}
          </div>

          <div className="mb-3">
            <label htmlFor="keywords" className="form-label">Keywords</label>
            <div className="d-flex flex-wrap">
              {keywordList.map((keyword, index) => (
                <span key={index} className="badge bg-primary me-2 mb-2">
                  {keyword}
                  <button
                    type="button"
                    className="btn-close btn-close-white ms-1"
                    onClick={() => setKeywordList(keywordList.filter((_, i) => i !== index))}
                    aria-label="Remove"
                  ></button>
                </span>
              ))}
              <input
                type="text"
                className="form-control"
                id="keywords"
                value={keywords}
                onChange={(e) => setKeywords(e.target.value)}
                onKeyDown={handleKeywordKeyDown}
                placeholder="Enter keywords"
              />
            </div>
          </div>

          <div className="mb-3">
          <label htmlFor="tags" className="form-label">Tags</label>
          <div className="d-flex flex-wrap">
              {TagList.map((tag, index) => (
                <span key={index} className="badge bg-primary me-2 mb-2">
                  {tag}
                  <button
                    type="button"
                    className="btn-close btn-close-white ms-1"
                    onClick={() => setTagList(TagList.filter((_, i) => i !== index))}
                    aria-label="Remove"
                  ></button>
                </span>
              ))}
             <input
              type="text"
              className="form-control"
              id="tags"
              value={tags}
              onChange={(e) => setTags(e.target.value)}
              onKeyDown={handleTagKeyDown}
              placeholder="Enter tags"
            />
            </div>
          </div>

          <div className="mb-3">
            <label htmlFor="description" className="form-label">Description</label>
            <ReactQuill
              value={description}
              onChange={setDescription}
              placeholder="Enter blog description"
              theme="snow"
              modules={modules} // Use the custom toolbar
              style={{ height: '300px' }} // Set the height of the editor
            />
          </div>
          <button type="submit" className="btn btn-primary mt-5">Submit</button>
        </form>
      </div>
    </div>
  );
};
AddBlog.displayName = 'AddBlog'; // Set display name
export default AddBlog;