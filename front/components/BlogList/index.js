import { useRef, useEffect, useState } from 'react';
import Link from 'next/link';
import { fetchBlogs } from '../../api/blogs';
import icon1 from '/public/images/icons/icon_calendar.svg';
import notfound from '/public/images/404.png';
import BlogSidebar from '../BlogSidebar';
import Image from 'next/image';
import styles from './BlogList.module.css'; // Import the CSS module

const BlogList = (props) => {
    const prevRef = useRef(null);
    const nextRef = useRef(null);
    const swiperRef = useRef(null);
    const [blogs, setBlogs] = useState([]); // Initialize blogs as an empty array
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [currentPage, setCurrentPage] = useState(1); // Current page state
    const [blogsPerPage] = useState(10); // Number of blogs to display per page
    const [searchTerm, setSearchTerm] = useState(''); // State for search term
    const [selectedCategory, setSelectedCategory] = useState(null); // State for selected category

    useEffect(() => {
        const getBlogs = async () => {
            const cachedData = localStorage.getItem('all_blog');
            const cachedVersion = localStorage.getItem('all_blogVersion');
            let counterData = cachedData ? JSON.parse(cachedData) : [];
            let currentVersion = cachedVersion ? parseInt(cachedVersion) : 0;
            try {
                const { data, version } = await fetchBlogs();

                if (version > currentVersion) {
                    setBlogs(data); // Set the blogs state with the fetched data
                    localStorage.setItem('all_blog', JSON.stringify(data)); // Update local storage
                    localStorage.setItem('all_blogVersion', version); // Update version in local storage
                } else {
                    setBlogs(counterData); // Use cached data
                }
            } catch (err) {
                setError(err); // Handle any errors
            } finally {
                setLoading(false); // Set loading to false
            }
        };

        getBlogs();
    }, []);

    if (loading) return <div>Loading...</div>; // Show loading state
    if (error) return <div>Error fetching blogs: {error.message}</div>; // Show error message

    const indexOfLastBlog = currentPage * blogsPerPage; // Last blog index
    const indexOfFirstBlog = indexOfLastBlog - blogsPerPage; // First blog index

    // Filter blogs based on search term and selected category
    const filteredBlogs = blogs.filter(blog => {
        const matchesSearchTerm = blog.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
            blog.keywords.toLowerCase().includes(searchTerm.toLowerCase()) ||
            blog.slug.toLowerCase().includes(searchTerm.toLowerCase()) ||
            blog.tags.split(',').some(tag => tag.trim().toLowerCase().includes(searchTerm.toLowerCase()));

        const matchesCategory = selectedCategory 
            ? (Array.isArray(blog.category_id) 
                ? blog.category_id.includes(selectedCategory) 
                : blog.category_id === selectedCategory) // Check if category_id is an array or a single value
            : true; // If no category is selected, include all blogs

        return matchesSearchTerm && matchesCategory; // Return true if both conditions are met
    });

    const currentBlogs = filteredBlogs.slice(indexOfFirstBlog, indexOfLastBlog); // Get current blogs based on filtered results

    const totalPages = Math.ceil(filteredBlogs.length / blogsPerPage); // Total number of pages

    const handlePageChange = (pageNumber) => {
        setCurrentPage(pageNumber); // Update current page
    };

    const handleCategoryClick = (categoryId) => {
        setSelectedCategory(categoryId); // Set the selected category
        setCurrentPage(1); // Reset to the first page
    };

    const resetFilters = () => {
        setSearchTerm(''); // Clear the search term
        setSelectedCategory(null); // Reset the selected category
        setCurrentPage(1); // Reset to the first page
    };

    const ClickHandler = () => {
        window.scrollTo(10, 0);
    }

    return (
        <section className="blog_section section_space bg-light">
            <div className="container-fluid">
                <div className="section_space pt-5 pb-0">
                    <div className="row">
                        <div className="col-lg-8">
                            <div className='row'>
                                {currentBlogs.length === 0 ? ( // Check if no blogs found
                                    <div className="col-12" style={{ textAlign: 'center' }}> {/* Center the text */}
                                        <Image width={'80%'} src={notfound} alt="Blog Post" style={{ width: '80%' }} /> {/* Set image width to 80% */}
                                    </div>
                                ) : (
                                    currentBlogs.map((blog, Bitem) => (
                                        <div className="col-lg-6" key={Bitem}>
                                            <div className={styles.blogCard}>
                    <div className={styles.blogImage} style={{ backgroundImage: `url(${blog.bImg})`, objectFit: 'cover', height: '210px', width: '100%',backgroundPosition:'center',backgroundSize:'cover' }}>

                                                    {/* <Link href={'/blog-single/[slug]'} as={`/blog-single/${blog.slug}`} className={styles.imageWrap}> */}
                                                    {/* <img src={blog.bImg} alt="Blog Post" className={styles.blogImageChild} /> */}
                                                    {/* </Link> */}
                                                </div>
                                                <div className={styles.blogContent}>
                                                    <h3>
                                                        <Link className={styles.blogTitle} href={'/blog-single/[slug]'} as={`/blog-single/${blog.slug}`}>
                                                            {blog.title}
                                                        </Link>
                                                    </h3>
                                                    <p className={styles.blogDate}>
                                                        <Image src={icon1} alt="Icon Calendar" /> {blog.date}
                                                    </p>
                                                    <p className={styles.blogDescription}>
                                                        {blog.description}
                                                    </p>
                                                    <Link href={'/blog-single/[slug]'} as={`/blog-single/${blog.slug}`} className={styles.readMoreButton}>
                                                        Read More
                                                    </Link>
                                                </div>
                                            </div>
                                        </div>
                                    ))
                                )}
                            </div>

                            <div className="pagination_wrap pb-0">
                                <ul className={`${styles.pagination_nav} unordered_list justify-content-center`}>
                                    {Array.from({ length: totalPages }, (_, index) => (
                                        <li key={index + 1}>
                                            <Link
                                                href="#"
                                                onClick={() => handlePageChange(index + 1)}
                                                className={currentPage === index + 1 ? styles.active : ''} // Apply active class
                                            >
                                                {index + 1}
                                            </Link>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        </div>
                        <BlogSidebar setSearchTerm={setSearchTerm} resetFilters={resetFilters} handleCategoryClick={handleCategoryClick} /> {/* Pass handleCategoryClick to BlogSidebar */}
                    </div>
                </div>
            </div>
        </section>
    )
}

export default BlogList;