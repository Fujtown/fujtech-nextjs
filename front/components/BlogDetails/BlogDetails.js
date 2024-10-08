import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import Image from 'next/image';
import icon1 from '/public/images/icons/icon_calendar.svg';
import icon4 from '/public/images/icons/icon_eye.svg';
import icon5 from '/public/images/icons/icon_link.svg';
import styles from './BlogDetails.module.css'; // Import your CSS module

const BlogSingle = ({ blogDetails, ClickHandler }) => {
    const [isSpeaking, setIsSpeaking] = useState(false);
    const [utterance, setUtterance] = useState(null);
    const [randomBlogs, setRandomBlogs] = useState([]); // State to hold random blog posts
    const [isModalOpen, setIsModalOpen] = useState(false); // State to control modal visibility
    const [fullImage, setFullImage] = useState(''); // State to hold the full image URL

    useEffect(() => {
        // Retrieve blog posts from local storage
        const storedBlogs = JSON.parse(localStorage.getItem('all_blog')) || [];
        if (storedBlogs.length > 0) {
            // Shuffle the array and select two random blogs
            const shuffledBlogs = storedBlogs.sort(() => 0.5 - Math.random());
            const selectedBlogs = shuffledBlogs.slice(0, 2);
            setRandomBlogs(selectedBlogs);
        }
    }, []);

    const handleAudioPlay = () => {
        if ('speechSynthesis' in window) {
            if (isSpeaking) {
                window.speechSynthesis.resume(); // Resume if already speaking
            } else {
                const newUtterance = new SpeechSynthesisUtterance(blogDetails.content);
                newUtterance.lang = 'en-US'; // Set the language

                // Event listeners for speech synthesis
                newUtterance.onstart = () => setIsSpeaking(true); // Set speaking state
                newUtterance.onend = () => {
                    setIsSpeaking(false); // Reset speaking state when done
                    setUtterance(null); // Clear the utterance
                };
                newUtterance.onpause = () => setIsSpeaking(false); // Reset speaking state when paused
                newUtterance.onresume = () => setIsSpeaking(true); // Set speaking state when resumed

                window.speechSynthesis.speak(newUtterance);
                setUtterance(newUtterance); // Store the utterance for control
            }
        } else {
            alert('Sorry, your browser does not support text-to-speech.');
        }
    };

    const handlePause = () => {
        if (isSpeaking) {
            window.speechSynthesis.pause(); // Pause the speech
        }
    };

    const handleStop = () => {
        if (isSpeaking) {
            window.speechSynthesis.cancel(); // Stop the speech
            setIsSpeaking(false); // Reset speaking state
            setUtterance(null); // Clear the utterance
        }
    };

    // Cleanup on component unmount
    useEffect(() => {
        return () => {
            if (utterance) {
                window.speechSynthesis.cancel(); // Stop any ongoing speech when the component unmounts
            }
        };
    }, [utterance]);

    const CopyLink = (event) => {
        event.preventDefault(); // Prevent default link behavior
        const blogUrl = `${window.location.origin}/blog/${blogDetails.slug}`; // Construct the blog URL
        navigator.clipboard.writeText(blogUrl)
            .then(() => {
                alert('Link copied to clipboard!'); // Notify the user
            })
            .catch(err => {
                console.error('Failed to copy: ', err);
            });
    };

    // Function to open the modal with the full image
    const openModal = (imageSrc) => {
        setFullImage(imageSrc);
        setIsModalOpen(true);
    };

    // Function to close the modal
    const closeModal = () => {
        setIsModalOpen(false);
        setFullImage('');
    };

    return (
        <section className="blog_details_section section_space bg-light">
            <div className="container">
                <div className="row">
                    <div className="col-md-6">
                        <div className={styles.imageContainer} onClick={() => openModal(blogDetails.bImg)}>
                            <img 
                                src={blogDetails.bImg} 
                                alt="Fujtech - Blog" 
                                style={{ width: '100%', cursor: 'pointer' }} // Make the image responsive and clickable
                            />
                        </div>
                    </div>
                    <div className="col-md-6">
                        <div className="post_meta_wrap mb-4">
                            <ul className="post_meta unordered_list">
                                <li>
                                    <Link onClick={ClickHandler} href={'/blog'}>
                                        <Image src={icon1} alt="Icon Calendar" /> {blogDetails.date}
                                    </Link>
                                </li>
                            </ul>
                        </div>
                        <h2 className="details_item_title">
                            {blogDetails.title}
                        </h2>
                        <div>
                            <p dangerouslySetInnerHTML={{ __html: blogDetails.content }} /> {/* Using dangerouslySetInnerHTML for content */}
                        </div>
                        <div className="row align-items-center">
                            <div className="col-md-6">
                                <ul className="post_meta unordered_list">
                                    <li>
                                        <Link onClick={ClickHandler} href={'/blog'}>
                                            <Image src={icon4} alt="Icon Eye" /> 20k Views
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                            <div className="col-md-6">
                                <ul className="post_meta unordered_list justify-content-md-end">
                                    <li>
                                        <Link onClick={CopyLink} href={'#'}>
                                            <Image src={icon5} alt="Icon Link" /> Copy Link
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr className="mb-0" />
                        <div className="mt-5 pb-0">
                            <div className={`blog_details_audio ${styles.playerBtns}`}>
                                <button className={`audio_play_btn ${styles.customButton}`} type="button" onClick={handleAudioPlay}>
                                    <i className="fa-solid fa-play"></i> Play / Resume
                                </button>
                                <button className={`audio_pause_btn ${styles.customButton}`} type="button" onClick={handlePause}>
                                    <i className="fa-solid fa-pause"></i> Pause
                                </button>
                                <button className={`audio_stop_btn ${styles.customButton}`} type="button" onClick={handleStop}>
                                    <i className="fa-solid fa-stop"></i> Stop
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div className='row'>
                    <hr className="mb-5" />
                    <div className='col-lg-12'>
                        {/* Other Posts Navigation */}
                        {randomBlogs.length > 1 && ( // Only show if there are at least 2 random blogs
                            <div className="other_posts_nav">
                                <Link onClick={ClickHandler} href={`/blog-single/${randomBlogs[0].slug}`}>
                                    <i className="fa-regular fa-arrow-left-long"></i>
                                    <span>
                                        <strong>{randomBlogs[0].title}</strong>
                                        <small>{randomBlogs[0].date}</small>
                                    </span>
                                </Link>
                                <Link onClick={ClickHandler} href={'/blog'}>
                                    <i className="fa-solid fa-grid-2"></i>
                                </Link>
                                <Link onClick={ClickHandler} href={`/blog-single/${randomBlogs[1].slug}`}>
                                    <span>
                                        <strong>{randomBlogs[1].title}</strong>
                                        <small>{randomBlogs[1].date}</small>
                                    </span>
                                    <i className="fa-regular fa-arrow-right-long"></i>
                                </Link>
                            </div>
                        )}
                    </div>          
                </div>
            </div>

            {/* Fullscreen Modal for Image */}
            {isModalOpen && (
                <div className={styles.modal} onClick={closeModal}>
                    <img src={fullImage} alt="Full Screen" className={styles.fullImage} />
                </div>
            )}
        </section>
    );
};

export default BlogSingle;