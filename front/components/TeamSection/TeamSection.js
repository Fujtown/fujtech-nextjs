import React, { useEffect, useState } from 'react';
import { fetchTeam } from '../../api/team'
import Link from 'next/link'
import { Swiper, SwiperSlide } from 'swiper/react';
import 'swiper/css';
import 'swiper/css/pagination';
import sImg1 from '/public/images/icons/icon_facebook.svg'
import sImg2 from '/public/images/icons/icon_twitter_x.svg'
import sImg3 from '/public/images/icons/icon_linkedin.svg'
import sImg4 from '/public/images/icons/icon_instagram.svg'
import Image from 'next/image';


const TeamSection = (props) => {

    const [hydrated, setHydrated] = useState(false);

    const [teams, setTeams] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        setHydrated(true);
        const getTeam = async () => {
            const cachedData = localStorage.getItem('team');
            const cachedVersion = localStorage.getItem('teamVersion');
            let counterData = cachedData ? JSON.parse(cachedData) : [];
            let currentVersion = cachedVersion ? parseInt(cachedVersion) : 0;

            try {
                const { data, version } = await fetchTeam();
                if (version > currentVersion) {
                    setTeams(data); // Update state with new data
                    localStorage.setItem('team', JSON.stringify(data)); // Update local storage
                    localStorage.setItem('teamVersion', version); // Update version in local storage
                } else {
                    setTeams(counterData); // Use cached data
                }
            } catch (err) {
                setError(err); // Handle any errors
            } finally {
                setLoading(false); // Set loading to false
            }
        };

        getTeam();
    }, []);
     
    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error fetching counters: {error.message}</div>;


    // useEffect(() => {
    //     setHydrated(true);
        
    // }, []);

    if (!hydrated) {
        return null;
    }

    const ClickHandler = () => {
        window.scrollTo(10, 0);
    };


    return (

        <section className="team_section xb-hidden section_space">
            <div className="container">
                <div className="heading_block text-center">
                    <div className="heading_focus_text">
                        <span className="badge bg-secondary text-white">Our Expert</span>
                        Team Members 😍
                    </div>
                    <h2 className="heading_text mb-0">
                        Top Skilled Experts
                    </h2>
                </div>

                <div className="team_carousel">
                    <Swiper
                        loop={true}
                        spaceBetween={30}
                        allowTouchMove={true}
                        centeredSlides={true}
                        pagination={{ clickable: true }}
                        speed={800}
                        breakpoints={{
                            576: {
                                slidesPerView: 2,
                            },
                            1025: {
                                slidesPerView: 3,
                            },
                        }}
                    >
                        {teams.map((team) => (
                            <SwiperSlide key={team.Id}>
                                <div className="team_block">
                                    <div className="team_member_image">
                                    <img src={team.tImg} alt="" />
                                 <i className="fa-solid fa-arrow-up-right"></i>
                                       
                                    </div>
                                    <div className="team_member_info">
                                        <h3 className="team_member_name">
                                           {team.name}
                                        </h3>
                                        <h4 className="team_member_designation">{team.designation}</h4>
                                        <ul className="social_icons_block unordered_list justify-content-center">
                                           
                                            <li>
                                              <Image src={sImg2} alt="Icon Twitter X" />
                                            </li>
                                            <li>
                                               <Image src={sImg3} alt="Icon Linkedin" />
                                            </li>
                                          
                                        </ul>
                                    </div>
                                </div>
                            </SwiperSlide>
                        ))}
                    </Swiper>
                </div>

             
            </div>
        </section>
    );
}

export default TeamSection;