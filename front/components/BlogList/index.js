import { useRef, useEffect,useState } from 'react';
import Link from 'next/link'
import {fetchBlogs} from '../../api/blogs'
import icon1 from '/public/images/icons/icon_calendar.svg'
import BlogSidebar from '../BlogSidebar';
import Image from 'next/image';
import styles from './BlogList.module.css'; // Import the CSS module
import SkeletonCard from './SkeletonCard'; // Import the SkeletonCard component

const BlogList = (props) => {
    const prevRef = useRef(null);
    const nextRef = useRef(null);
    const swiperRef = useRef(null);
    const [blogs, setBlogs] = useState([]); // Initialize blogs as an empty array
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [currentPage, setCurrentPage] = useState(1); // Current page state
    const [blogsPerPage] = useState(10); // Number of blogs to display per page
   
    useEffect(() => {

        if (swiperRef.current && prevRef.current && nextRef.current) {
            swiperRef.current.params.navigation.prevEl = prevRef.current;
            swiperRef.current.params.navigation.nextEl = nextRef.current;
            swiperRef.current.navigation.init();
            swiperRef.current.navigation.update();
        }

        const getBlogs = async () => {
            const cachedData = localStorage.getItem('all_blog');
            const cachedVersion = localStorage.getItem('all_blogVersion');
            let counterData = cachedData ? JSON.parse(cachedData) : [];
            let currentVersion = cachedVersion ? parseInt(cachedVersion) : 0;
            try {
                const { data,version } = await fetchBlogs();

                if (version > currentVersion) {
                    setBlogs(data); // Set the blogs state with the fetched data // Update state with new data
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
    const currentBlogs = blogs.slice(indexOfFirstBlog, indexOfLastBlog); // Get current blogs
    
    const totalPages = Math.ceil(blogs.length / blogsPerPage); // Total number of pages

        const handlePageChange = (pageNumber) => {
            setCurrentPage(pageNumber); // Update current page
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
                                {currentBlogs.map((blog, Bitem) => (
                                    <div className="col-lg-6" key={Bitem}>
                                        <div className={styles.blogCard}>
                                            <div className={styles.blogImage}>
                                                <Link href={'/blog-single/[slug]'} as={`/blog-single/${blog.slug}`} className={styles.imageWrap}>
                                                    <Image  style={{ objectFit: 'cover'}} layout="fill" src={blog.bImg} alt="Blog Post" />
                                                </Link>
                                            </div>
                                            <div className={styles.blogContent}>
                                                <h3>
                                                    <Link  className={styles.blogTitle} href={'/blog-single/[slug]'} as={`/blog-single/${blog.slug}`}>
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
                                ))}
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
                        <BlogSidebar/>
                    </div>
                </div>
            </div>
        </section>

    )

}

export default BlogList;
