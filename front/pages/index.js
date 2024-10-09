import React, { Fragment } from 'react';
    import Header from '../components/Header/Header';
import Hero from '../components/hero/hero';
import FeaturePartners from '../components/FeaturePartners';
import ProcessTechnology from '../components/ProcessTechnology/ProcessTechnology';
import FaqSection from '../components/FaqSection/FaqSection';
import BlogSection from '../components/BlogSection/BlogSection';
import ContactSection from '../components/ContactSection';
import About from '../components/about/about';
import ServiceSection from '../components/ServiceSection/ServiceSection';
import Footer from '../components/Footer/Footer';
import Scrollbar from '../components/scrollbar/scrollbar';

//Remove Service-single and team-single pages
const HomePage = () => {

    return (
        <Fragment>
            <div>
                <Header />
                <main className="page_content">
                    <Hero />
                    <FeaturePartners />
                    <ServiceSection />
                    <About />
                    <ProcessTechnology />
                    <FaqSection />
                    <BlogSection />
                    <ContactSection />
                    {/* 
                    <CtaSection /> */}
                </main>
                <Footer />
                <Scrollbar />
            </div>
        </Fragment>
    )
};
export default HomePage;