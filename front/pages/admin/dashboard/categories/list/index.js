import React from 'react'

function AllCategories() {
  // Dummy categories data
  const categories = [
    { id: 1, title: 'Category 1' },
    { id: 2, title: 'Category 2' },
    { id: 3, title: 'Category 3' },
    { id: 4, title: 'Category 4' },
    { id: 5, title: 'Category 5' },
  ];

  return (
    <div>
    {/* Breadcrumb */}
    <nav aria-label="breadcrumb" className="mt-3">
      <ol className="breadcrumb">
        <li className="breadcrumb-item"><a href="#">Categories</a></li>
        <li className="breadcrumb-item active" aria-current="page">List Category</li>
      </ol>
    </nav>

    {/* Categories Table */}
    <div className="card mt-3">
      <div className="card-body">
        <h5 className="card-title">Categories List</h5>
        <table className="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Category Title</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            {categories.map((category) => (
              <tr key={category.id}>
                <th scope="row">{category.id}</th>
                <td>{category.title}</td>
                <td>
                  <button className="btn btn-warning btn-sm me-2">Edit</button>
                  <button className="btn btn-danger btn-sm">Delete</button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  </div>
  );
}

AllCategories.displayName = 'ListCategory'; // Set display name


export default AllCategories