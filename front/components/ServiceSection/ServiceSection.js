import { useState,useEffect } from 'react'; 
import { fetchServices } from '../../api/service'; // Import the fetch function

import Link from 'next/link'
import shape1 from '/public/images/shapes/shape_line_5.svg'
import shape2 from '/public/images/shapes/shape_line_6.svg'
import shape3 from '/public/images/shapes/shape_space_7.webp'
import shape4 from '/public/images/shapes/shape_angle_1-1.webp'
import shape5 from '/public/images/shapes/shape_angle_2-1.webp'
import Image from 'next/image';


const ServiceSection = (props) => {
    const [services, setServices] = useState([]); // Initialize as an empty array
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const getServices = async () => {
            const cachedData = localStorage.getItem('services');
            const cachedVersion = localStorage.getItem('servicesVersion');
            let servicesData = cachedData ? JSON.parse(cachedData) : [];
            let currentVersion = cachedVersion ? parseInt(cachedVersion) : 0;
    
            try {
                const { data, version } = await fetchServices(); // Assume fetchServices returns data and version
                    // console.log(version)
                // Check if the fetched version is different from the cached version
                if (version > currentVersion) {
                    setServices(data); // Update state with new data
                    localStorage.setItem('services', JSON.stringify(data)); // Update local storage
                    localStorage.setItem('servicesVersion', version); // Update version in local storage
                } else {
                    setServices(servicesData); // Use cached data
                }
            } catch (err) {
                setError(err); // Handle any errors
            } finally {
                setLoading(false); // Set loading to false
            }
        };
    
        getServices();
    }, []);
     
    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error fetching Services: {error.message}</div>;

    const ClickHandler = () => {
        window.scrollTo(10, 0);
    }

    return (
        <section className="service_section pt-175 pb-80 bg-light section_decoration xb-hidden">
            <div className="container">
                <div className="heading_block text-center">
                    <div className="heading_focus_text has_underline d-inline-flex" style={{ backgroundImage: `url(${'/images/shapes/shape_title_under_line.svg'})` }}>
                        Our Services
                    </div>
                    <h2 className="heading_text mb-0">
                        How We Can <mark>Help</mark> You
                    </h2>
                </div>

                <div className="row">
            {services.map((service, index) => (
                <div className="col-lg-4" key={index}> {/* Use a unique key */}
                    <div className="service_block_2">
                        <div key={index} className="service_icon">
                        <img src={service.sImg} alt={`Service ${index + 1}`} />
                        </div>
                        <h3 className="service_title">
                            <Link onClick={ClickHandler} href={'/service-single/[slug]'} as={`/service-single/${service.slug}`}>
                                {service.title}
                            </Link>
                        </h3>
                        <ul className="icon_list unordered_list_block">
                            {service.points ? (
                                JSON.parse(service.points).map((feature, featureitem) => (
                                    <li key={featureitem}>
                                        <span className="icon_list_icon">
                                            <i className="fa-regular fa-circle-dot"></i>
                                        </span>
                                        <span className="icon_list_text">
                                            {feature}
                                        </span>
                                    </li>
                                ))
                            ) : (
                                <li>No points available</li> // Fallback if points are not available
                            )}
                        </ul>
                    </div>
                </div>
            ))}
        </div>
            </div>

            <div className="decoration_item shape_image_1">
                <Image src={shape1} alt="Fujtech Shape"/>
            </div>
            <div className="decoration_item shape_image_2">
                <Image src={shape2} alt="Fujtech Shape"/>
            </div>
            <div className="decoration_item shape_image_3">
                <Image src={shape3} alt="Fujtech Shape"/>
            </div>
            <div className="decoration_item shape_image_4">
                <Image src={shape4} alt="Fujtech Shape Angle"/>
            </div>
            <div className="decoration_item shape_image_5-1">
                <Image src={shape5} alt="Fujtech Shape Angle"/>
            </div>
        </section>
    );
}

export default ServiceSection;