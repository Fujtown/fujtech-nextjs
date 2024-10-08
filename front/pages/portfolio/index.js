import React, { Fragment, useEffect, useState } from 'react';
import { fetchProjects } from '../../api/projects';
import { fetchServices } from '../../api/service';
import Link from "next/link";
import Header from '../../components/Header/Header';
import PageTitle from '../../components/pagetitle/PageTitle';
import Scrollbar from '../../components/scrollbar/scrollbar';
import Footer from '../../components/Footer/Footer';
import CtaSection from '../../components/CtaSection/CtaSection';
import Image from 'next/image';

const PortfolioPage = (props) => {
    const [services, setServices] = useState([]);
    const [projects, setProjects] = useState([]);
    const [activeFilter, setActiveFilter] = useState('all');

    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const getServices = async () => {
            const cachedData = localStorage.getItem('services');
            const cachedVersion = localStorage.getItem('servicesVersion');
            let servicesData = cachedData ? JSON.parse(cachedData) : [];
            let currentVersion = cachedVersion ? parseInt(cachedVersion) : 0;

            try {
                const storedServices = localStorage.getItem('services');

                if (storedServices) {
                    // If services exist in local storage, parse and set them
                    setServices(JSON.parse(storedServices));
                } else {

                    const { data, version } = await fetchServices();
                    if (version > currentVersion) {
                        setServices(data); // Update state with new data
                        localStorage.setItem('services', JSON.stringify(data)); // Update local storage
                        localStorage.setItem('servicesVersion', version); // Update version in local storage
                    } else {
                        setServices(servicesData); // Use cached data
                    }
                }

                const { data } = await fetchProjects();
                  
                setProjects(data);
              
            } catch (err) {
                setError(err); // Handle any errors
            } finally {
                setLoading(false); // Set loading to false
            }
        };

        getServices();
    }, []);
     
    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error fetching partners: {error.message}</div>;




    const ClickHandler = () => {
        window.scrollTo(10, 0);
    }

    const handleFilterClick = (filter) => {
        setActiveFilter(filter);
    }

    // Filter projects based on the active filter
    const filteredProjects = activeFilter === 'all'
        ? projects // Show all projects
        : projects.filter(project => project.category === activeFilter); // Match the category


    return (
        <Fragment>
            <Header />
            <main className="page_content about-page">
                <PageTitle pageTitle={'Our Portfolio'} pagesub={'Portfolio 😍'} pageTop={'Our'} />
                <section className="portfolio_section section_space bg-light">
                    <div className="container">
                        <div className="filter_elements_nav">
                            <ul className="unordered_list justify-content-center">
                                <li className={activeFilter === 'all' ? 'active' : ''} onClick={() => handleFilterClick('all')}>See All</li>
                                {services.length > 0 ? (
                                    services.map((service, index) => (
                                        <li key={index} className={activeFilter === service.title ? 'active' : ''} onClick={() => handleFilterClick(service.title)}>
                                            {service.title}
                                        </li>
                                    ))
                                ) : (
                                    <p>No services available for this category.</p>
                                )}
                            </ul>
                        </div>
                        <div className="filter_elements_wrapper row">
                            {filteredProjects.map((project, prj) => (
                                <div className="col-lg-6" key={prj}>
                                    <div className="portfolio_block portfolio_layout_2">
                                        <div className="portfolio_image">
                                            <Link onClick={ClickHandler} className="portfolio_image_wrap bg-light" href='#' >
                                                <img src={project.bImg} alt="Mobile App Design" />
                                            </Link>
                                        </div>
                                        <div className="portfolio_content">
                                            <h3 className="portfolio_title">
                                                <Link onClick={ClickHandler} href='#' >
                                                    {project.title}
                                                </Link>
                                            </h3>
                                            <ul className="category_list unordered_list">
                                                <li><Link onClick={ClickHandler} href='#' ><i className="fa-solid fa-tags"></i> {project.category}</Link></li>
                                               </ul>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>

                <CtaSection />
            </main>
            <Footer />
            <Scrollbar />
        </Fragment>
    )
};

export default PortfolioPage;
