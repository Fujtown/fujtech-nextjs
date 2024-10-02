import React from 'react';

function AllServices() {
  // Dummy blogs data
  const services = [
    { id: 1, title: 'Blog Title 1', cover_img: 'Image 1', date: '2023-10-01' },
    { id: 2, title: 'Blog Title 2', cover_img: 'Image 2', date: '2023-10-02' },
  ];

  return (
    <div>
      {/* Breadcrumb */}
      <nav aria-label="breadcrumb" className="mt-3">
        <ol className="breadcrumb">
          <li className="breadcrumb-item"><a href="#">Services</a></li>
          <li className="breadcrumb-item active" aria-current="page">List Services</li>
        </ol>
      </nav>

      {/* Blogs Table */}
      <div className="card mt-3">
        <div className="card-body">
          <h5 className="card-title">Services List</h5>
          <table className="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Blog Title</th>
                <th scope="col">Cover Image</th>
                <th scope="col">Date</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              {services.map((service) => (
                <tr key={service.id}>
                  <th scope="row">{service.id}</th>
                  <td>{service.title}</td>
                  <td>{service.cover_img}</td>
                  <td>{service.date}</td>
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

AllServices.displayName = 'AllServices'; // Set display name

export default AllServices;