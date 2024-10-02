import React, { useState, useEffect } from 'react';
import { useRouter } from 'next/router';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faBars, faHome, faFolder, faBlog, faClipboardList, faUsers, faPhone, faDollarSign, faPlus, faChevronDown } from '@fortawesome/free-solid-svg-icons';

const Navbar = () => {
  const router = useRouter();
  const [isCategoriesOpen, setCategoriesOpen] = useState(false);
  const [isBlogsOpen, setBlogsOpen] = useState(false);
  const [isServicesOpen, setServicesOpen] = useState(false);
  const [isProjectsOpen, setProjectsOpen] = useState(false);
  const [isExtraPagesOpen, setExtraPagesOpen] = useState(false);
  const [isSidebarOpen, setSidebarOpen] = useState(false);

  // Function to determine if the link is active
  const isActive = (path) => router.pathname === path;

  // Check if any child routes are active to open the dropdown
  const checkDropdownOpen = () => {
    setCategoriesOpen(isActive('/admin/dashboard/categories/add') || isActive('/admin/dashboard/categories/list'));
    setBlogsOpen(isActive('/admin/dashboard/blog/add') || isActive('/admin/dashboard/blog/list'));
    setServicesOpen(isActive('/admin/dashboard/services/add') || isActive('/admin/dashboard/services/list'));
    setProjectsOpen(isActive('/admin/dashboard/projects/add') || isActive('/admin/dashboard/projects/list'));
    setExtraPagesOpen(isActive('/admin/dashboard/contact') || isActive('/admin/dashboard/pricing') || isActive('/admin/dashboard/counter') || isActive('/admin/dashboard/feedback') || isActive('/admin/dashboard/about'));
  };

  // Call checkDropdownOpen on component mount
  useEffect(() => {
    checkDropdownOpen();
  }, [router.pathname]);

  return (
    <div className="admin">
      {/* Hamburger Button */}
      <button 
        className="btn btn-light d-md-none" 
        onClick={() => setSidebarOpen(!isSidebarOpen)}
        style={{ position: 'absolute', zIndex: 1000 }}
      >
        <FontAwesomeIcon icon={faBars} />
      </button>

      {/* Sidebar */}
      <nav className={`bg-white sidebar ${isSidebarOpen ? 'd-block' : 'd-none d-md-block'}`} style={{ height: '100vh', boxShadow: '2px 0 5px rgba(0, 0, 0, 0.1)' }}>
        <div className="sidebar-sticky">
          <h5 className="sidebar-heading">Fujtech</h5>
          <ul className="nav flex-column">
            <li className={`nav-item`}>
              <a className={`nav-link ${isActive('/') ? 'bg-light' : ''}`} href="/">
                <FontAwesomeIcon icon={faHome} className="me-2" />
                Dashboard
              </a>
            </li>
            <li className="nav-item">
              <a 
                className={`nav-link ${isCategoriesOpen ? 'bg-light' : ''}`} 
                onClick={() => setCategoriesOpen(!isCategoriesOpen)} 
                href="#"
              >
                <FontAwesomeIcon icon={faFolder} className="me-2" />
                Categories
                <FontAwesomeIcon icon={faChevronDown} className="ms-auto" />
              </a>
              <ul className={`nav flex-column ms-3 ${isCategoriesOpen ? 'show' : 'collapse'}`}>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/categories/add') ? 'bg-light' : ''}`} href="/admin/dashboard/categories/add">
                    <FontAwesomeIcon icon={faPlus} className="me-2" />
                    Add Category
                  </a>
                </li>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/categories/list') ? 'bg-light' : ''}`} href="/admin/dashboard/categories/list">
                    <FontAwesomeIcon icon={faClipboardList} className="me-2" />
                    Categories List
                  </a>
                </li>
              </ul>
            </li>
            <li className={`nav-item`}>
              <a 
                className={`nav-link ${isBlogsOpen ? 'bg-light' : ''}`} 
                onClick={() => setBlogsOpen(!isBlogsOpen)} 
                href="#"
              >
                <FontAwesomeIcon icon={faBlog} className="me-2" />
                Blogs
                <FontAwesomeIcon icon={faChevronDown} className="ms-auto" />
              </a>
              <ul className={`nav flex-column ms-3 ${isBlogsOpen ? 'show' : 'collapse'}`}>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/blog/add') ? 'bg-light' : ''}`} href="/admin/dashboard/blog/add">
                    <FontAwesomeIcon icon={faPlus} className="me-2" />
                    Add Blog
                  </a>
                </li>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/blog/list') ? 'bg-light' : ''}`} href="/admin/dashboard/blog/list">
                    <FontAwesomeIcon icon={faClipboardList} className="me-2" />
                    Blogs List
                  </a>
                </li>
              </ul>
            </li>
            <li className={`nav-item`}>
              <a 
                className={`nav-link ${isServicesOpen ? 'bg-light' : ''}`} 
                onClick={() => setServicesOpen(!isServicesOpen)} 
                href="#"
              >
                <FontAwesomeIcon icon={faUsers} className="me-2" />
                Services
                <FontAwesomeIcon icon={faChevronDown} className="ms-auto" />
              </a>
              <ul className={`nav flex-column ms-3 ${isServicesOpen ? 'show' : 'collapse'}`}>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/services/add') ? 'bg-light' : ''}`} href="/admin/dashboard/services/add">
                    <FontAwesomeIcon icon={faPlus} className="me-2" />
                    Add Service
                  </a>
                </li>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/services/list') ? 'bg-light' : ''}`} href="/admin/dashboard/services/list">
                    <FontAwesomeIcon icon={faClipboardList} className="me-2" />
                    Services List
                  </a>
                </li>
              </ul>
            </li>
            <li className={`nav-item`}>
              <a 
                className={`nav-link ${isProjectsOpen ? 'bg-light' : ''}`} 
                onClick={() => setProjectsOpen(!isProjectsOpen)} 
                href="#"
              >
                <FontAwesomeIcon icon={faClipboardList} className="me-2" />
                Projects
                <FontAwesomeIcon icon={faChevronDown} className="ms-auto" />
              </a>
              <ul className={`nav flex-column ms-3 ${isProjectsOpen ? 'show' : 'collapse'}`}>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/projects/add') ? 'bg-light' : ''}`} href="#">
                    <FontAwesomeIcon icon={faPlus} className="me-2" />
                    Add Project
                  </a>
                </li>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/projects/list') ? 'bg-light' : ''}`} href="#">
                    <FontAwesomeIcon icon={faClipboardList} className="me-2" />
                    Projects List
                  </a>
                </li>
              </ul>
            </li>
            <li className={`nav-item`}>
              <a 
                className={`nav-link ${isExtraPagesOpen ? 'bg-light' : ''}`} 
                onClick={() => setExtraPagesOpen(!isExtraPagesOpen)} 
                href="#"
              >
                <FontAwesomeIcon icon={faPhone} className="me-2" />
                Extra Pages
                <FontAwesomeIcon icon={faChevronDown} className="ms-auto" />
              </a>
              <ul className={`nav flex-column ms-3 ${isExtraPagesOpen ? 'show' : 'collapse'}`}>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/contact') ? 'bg-light' : ''}`} href="#">
                    <FontAwesomeIcon icon={faPhone} className="me-2" />
                    Contact Page
                  </a>
                </li>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/pricing') ? 'bg-light' : ''}`} href="#">
                    <FontAwesomeIcon icon={faDollarSign} className="me-2" />
                    Pricing Table
                  </a>
                </li>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/counter') ? 'bg-light' : ''}`} href="#">
                    <FontAwesomeIcon icon={faPlus} className="me-2" />
                    Counter
                  </a>
                </li>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/feedback') ? 'bg-light' : ''}`} href="#">
                    <FontAwesomeIcon icon={faUsers} className="me-2" />
                    Clients Feedback
                  </a>
                </li>
                <li className={`nav-item`}>
                  <a className={`nav-link ${isActive('/admin/dashboard/about') ? 'bg-light' : ''}`} href="#">
                    <FontAwesomeIcon icon={faClipboardList} className="me-2" />
                    About Us Page
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  );
};

export default Navbar;