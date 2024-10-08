import React, { useEffect, useState } from 'react';
import Link from 'next/link'
import icon from '/public/images/icons/icon_search.svg';
import icon1 from '/public/images/icons/icon_calendar.svg'
import Image from 'next/image';

const BlogSidebar = (props) => {

    const [services, setServices] = useState([]); // Initialize as an empty array
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const getServices = async () => {
            const cachedData = localStorage.getItem('services');
            try {
                // Parse the cached data if it exists
                const parsedData = cachedData ? JSON.parse(cachedData) : [];
                setServices(parsedData); // Use cached data or an empty array if no data
            } catch (err) {
                setError(err); // Handle any errors
            } finally {
                setLoading(false); // Set loading to false
            }
        };

        getServices();
    }, []);

    if (loading) return <div>Loading...</div>; // Show loading state
    if (error) return <div>Error fetching services: {error.message}</div>; // Show error message

    
    const ClickHandler = () => {
        window.scrollTo(10, 0);
    }
    const SubmitHandler = (e) => {
        e.preventDefault()
    }

    return (
        <div className="col-lg-4">
            <aside className="sidebar ps-lg-5">
                <div className="search_form">
                    <h3 className="sidebar_widget_title">Search</h3>
                    <form className="form-group" onSubmit={SubmitHandler}>
                        <input className="form-control" type="search" name="search" placeholder="Search your keyword" />
                        <button type="submit">
                            <Image src={icon} alt="Search Icon" />
                        </button>
                    </form>
                </div>
                <div className="post_category_wrap">
                    <h3 className="sidebar_widget_title">Categories</h3>
                    <ul className="post_category_list unordered_list_block">
                        {services.slice(0, 4).map((service, srv) => (
                            <li key={srv}>
                                <Link onClick={ClickHandler} href={'/service-single/[slug]'} as={`/service-single/${service.slug}`}>
                                    <i className="fa-solid fa-arrow-up-right"></i>
                                    <span>{service.title}</span>
                                    <span>(0{service.Id})</span>
                                </Link>
                            </li>
                        ))}
                    </ul>
                </div>
                <div className="popular_tags">
                    <h3 className="sidebar_widget_title">Popular Tags</h3>
                    <ul className="tags_list unordered_list">
                        <li><Link onClick={ClickHandler} href="/blog">Cybersecurity</Link></li>
                        <li><Link onClick={ClickHandler} href="/blog">TechSolutions</Link></li>
                        <li><Link onClick={ClickHandler} href="/blog">UX Design</Link></li>
                        <li><Link onClick={ClickHandler} href="/blog">App Dev</Link></li>
                        <li><Link onClick={ClickHandler} href="/blog">Data</Link></li>
                        <li><Link onClick={ClickHandler} href="/blog">Solution</Link></li>
                        <li><Link onClick={ClickHandler} href="/blog">Consultants</Link></li>
                        <li><Link onClick={ClickHandler} href="/blog">IT</Link></li>
                        <li><Link onClick={ClickHandler} href="/blog">Optimization</Link></li>
                        <li><Link onClick={ClickHandler} href="/blog">Startup</Link></li>
                    </ul>
                </div>
            </aside>
        </div>
    )

}

export default BlogSidebar;
