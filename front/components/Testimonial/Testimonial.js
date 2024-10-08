import { useRef, useEffect } from 'react';
import esqr from '/public/images/award/ESQR.jpg'
import gsuite from '/public/images/award/GSuite.png'
import shjseenLogo from '/public/images/award/shjseen-logo.png'

import clogo from '/public/images/clients/client_logo_8.webp'
import flag from '/public/images/flag/ukraine_flag.webp'
import Image from 'next/image';
import styles from './testimonial.module.css'; // Import the CSS module




const Testimonial = () => {
    const prevRef = useRef(null);
    const nextRef = useRef(null);
    const swiperRef = useRef(null);

    useEffect(() => {
        if (swiperRef.current && prevRef.current && nextRef.current) {
            swiperRef.current.params.navigation.prevEl = prevRef.current;
            swiperRef.current.params.navigation.nextEl = nextRef.current;
            swiperRef.current.navigation.init();
            swiperRef.current.navigation.update();
        }
    }, []);

    return (

        <div className="row">
            <div className="col-lg-4">
                <div className="deals_winner_customers">
                    <h3 className="title_text">
                        <mark>150+</mark> customers win deals with Fujtech
                    </h3>
                  
                </div>
            </div>
            <div className="col-lg-8">
                <div className="review_onecol_wrapper">
                <div className='row'>
                    <h4 className={styles.award}>Awards & Accreditations</h4>
                <div className='col-lg-4'>
                <Image className={styles.awardImg} src={gsuite} alt="G Suite" />
                    <h6 className={styles.awardheading}>G Suite Authorized Reseller</h6>
                </div>
                <div className='col-lg-4'>
                <Image className={styles.awardImg} src={shjseenLogo} alt="ShJSEEN" />
                    <h6 className={styles.awardheading}>shjSEEN</h6>
                </div>
                <div className='col-lg-4'>
                <Image className={styles.awardImg} src={esqr} alt="G Suite" />
                    <h6 className={styles.awardheading}>ESQR</h6>
                </div>
                </div>
                </div>
            </div>
        </div>
    );
}

export default Testimonial;