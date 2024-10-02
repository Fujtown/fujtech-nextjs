import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import Navbar from '../../../components/Navbar/Navbar'; // Adjust the path as necessary

const Dashboard = () => {
  return (
    <div className="container-fluid admin">
      <div className="row">
        <div className="col-md-2">
          <Navbar />
        </div>
        <div className="col-md-10">
          {/* Main Content */}
          <main className="px-4">
            <div className="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 className="h2">Dashboard</h1>
            </div>
            <div className="content">
              <p>Welcome to the dashboard!</p>
              {/* Additional dashboard content can go here */}
            </div>
          </main>
        </div>
      </div>
    </div>
  );
};

export default Dashboard;