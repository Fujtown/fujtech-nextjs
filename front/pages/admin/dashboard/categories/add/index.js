import React, { useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

function AddCategory() {
  const [categoryTitle, setCategoryTitle] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    // Handle form submission logic here
    console.log('Category Title:', categoryTitle);
  };

  return (
    <div>
          {/* Breadcrumb */}
          <nav aria-label="breadcrumb" className="mt-3">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="#">Categories</a></li>
              <li className="breadcrumb-item active" aria-current="page">Add Category</li>
            </ol>
          </nav>

          <div className="card mt-3">
            <div className="card-body">
              <h5 className="card-title">Category Content</h5>
              <form onSubmit={handleSubmit}>
                <div className="mb-3">
                  <label htmlFor="categoryTitle" className="form-label">Category Title</label>
                  <input
                    type="text"
                    className="form-control"
                    id="categoryTitle"
                    value={categoryTitle}
                    onChange={(e) => setCategoryTitle(e.target.value)}
                    placeholder="Category Title"
                    required
                  />
                </div>
                <button type="submit" className="btn">Submit</button>
              </form>
            </div>
          </div>
    </div>
  );
}

AddCategory.displayName = 'AddCategory'; // Set display name

export default AddCategory;