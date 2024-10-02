import React, { Fragment } from 'react';
import Header from '../../components/Header/Header';
import Hero from '../../components/hero/hero';
import FeaturePartners from '../../components/FeaturePartners';
import ServiceSection from '../../components/ServiceSection/ServiceSection';
import About from '../../components/about/about';
import ProcessTechnology from '../../components/ProcessTechnology/ProcessTechnology';
import FaqSection from '../../components/FaqSection/FaqSection';
import BlogSection from '../../components/BlogSection/BlogSection';
import ContactSection from '../../components/ContactSection';
import Scrollbar from '../../components/scrollbar/scrollbar';
import Footer from '../../components/Footer/Footer';


const HomePage2 = () => {

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
                </main>
                <Footer />
                <Scrollbar />
            </div>
        </Fragment>
    )
};
export default HomePage2;