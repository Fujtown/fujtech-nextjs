import React, { useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

function AddService() {
  const [serviceTitle, setserviceTitle] = useState('');
  const [servicedescription, setserviceDescription] = useState('');
  const [coverImage, setCoverImage] = useState(null);
  const handleSubmit = (e) => {
    e.preventDefault();
    // Handle form submission logic here
    console.log('Service Title:', serviceTitle);
    console.log('Service Description:', servicedescription);
    console.log('Service Image:', servicedescription);
  };

  const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      setCoverImage(URL.createObjectURL(file)); // Create a URL for the selected file
    }
  };


  return (
    <div>
          {/* Breadcrumb */}
          <nav aria-label="breadcrumb" className="mt-3">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="#">Services</a></li>
              <li className="breadcrumb-item active" aria-current="page">Add Service</li>
            </ol>
          </nav>

          <div className="card mt-3">
            <div className="card-body">
              <h5 className="card-title">Service Content</h5>
              <form onSubmit={handleSubmit}>
                <div className="mb-3">
                  <label htmlFor="serviceTitle" className="form-label">Service Title</label>
                  <input
                    type="text"
                    className="form-control"
                    id="serviceTitle"
                    value={serviceTitle}
                    onChange={(e) => setserviceTitle(e.target.value)}
                    placeholder="Category Title"
                    required
                  />
                </div>
                <div className="mb-3">
            <label htmlFor="coverImage" className="form-label">Service Cover Image</label>
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
                  <label htmlFor="serviceTitle" className="form-label">Service Description</label>
                 <textarea  onChange={(e) => setserviceDescription(e.target.value)} className='form-control' name='description' rows={5}></textarea>
                </div>


                <button type="submit" className="btn">Submit</button>
              </form>
            </div>
          </div>
    </div>
  );
}

AddService.displayName = 'AddService'; // Set display name

export default AddService;