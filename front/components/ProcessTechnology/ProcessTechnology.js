
import React, { useState } from 'react';
import shape1 from '/public/images/shapes/shape_line_2.svg'
import shape2 from '/public/images/shapes/shape_line_3.svg'
import shape3 from '/public/images/shapes/shape_line_4.svg'
import shape4 from '/public/images/shapes/shape_space_3-1.webp'

import {
    Accordion,
    AccordionBody,
    AccordionHeader,
    AccordionItem,
} from 'reactstrap';
import TechnologySection from '../TechnologySection/TechnologySection';
import Testimonial from '../Testimonial/Testimonial';
import Accordion2 from '../Accordion/Accordion';
import Image from 'next/image';

const FaqSection = (props) => {

    const [open, setOpen] = useState('1');
   

     // Function to toggle the accordion based on the selected process step
     const toggle = (id) => {
        setOpen(open === id ? '' : id); // Open/close the selected accordion item
    };

    // Callback to update the open accordion based on step from Accordion2
    const handleStepChange = (stepId) => {
        setOpen(stepId);
    };

    return (
        <section className="process_technology_review_section bg-light section_decoration">
            <div className="container">
                <div className="row align-items-center justify-content-lg-between">
                    <div className="col-lg-6">
                        <div className="heading_block">
                            <div className="heading_focus_text has_underline d-inline-flex" style={{ backgroundImage: `url(${'/images/shapes/shape_title_under_line.svg'})` }}>
                                Working Process
                            </div>
                            <h2 className="heading_text mb-0">
                                Our <mark>Approach</mark>
                            </h2>
                        </div>
                        <Accordion open={open} toggle={toggle} className="accordion" id="service_process_faq">
                            <AccordionItem className="accordion-item">
                                <AccordionHeader targetId="1">
                                    01. Discovery Phase
                                </AccordionHeader>
                                <AccordionBody accordionId="1" className='acc_body'>
                                    <p className="m-0">
                                    This initial phase involves understanding the client's needs and gathering requirements. It includes research and analysis to identify the problems that need to be solved and the goals that need to be achieved. The focus is on data-driven diagnostics to inform the development process.
                                    </p>
                                </AccordionBody>
                            </AccordionItem>
                            <AccordionItem className="accordion-item">
                                <AccordionHeader targetId="2">
                                    02. Design and Development
                                </AccordionHeader>
                                <AccordionBody accordionId="2" className='acc_body'>
                                    <p className="m-0">
                                    In this phase, the actual design and development of the application take place. This includes creating wireframes, user interfaces, and the overall architecture of the application. The development team works on coding the application based on the requirements gathered during the discovery phase.
                                    </p>
                                </AccordionBody>
                            </AccordionItem>
                            <AccordionItem className="accordion-item">
                                <AccordionHeader targetId="3">
                                    03. Maintenance
                                </AccordionHeader>
                                <AccordionBody accordionId="3" className='acc_body'>
                                    <p className="m-0">
                                    After the application is deployed, ongoing maintenance is crucial to ensure that it continues to function correctly and efficiently. This phase involves fixing bugs, updating software, and making improvements based on user feedback and changing requirements.
                                    </p>
                                </AccordionBody>
                            </AccordionItem>
                            <AccordionItem className="accordion-item">
                                <AccordionHeader targetId="4">
                                    04. Deployment
                                </AccordionHeader>
                                <AccordionBody accordionId="4" className='acc_body'>
                                    <p className="m-0">
                                    This step involves launching the application to the production environment where it becomes accessible to users. It includes final testing, configuration, and ensuring that all components are working as intended before going live.
                                    </p>
                                </AccordionBody>
                            </AccordionItem>
                            <AccordionItem className="accordion-item">
                                <AccordionHeader targetId="5">
                                    05. Testing and QA
                                </AccordionHeader>
                                <AccordionBody accordionId="5" className='acc_body'>
                                    <p className="m-0">
                                    Quality Assurance (QA) is a critical phase where the application is rigorously tested to identify any issues or bugs. This includes functional testing, performance testing, and user acceptance testing to ensure that the application meets the required standards and is ready for deployment.
                                    </p>
                                </AccordionBody>
                            </AccordionItem>
                        </Accordion>
                    </div>
                    <Accordion2 onStepChange={handleStepChange}/>
                </div>
                <TechnologySection/>
                <Testimonial/>
            </div>

            <div className="decoration_item shape_image_1">
                <Image src={shape1} alt="Fujtech Shape" />
            </div>
            <div className="decoration_item shape_image_2">
                <Image src={shape2} alt="Fujtech Shape" />
            </div>
            <div className="decoration_item shape_image_3">
                <Image src={shape3} alt="Fujtech Shape" />
            </div>
            <div className="decoration_item shape_image_4">
                <Image src={shape4} alt="Fujtech Shape" />
            </div>
        </section>
    )
};
export default FaqSection;
