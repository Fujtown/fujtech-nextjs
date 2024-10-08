import styles from './BlogList.module.css'; // Import your CSS module

const SkeletonCard = () => {
    return (
        <div className={styles.blogCard}>
            <div className={styles.blogImage}>
                <div className={styles.skeletonImage}></div> {/* Skeleton for the image */}
            </div>
            <div className={styles.blogContent}>
                <div className={styles.skeletonTitle}></div> {/* Skeleton for the title */}
                <div className={styles.skeletonDate}></div> {/* Skeleton for the date */}
                <div className={styles.skeletonDescription}></div> {/* Skeleton for the description */}
                <div className={styles.skeletonButton}></div> {/* Skeleton for the button */}
            </div>
        </div>
    );
};

export default SkeletonCard;