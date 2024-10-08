
import React, { useState,useEffect } from 'react';
import shape1 from '/public/images/shapes/shape_space_4.svg'
import shape2 from '/public/images/shapes/shape_angle_3-1.webp'
import { fetchFaqs } from '../../api/faqs'; // Import the fetch function

import {
    Accordion,
    AccordionBody,
    AccordionHeader,
    AccordionItem,
} from 'reactstrap';
import Image from 'next/image';

const FaqSection = (props) => {
    const [faqs, setFaqs] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [open, setOpen] = useState('1'); // State for managing open accordion item

    useEffect(() => {
        const getFaqs = async () => {
            const cachedData = localStorage.getItem('faqs');
            const cachedVersion = localStorage.getItem('faqsVersion');
            let faqsData = cachedData ? JSON.parse(cachedData) : [];
            let currentVersion = cachedVersion ? parseInt(cachedVersion) : 0;

            try {
                const { data, version } = await fetchFaqs();
                if (version > currentVersion) {
                    setFaqs(data); // Update state with new data
                    localStorage.setItem('faqs', JSON.stringify(data)); // Update local storage
                    localStorage.setItem('faqsVersion', version); // Update version in local storage
                } else {
                    setFaqs(faqsData); // Use cached data
                }
            } catch (err) {
                setError(err); // Handle any errors
            } finally {
                setLoading(false); // Set loading to false
            }
        };

        getFaqs();
    }, []);
     
    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error fetching Faqs: {error.message}</div>;


    const toggle = (id) => {
        if (open === id) {
            setOpen(null); // Set to null or an empty string to close the accordion
        } else {
            setOpen(id); // Set to the id of the clicked item
        }
    };

    return (
        <section className="faq_section section_decoration">
            <div className="container">
                <div className="heading_block text-center">
                    <div className="heading_focus_text has_underline d-inline-flex" style={{ backgroundImage: `url(${'/images/shapes/shape_title_under_line.svg'})` }}>
                        F.A.Q.
                    </div>
                    <h2 className="heading_text mb-0">
                        Need a <mark>Support?</mark>
                    </h2>
                </div>

                <div className="faq_accordion accordion" id="faq_accordion">
                    <Accordion open={open} toggle={toggle} className="accordion" id="service_process_faq">
                    {faqs.map((faq, index) => (
                        <AccordionItem className="accordion-item" key={index + 1}>
                            <AccordionHeader targetId={String(index + 1)} >
                                Q. {faq.question}
                            </AccordionHeader>
                            <AccordionBody accordionId={String(index + 1)} className='acc_body'>
                                <div className="text_a">A.</div>
                                <p dangerouslySetInnerHTML={{ __html: faq.answer }} />
                            </AccordionBody>
                        </AccordionItem>
                    ))}

                    </Accordion>
                </div>
            </div>
            <div className="decoration_item shape_image_1">
                <Image src={shape1} alt="Fujtech Shape" />
            </div>
            <div className="decoration_item shape_image_2">
                <Image src={shape2} alt="Fujtech Shape Angle" />
            </div>
        </section>
    )
};
export default FaqSection;
