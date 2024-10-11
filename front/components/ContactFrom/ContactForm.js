import React, { useState } from 'react'
import axios from 'axios';
import SimpleReactValidator from 'simple-react-validator';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
const ContactForm = (props) => {

    const [forms, setForms] = useState({
        name: '',
        email: '',
        company: '',
        phone: '',
        message: ''
    });
    const [validator] = useState(new SimpleReactValidator({
        className: 'errorMessage'
    }));
    const changeHandler = e => {
        setForms({ ...forms, [e.target.name]: e.target.value })
        if (validator.allValid()) {
            validator.hideMessages();
        } else {
            validator.showMessages();
        }
    };

    const submitHandler = e => {
        e.preventDefault();
        if (validator.allValid()) {
            validator.hideMessages();
            const API_URL = `${process.env.NEXT_PUBLIC_API_BASE_URL}/api/message`;
            // Make the API request
            axios.post(API_URL, forms)
                .then(response => {
                    // Handle success (you can show a success message or do something else)
                    console.log('Message saved successfully:', response.data);
                    toast.success('Message Send successfully!');
                    // Clear the form after success
                    setForms({
                        name: '',
                        email: '',
                        company: '',
                        phone: '',
                        message: ''
                    });
                })
                .catch(error => {
                    // Handle error (display error message or perform some other action)
                    console.error('There was an error saving the message:', error);
                    toast.error('There was an error saving the message.');
                });
        } else {
            validator.showMessages();
        }
    };

    return (

        <div>
        <form className="xb-item--form contact-from" onSubmit={(e) => submitHandler(e)}>
            <div className="row">
                <div className="col-md-6">
                    <div className="form-group">
                        <label className="input_title" htmlFor="input_name">
                            <i className="fa-regular fa-user"></i>
                        </label>
                        <input
                            value={forms.name}
                            type="text"
                            name="name"
                            className="form-control"
                            onBlur={(e) => changeHandler(e)}
                            onChange={(e) => changeHandler(e)}
                            placeholder="Your Name" />
                        {validator.message('name', forms.name, 'required|alpha_space')}
                    </div>
                </div>
                <div className="col-md-6">
                    <div className="form-group">
                        <label className="input_title" htmlFor="input_email">
                            <i className="fa-regular fa-envelope"></i>
                        </label>
                        <input
                            value={forms.email}
                            type="email"
                            name="email"
                            className="form-control"
                            onBlur={(e) => changeHandler(e)}
                            onChange={(e) => changeHandler(e)}
                            placeholder="Your Enter" />
                        {validator.message('email', forms.email, 'required|email')}
                    </div>
                </div>
                <div className="col-md-6">
                    <div className="form-group">
                        <label className="input_title" htmlFor="input_phone">
                            <i className="fa-regular fa-phone-volume"></i>
                        </label>
                        <input
                            value={forms.phone}
                            type="phone"
                            name="phone"
                            className="form-control"
                            onBlur={(e) => changeHandler(e)}
                            onChange={(e) => changeHandler(e)}
                            placeholder="Your Phone No." />
                        {validator.message('phone', forms.phone, 'required|phone')}
                    </div>
                </div>
                <div className="col-md-6">
                    <div className="form-group">
                        <label className="input_title" htmlFor="input_company">
                            <i className="fa-regular fa-globe"></i>
                        </label>
                        <input
                            value={forms.company}
                            type="company"
                            name="company"
                            className="form-control"
                            onBlur={(e) => changeHandler(e)}
                            onChange={(e) => changeHandler(e)}
                            placeholder="Your Company Name" />
                        {validator.message('company', forms.company, 'required')}
                    </div>
                </div>
                <div className="col-12">
                    <div className="form-group">
                        <label className="input_title" htmlFor="input_textarea">
                            <i className="fa-regular fa-comments"></i>
                        </label>
                        <textarea
                            onBlur={(e) => changeHandler(e)}
                            onChange={(e) => changeHandler(e)}
                            value={forms.message}
                            type="text"
                            name="message"
                            className="form-control"
                            placeholder="How can we help you?">
                        </textarea>
                        {validator.message('message', forms.message, 'required')}
                    </div>
                    <button type="submit" className="btn btn-primary">
                        <span className="btn_label">Send Request</span>
                        <span className="btn_icon">
                            <i className="fa-solid fa-arrow-up-right"></i>
                        </span>
                    </button>
                </div>
            </div>
        </form>

          <ToastContainer />
          </div>
    )
}

export default ContactForm;