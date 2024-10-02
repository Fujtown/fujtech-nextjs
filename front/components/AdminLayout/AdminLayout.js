import React from 'react';
import Navbar from '../Navbar/Navbar'; // Adjust the path as necessary

const AdminLayout = ({ children }) => {
  return (
    <div className="container-fluid admin">
      <div className="row">
        <div className="col-md-2">
          <Navbar />
        </div>
        <div className="col-md-10">
          {children}
        </div>
      </div>
    </div>
  );
};

export default AdminLayout;