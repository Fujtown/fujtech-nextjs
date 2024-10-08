import React, { useEffect, useState } from 'react';

import Slider from "react-slick";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import pimg1 from '/public/images/clients/client_logo_1.webp'
import pimg2 from '/public/images/clients/client_logo_2.webp'
import pimg3 from '/public/images/clients/client_logo_3.webp'
import pimg4 from '/public/images/clients/client_logo_4.webp'
import pimg5 from '/public/images/clients/client_logo_5.webp'
import pimg6 from '/public/images/clients/client_logo_6.webp'
import pimg7 from '/public/images/clients/client_logo_7.webp'
import Image from "next/image";
import { fetchPartners } from '../../api/partners'; // Import the fetch function

var settings = {
    dots: false,
    infinite: true,
    speed: 3000,
    slidesToShow: 7,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 0,
    cssEase: "linear",
    arrows: false,

    responsive: [
        {
            breakpoint: 1025,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 450,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 350,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
};



const FeaturePartners = (props) => {
   
    const [partners, setPartners] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const getPartners = async () => {
            const cachedData = localStorage.getItem('partners');
            const cachedVersion = localStorage.getItem('partnersVersion');
            let partnersData = cachedData ? JSON.parse(cachedData) : [];
            let currentVersion = cachedVersion ? parseInt(cachedVersion) : 0;

            try {
                const { data, version } = await fetchPartners();
                if (version > currentVersion) {
                    setPartners(data); // Update state with new data
                    localStorage.setItem('partners', JSON.stringify(data)); // Update local storage
                    localStorage.setItem('partnersVersion', version); // Update version in local storage
                } else {
                    setPartners(partnersData); // Use cached data
                }
            } catch (err) {
                setError(err); // Handle any errors
            } finally {
                setLoading(false); // Set loading to false
            }
        };

        getPartners();
    }, []);
     
    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error fetching partners: {error.message}</div>;


    return (
        <div className="feature_partners_section">
            <div className="container position-relative">
                <div className="title_text text-white">
                    Our Featured Partner's
                </div>
                <div className="client_logo_carousel">
                    <Slider {...settings}>
                        {partners.map((partner, index) => (
                    <div key={index} className="client_logo_item">
                        <img src={partner.pImg} alt={`Partner ${index + 1}`} />
                    </div>
                ))}
            
                    </Slider>
                </div>
            </div>
        </div>
    );
}

export default FeaturePartners;