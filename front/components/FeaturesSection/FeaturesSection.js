import React, { useEffect, useState } from 'react';
import PartnerSection from '../PartnerSection';
import CountUp from 'react-countup';
import sIcon1 from '/public/images/icons/icon_head.webp'
import sIcon2 from '/public/images/icons/icon_check.webp'
import sIcon3 from '/public/images/icons/icon_like.webp'
import sIcon4 from '/public/images/icons/icon_dart_board.webp'
import fimg from '/public/images/about/about_image_1.webp'
import Image from 'next/image';
import { fetchCounters } from '../../api/counters'; // Import the fetch function


const FeaturesSection = (props) => {
    const [counter, setCounter] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const getCounter = async () => {
            const cachedData = localStorage.getItem('counter');
            const cachedVersion = localStorage.getItem('counterVersion');
            let counterData = cachedData ? JSON.parse(cachedData) : [];
            let currentVersion = cachedVersion ? parseInt(cachedVersion) : 0;

            try {
                const { data, version } = await fetchCounters();
                if (version > currentVersion) {
                    setCounter(data[0]); // Update state with new data
                    localStorage.setItem('counter', JSON.stringify(data[0])); // Update local storage
                    localStorage.setItem('counterVersion', version); // Update version in local storage
                } else {
                    setCounter(counterData); // Use cached data
                }
            } catch (err) {
                setError(err); // Handle any errors
            } finally {
                setLoading(false); // Set loading to false
            }
        };

        getCounter();
    }, []);
     
    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error fetching counters: {error.message}</div>;

    return (
        <section className="client_logo_section section_space" style={{ backgroundImage: `url(${'/images/shapes/bg_pattern_1.svg'})` }}>
            <div className="container">
                <div className="section_space pt-0">
                    <div className="heading_block text-center">
                        <div className="heading_focus_text mb-0">
                            <span className="badge bg-secondary text-white">Brand We</span>
                            Work With
                        </div>
                    </div>
                    <PartnerSection />
                </div>

                <div className="row funfact_wrapper">
                    <div className="col-lg-12">
                        <div className="row">

                                <div className="col-md-3">
                                    <div className="funfact_block">
                                        <div className="funfact_icon">
                                            <Image src={sIcon1} alt="Fujtech - SVG Icon Head" />
                                        </div>
                                        <div className="funfact_content">
                                            <div className="counter_value">
                                                <span className="odometer" data-count="{counter.years_experience}">
                                                    <CountUp end={counter.years_experience} enableScrollSpy /></span>
                                               
                                            </div>
                                            <h3 className="funfact_title mb-0">Years of experience</h3>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-md-3">
                                    <div className="funfact_block">
                                        <div className="funfact_icon">
                                            <Image src={sIcon2} alt="Fujtech - SVG Icon Head" />
                                        </div>
                                        <div className="funfact_content">
                                            <div className="counter_value">
                                                <span className="odometer" data-count="{counter.projects_done}">
                                                    <CountUp end={counter.projects_done} enableScrollSpy /></span>
                                                    <span>+</span>     
                                               
                                            </div>
                                            <h3 className="funfact_title mb-0">Projects Done</h3>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-md-3">
                                    <div className="funfact_block">
                                        <div className="funfact_icon">
                                            <Image src={sIcon3} alt="Fujtech - SVG Icon Head" />
                                        </div>
                                        <div className="funfact_content">
                                            <div className="counter_value">
                                                <span className="odometer" data-count="{counter.happy_clients}">
                                                    <CountUp end={counter.happy_clients} enableScrollSpy /></span>
                                                    <span>+</span>     
                                            </div>
                                            <h3 className="funfact_title mb-0">Happy Clients</h3>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-md-3">
                                    <div className="funfact_block">
                                        <div className="funfact_icon">
                                            <Image src={sIcon4} alt="Fujtech - SVG Icon Head" />
                                        </div>
                                        <div className="funfact_content">
                                            <div className="counter_value">
                                                <span className="odometer" data-count="{counter.expert_members}">
                                                    <CountUp end={counter.expert_members} enableScrollSpy /></span>
                                                    <span>+</span>     
                                            </div>
                                            <h3 className="funfact_title mb-0">Expert Members</h3>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                    {/* <div className="col-lg-4">
                        <div className="our_world_employees">
                            <div className="image_wrap">
                                <Image src={fimg} alt="Fujtech - Employees Guoup" />
                            </div>
                            <div className="content_wrap">
                                <h3 className="title_text mb-0">
                                    <b className="d-block">12000+</b> employees in 30 countries in Europe
                                </h3>
                            </div>
                        </div>
                    </div> */}
                </div>
            </div>
        </section>
    );
}

export default FeaturesSection;