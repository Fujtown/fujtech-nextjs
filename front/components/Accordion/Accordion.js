import React from 'react';
import styles from './DevelopmentProcess.module.css'; // Use CSS Modules for custom styling

const DevelopmentProcess = ({ onStepChange }) => {
    const handleStepClick = (stepId) => {
        if (onStepChange) {
            onStepChange(stepId); // Trigger the step change in the parent component
        }
    };

    return (
        <div className={styles.container}>
                        <div className={`${styles.centerCircle} ${styles.spin}`}>
                <h2>Development Process</h2>
            </div>
            

            {/* Step 1 */}
            <div className={`${styles.step} ${styles.step1}`} onClick={() => handleStepClick('1')}>
                <div className={styles.icon}>
                    <img src="/images/icons/requirments.png" alt="Requirement Analysis" />
                </div>
                <div className={styles.stepContent}>
                    <h3>STEP 1</h3>
                    <p>Requirement Analysis</p>
                </div>
            </div>

            {/* Step 2 */}
            <div className={`${styles.step} ${styles.step2}`} onClick={() => handleStepClick('2')}>
                <div className={styles.icon}>
                    <img src="/images/icons/design.png" alt="Design" />
                </div>
                <div className={styles.stepContent}>
                    <h3>STEP 2</h3>
                    <p>Design</p>
                </div>
            </div>

            {/* Step 3 */}
            <div className={`${styles.step} ${styles.step3}`} onClick={() => handleStepClick('3')}>
                <div className={styles.icon}>
                    <img src="/images/icons/development.png" alt="Development" />
                </div>
                <div className={styles.stepContent}>
                    <h3>STEP 3</h3>
                    <p>Development</p>
                </div>
            </div>

            {/* Step 4 */}
            <div className={`${styles.step} ${styles.step4}`} onClick={() => handleStepClick('4')}>
                <div className={styles.icon}>
                    <img src="/images/icons/testing.png" alt="Testing" />
                </div>
                <div className={styles.stepContent}>
                    <h3>STEP 4</h3>
                    <p>Testing</p>
                </div>
            </div>

            {/* Step 5 */}
            <div className={`${styles.step} ${styles.step5}`} onClick={() => handleStepClick('5')}>
                <div className={styles.icon}>
                    <img src="/images/icons/deployment.png" alt="Deployment" />
                </div>
                <div className={styles.stepContent}>
                    <h3>STEP 5</h3>
                    <p>Deployment</p>
                </div>
            </div>
        </div>
    );
};

export default DevelopmentProcess;
