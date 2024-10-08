import React, { useState, useEffect } from 'react';
import Link from 'next/link'
import logo from '/public/images/site_logo/site_logo.png'
import logo2 from '/public/images/site_logo/logo2.png'
import MobileMenu from '../MobileMenu/MobileMenu'
import Image from 'next/image';
import { fetchServices } from '../../api/service';

const Header = (props) => {

const [mobailActive, setMobailState] = useState(false);
const [services, setServices] = useState([]);
const ClickHandler = () => {
window.scrollTo(10, 0);
}

const [isSticky, setSticky] = useState(false);

useEffect(() => {
const getServices = async () => {
    const cachedData = localStorage.getItem('services');
    let servicesData = cachedData ? JSON.parse(cachedData) : [];
   // console.log(JSON.parse(cachedData))
    try {
        
        if (servicesData) {
           
            // If services exist in local storage, parse and set them
            setServices(servicesData);
        } else {
            const { data } = await fetchServices();
            setServices(data); // Use cached data     
        }
      
    } catch (err) {
        //setError(err); // Handle any errors
    } 
};

getServices();

const handleScroll = () => {
    if (window.scrollY > 80) {
    setSticky(true);
    } else {
    setSticky(false);
    }
    };

    window.addEventListener('scroll', handleScroll);

    // Clean up
    return () => {
    window.removeEventListener('scroll', handleScroll);
    };

}, []);



return (

<header className="site_header site_header_2">
<div className={`header_bottom stricky  ${isSticky ? 'stricked-menu stricky-fixed' : ''}`}>
<div className="container">
<div className="row align-items-center">
    <div className="col-xl-3 col-lg-2 col-5">
        <div className="site_logo">
            <Link onClick={ClickHandler} className="site_link" href="/">
                <Image src={logo} alt="Site Logo – Fujtech – IT Solutions & Technology, Business Consulting, Software Company Site Template" />
                <Image src={logo2} alt="Site Logo – Fujtech – IT Solutions & Technology, Business Consulting, Software Company Site Template" />
            </Link>
        </div>
    </div>
    <div className="col-xl-6 col-lg-7 col-2">
        <nav className="main_menu navbar navbar-expand-lg">
            <div className="main_menu_inner collapse navbar-collapse justify-content-lg-center" id="main_menu_dropdown">
                <ul className="main_menu_list unordered_list justify-content-center">
                <li><Link onClick={ClickHandler} href="/">Home</Link></li>
                
                <li><Link onClick={ClickHandler} href="/portfolio">Our Work</Link></li>
                
                    
                    <li className="dropdown">
                        <Link onClick={ClickHandler} className="nav-link" href="/" id="services_submenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </Link>
                        <div className="dropdown-menu mega_menu_wrapper p-0" aria-labelledby="services_submenu">
                            <div className="container">
                                <div className="row justify-content-lg-between">
                                    <div className="col-lg-8">
                                        <div className="row">
        <div className="col-lg-6">
            <div className="megamenu_widget">
                <h3 className="megamenu_info_title">Services</h3>
                <ul className="icon_list unordered_list_block">
                  {services.length > 0 ? (
            services.map((service,index) => (
                <li key={index}> {/* Use service.id for a unique key */}
                    <Link onClick={ClickHandler} href={`/service`}> {/* Dynamic route for each service */}
                        <span className="icon_list_text">
                            {service.title}
                        </span>
                    </Link>
                </li>
            ))
        ) : (
            <li>No services available.</li>
        )}
                </ul>
            </div>
        </div>
                 
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li><Link onClick={ClickHandler} href="/blog">Blogs</Link></li>
                    <li><Link onClick={ClickHandler} href="/about">About</Link></li>
                    <li><Link onClick={ClickHandler} href="/contact">Contact</Link></li>
                </ul>
            </div>
        </nav>
    </div>
    {/* <div className="col-xl-3 col-lg-3 col-5">
        <ul className="header_btns_group unordered_list justify-content-end">
            <li>
                <button className="mobile_menu_btn" onClick={() => setMobailState(!mobailActive)} type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <i className="far fa-bars"></i>
                </button>
            </li>
            <li>
                <Link onClick={ClickHandler} className="btn btn-primary" href="/pricing">
                    <span className="btn_label" data-text="Get Started">Get Started</span>
                    <span className="btn_icon">
                        <i className="fa-solid fa-arrow-up-right"></i>
                    </span>
                </Link>
            </li>
        </ul>
    </div> */}
</div>
</div>
<div className="mobail-wrap">
<div className={`mobail-menu ${mobailActive ? "active" : ""}`}>
    <div className="xb-header-menu-scroll">
        <div className="xb-menu-close xb-hide-xl xb-close" onClick={() => setMobailState(!mobailActive)}></div>
        <nav className="xb-header-nav">
            <MobileMenu />
        </nav>
    </div>
</div>
<div className="xb-header-menu-backdrop" onClick={() => setMobailState(false)}></div>
</div>
</div>
</header>

)
}

export default Header;