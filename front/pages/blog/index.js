import React, { Fragment } from 'react';
import Head from 'next/head'; // Import Head from next/head

import Header from '../../components/Header/Header';
import PageTitle from '../../components/pagetitle/PageTitle'
import Scrollbar from '../../components/scrollbar/scrollbar'
import Footer from '../../components/Footer/Footer';
import CtaSection from '../../components/CtaSection/CtaSection';
import BlogList from '../../components/BlogList';


const BlogPage = (props) => {

    return (
        <Fragment>
              <Head>
                <title>Our Latest Blog - Fujtech</title> {/* Set the title for the blog page */}
                <meta name="description" content="Read the latest articles and updates on our blog." /> {/* Meta description */}
                <meta name="keywords" content="blog, articles, updates, news" /> {/* Meta keywords */}
            </Head>
            <Header />
            <main className="page_content blog-page">
                <PageTitle pageTitle={'Our Latest Blog'} pagesub={'Blogs😍'} pageTop={'Our'}/>
                <BlogList/>
            </main>
            <CtaSection />
            <Footer />
            <Scrollbar />
        </Fragment>
    )
};
export default BlogPage;
