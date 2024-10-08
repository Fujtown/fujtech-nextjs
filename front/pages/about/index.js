import React, { Fragment, useState } from 'react';
import Header from '../../components/Header/Header';
import PageTitle from '../../components/pagetitle/PageTitle'
import Scrollbar from '../../components/scrollbar/scrollbar'
// import Footer from '../../components/Footer/Footer';
import Footer from '../../components/Footer/Footer'; // Updated casing

import aImg from '/public/images/about/team.jpg'
import aImg2 from '/public/images/about/about_image_4-1.png'
import ModalVideo from 'react-modal-video'
import PolicySection from './Policy';
import WhyUs from './WhyUs';
import FeaturesSection from '../../components/FeaturesSection/FeaturesSection';
import TeamSection from '../../components/TeamSection/TeamSection';
import CtaSection from '../../components/CtaSection/CtaSection';
import Image from 'next/image';


const AboutUsPage = (props) => {

    const [isOpen, setOpen] = useState(false)
    return (
        <Fragment>
            <Header />
            <main className="page_content about-page">
                <PageTitle pageTitle={'About Us'} pagesub={'More Fujtech 😃'} pageTop={'About'}/>
                <section className="intro_about_section section_space bg-light">
                    <div className="intro_about_content">
                        <div className="container">
                            <div className="row">
                                <div className="col-lg-8">
                                    <div className="image_wrap">
                                        <Image src={aImg} alt="Fujtech - About " />
                                    </div>
                                </div>
                                <div className="col-lg-4">
                                    <div className="image_wrap position-relative">
                                        <Image src={aImg2} alt="Fujtech - About" />
                                        <button className="video_btn ripple_effect" onClick={() => setOpen(true)}>
                                            <span className="btn_icon">
                                                <i className="fa-solid fa-play"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="container">
                        <div className="heading_block mb-0">
                            <div className="row justify-content-lg-between">
                                <div className="col-lg-4">
                                    <div className="heading_focus_text">
                                        About
                                        <span className="badge bg-secondary text-white">Fujtech 🙂</span>
                                    </div>
                                    <h2 className="heading_text mb-0">
                                        We Provide You Flexible Services
                                    </h2>
                                </div>
                                <div className="col-lg-6">
                                    <p className="heading_description mb-0">
                                        At Fujtech, we pride ourselves on offering dynamic and  IT  to suit your specific requirements. Our flexible approach means we can  adjust our offerings to accommodate your evolving needs, whether you require comprehensive IT infrastructure support, strategic consultancy, software development
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <PolicySection />
                <FeaturesSection />
                <TeamSection />
                <WhyUs />
                <CtaSection />
            </main>
            <Footer />
            <Scrollbar />
            <ModalVideo channel='youtube' autoplay isOpen={isOpen} videoId="O6kkiFIn2MA" onClose={() => setOpen(false)} />
        </Fragment>
    )
};
export default AboutUsPage;
