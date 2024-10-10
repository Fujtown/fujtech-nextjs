import React, { useEffect, useState } from 'react';
import Link from 'next/link'
import icon from '/public/images/icons/icon_search.svg';
import icon1 from '/public/images/icons/icon_calendar.svg'
import Image from 'next/image';
import { fetchCategories } from '../../api/categories'; // Import the fetch function
const BlogSidebar = ({ setSearchTerm, handleCategoryClick,resetFilters }) => {

    const [categories, setCategories] = useState([]); // Initialize as an empty array
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [categoryCounts, setCategoryCounts] = useState({}); // State to hold category counts
    useEffect(() => {
        const getCategories = async () => {
            const cachedData = localStorage.getItem('categories');
            const cachedVersion = localStorage.getItem('categoriesVersion');
            let categoriesData = cachedData ? JSON.parse(cachedData) : [];
            let currentVersion = cachedVersion ? parseInt(cachedVersion) : 0;
    
            try {
                const { data, version } = await fetchCategories(); // Assume fetchServices returns data and version
                    // console.log(version)
                // Check if the fetched version is different from the cached version
                if (version > currentVersion) {
                    setCategories(data); // Update state with new data
                    localStorage.setItem('categories', JSON.stringify(data)); // Update local storage
                    localStorage.setItem('categoriesVersion', version); // Update version in local storage
                } else {
                    setCategories(categoriesData); // Use cached data
                }
            } catch (err) {
                setError(err); // Handle any errors
            } finally {
                setLoading(false); // Set loading to false
            }
        };
    
        getCategories();
    }, []);


    useEffect(() => {
        const cachedData = localStorage.getItem('all_blog');
        const blogs = cachedData ? JSON.parse(cachedData) : [];

        // Count blogs for each category
        const counts = {};
        blogs.forEach(blog => {
            const categories = blog.category_id; // Assuming category_id is an array of category IDs
            if (Array.isArray(categories)) {
                categories.forEach(category => {
                    const trimmedCategory = category; // Use the category ID directly
                    counts[trimmedCategory] = (counts[trimmedCategory] || 0) + 1; // Increment count for each category
                });
            } else {
                // If category_id is a single value, handle it here
                const trimmedCategory = categories; // Use the single category ID
                counts[trimmedCategory] = (counts[trimmedCategory] || 0) + 1; // Increment count for the single category
            }
        });

        setCategoryCounts(counts); // Set the category counts state
    }, []);

    if (loading) return <div>Loading...</div>; // Show loading state
    if (error) return <div>Error fetching services: {error.message}</div>; // Show error message

    
    const ClickHandler = () => {
        window.scrollTo(10, 0);
    }



    return (
        <div className="col-lg-4">
            <aside className="sidebar ps-lg-5">
                <div className="search_form">
                    <h3 className="sidebar_widget_title">Search</h3>
                    <form className="form-group" onSubmit={(e) => e.preventDefault()}>
                        <input 
                            className="form-control" 
                            type="search" 
                            name="search" 
                            placeholder="Search your keyword" 
                            onChange={(e) => setSearchTerm(e.target.value)} // Update search term
                        />
                        <button type="submit">
                            <Image src={icon} alt="Search Icon" />
                        </button>
                    </form>
                </div>
                <div className="post_category_wrap">
                    <h3 className="sidebar_widget_title">Categories</h3>
                    <ul className="post_category_list unordered_list_block">
                        {categories.map((category, srv) => (
                            <li key={srv}>
                                <Link onClick={() => handleCategoryClick(category.id)} href={'#'}>
                                    <i className="fa-solid fa-arrow-up-right"></i>
                                    <span>{category.title}</span>
                                    <span>({categoryCounts[category.id] || 0})</span> {/* Display category count */}
                                </Link>
                            </li>
                        ))}
                    </ul>
                </div>
                <div className="reset_button_wrap">
                    <button onClick={resetFilters} className="btn">Reset Filters</button> {/* Reset button */}
                </div>
               
            </aside>
        </div>
    )

}

export default BlogSidebar;
