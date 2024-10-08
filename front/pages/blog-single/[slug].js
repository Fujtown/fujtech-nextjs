import React, { Fragment, useEffect, useState } from 'react';
import { useRouter } from 'next/router';
import { fetchBlogBySlug } from '../../api/blogs'; // Import the fetch function
import Header from '../../components/Header/Header';
import PageTitle from '../../components/pagetitle/PageTitle';
import Scrollbar from '../../components/scrollbar/scrollbar';
import Footer from '../../components/Footer/Footer';
import CtaSection from '../../components/CtaSection/CtaSection';
import BlogSingle from '../../components/BlogDetails/BlogDetails';

const BlogDetailsPage = () => {
    const router = useRouter();
    const { slug } = router.query; // Get the slug from the URL
    const [blogDetails, setBlogDetails] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        if (slug) {
            const getBlogDetails = async () => {
                try {
                    const data = await fetchBlogBySlug(slug); // Fetch the blog by slug
                    setBlogDetails(data); // Set the blog details in state
                } catch (err) {
                    setError(err); // Handle any errors
                } finally {
                    setLoading(false); // Set loading to false
                }
            };

            getBlogDetails();
        }
    }, [slug]);

    if (loading) return <div>Loading...</div>; // Show loading state
    if (error) return <div>Error fetching blog: {error.message}</div>; // Show error message

    return (
        <Fragment>
            <Header />
            <main className="page_content about-page">
                <PageTitle pageTitle={blogDetails?.title} pagesub={'Details 😍'} pageTop={'Blog'} />
                <BlogSingle blogDetails={blogDetails} /> {/* Pass blog details as props */}
            </main>
            <CtaSection />
            <Footer />
            <Scrollbar />
        </Fragment>
    );
};

export default BlogDetailsPage;