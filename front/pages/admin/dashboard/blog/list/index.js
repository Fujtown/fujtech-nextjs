import React from 'react';

function AllBlogs() {
  // Dummy blogs data
  const blogs = [
    { id: 1, title: 'Blog Title 1', category: 'Category	 1', date: '2023-10-01' },
    { id: 2, title: 'Blog Title 2', category: 'Category	 2', date: '2023-10-02' },
    { id: 3, title: 'Blog Title 3', category: 'Category	 3', date: '2023-10-03' },
    { id: 4, title: 'Blog Title 4', category: 'Category	 4', date: '2023-10-04' },
    { id: 5, title: 'Blog Title 5', category: 'Category	 5', date: '2023-10-05' },
  ];

  return (
    <div>
      {/* Breadcrumb */}
      <nav aria-label="breadcrumb" className="mt-3">
        <ol className="breadcrumb">
          <li className="breadcrumb-item"><a href="#">Blogs</a></li>
          <li className="breadcrumb-item active" aria-current="page">List Blogs</li>
        </ol>
      </nav>

      {/* Blogs Table */}
      <div className="card mt-3">
        <div className="card-body">
          <h5 className="card-title">Blogs List</h5>
          <table className="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Blog Title</th>
                <th scope="col">Category</th>
                <th scope="col">Date</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              {blogs.map((blog) => (
                <tr key={blog.id}>
                  <th scope="row">{blog.id}</th>
                  <td>{blog.title}</td>
                  <td>{blog.category}</td>
                  <td>{blog.date}</td>
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

AllBlogs.displayName = 'AllBlogs'; // Set display name

export default AllBlogs;