import React, { useState } from 'react';
import { TabContent, TabPane, Nav, NavItem, NavLink } from 'reactstrap';
import classnames from 'classnames';

import cnIcon1 from '/public/images/icons/icon_php.svg'
import cnIcon2 from '/public/images/icons/icon_javascript.svg'
import cnIcon3 from '/public/images/case/icon_elephent.svg'
import cnIcon4 from '/public/images/icons/icon_swift.svg'
import cnIcon5 from '/public/images/icons/icon_typescript.svg'
import cnIcon6 from '/public/images/icons/icon_python.svg'
import cnIcon11 from '/public/images/icons/icon_react_js.svg'
import cnIcon12 from '/public/images/icons/icon_laravel.svg'
import cnIcon13 from '/public/images/icons/aws.svg'
import cnIcon14 from '/public/images/icons/mysql.svg'
import cnIcon15 from '/public/images/icons/mongodb.svg'
import cnIcon16 from '/public/images/icons/firebase.svg'
import cnIcon17 from '/public/images/icons/react-native.svg'
import cnIcon18 from '/public/images/icons/nodejs.svg'
import cnIcon19 from '/public/images/icons/nextjs.svg'
import cnIcon20 from '/public/images/icons/android.svg'
import Image from 'next/image';


const TechnologyList = [
    { Id: '1', sIcon: cnIcon1, title: 'PHP', type: 'Backend' },
    { Id: '2', sIcon: cnIcon2, title: 'JavaScript', type: 'Frontend' },
    { Id: '3', sIcon: cnIcon4, title: 'Swift', type: 'Mobile' },
    { Id: '4', sIcon: cnIcon5, title: 'Typescript', type: 'Frontend' },
    { Id: '5', sIcon: cnIcon6, title: 'Python', type: 'Backend' },
    { Id: '11', sIcon: cnIcon11, title: 'React Js', type: 'Frontend' },
    { Id: '12', sIcon: cnIcon12, title: 'Laravel', type: 'Backend' },
    { Id: '13', sIcon: cnIcon13, title: 'AWS', type: 'Cloud' },
    { Id: '14', sIcon: cnIcon14, title: 'MySQL', type: 'Database' },
    { Id: '15', sIcon: cnIcon15, title: 'MongoDB', type: 'Database' },
    { Id: '16', sIcon: cnIcon16, title: 'Firebase', type: 'Cloud' },
    { Id: '17', sIcon: cnIcon17, title: 'React Native', type: 'Mobile' },
    { Id: '18', sIcon: cnIcon3, title: 'PostgreSQL', type: 'Database' },
    { Id: '19', sIcon: cnIcon18, title: 'Node.JS', type: 'Backend' },
    { Id: '20', sIcon: cnIcon19, title: 'Next.JS', type: 'Backend' },
    { Id: '21', sIcon: cnIcon20, title: 'Android Studio', type: 'Mobile' },
];



const TechnologySection = (props) => {

    const [activeTab, setActiveTab] = useState('1');

    const toggle = tab => {
        if (activeTab !== tab) setActiveTab(tab);
    }

     // Group technologies by type
     const groupedTechnologies = TechnologyList.reduce((acc, tech) => {
        if (!acc[tech.type]) {
            acc[tech.type] = [];
        }
        acc[tech.type].push(tech);
        return acc;
    }, {});

    return (

        <div className="section_space">
            <div className="heading_block text-center">
                <div className="heading_focus_text has_underline d-inline-flex" style={{ backgroundImage: `url(${'/images/shapes/shape_title_under_line.svg'})` }}>
                    Our Technologies
                </div>
                <h2 className="heading_text mb-0">
                    We Use <mark>Technologies</mark>
                </h2>
            </div>

            <div className="tab_block_wrapper">
            <Nav tabs className="nav justify-content-center">
                    {Object.keys(groupedTechnologies).map((type, index) => (
                        <NavItem key={index}>
                            <NavLink className={classnames({ active: activeTab === (index + 1).toString() })} onClick={() => { toggle((index + 1).toString()); }}>
                                {type}
                            </NavLink>
                        </NavItem>
                    ))}
                </Nav>

                <TabContent activeTab={activeTab}>
                    {Object.keys(groupedTechnologies).map((type, index) => (
                        <TabPane tabId={(index + 1).toString()} key={index}>
                            <div className="web_development_technologies row justify-content-center">
                                {groupedTechnologies[type].map((technology) => (
                                    <div className="col-lg-2 col-md-3 col-sm-4 col-6" key={technology.Id}>
                                        <div className="iconbox_block text-center p-0 shadow-none bg-transparent">
                                            <div className="iconbox_icon">
                                                <Image src={technology.sIcon} alt={technology.title} />
                                            </div>
                                            <div className="iconbox_content">
                                                <h3 className="iconbox_title mb-0">{technology.title}</h3>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </TabPane>
                    ))}
                </TabContent>
            </div>
        </div>
    )
}

export default TechnologySection;