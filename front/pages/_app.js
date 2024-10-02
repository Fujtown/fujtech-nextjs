import "react-toastify/dist/ReactToastify.min.css";
import 'bootstrap/dist/css/bootstrap.min.css';
import '../node_modules/react-modal-video/scss/modal-video.scss';
import 'swiper/css';
import 'swiper/css/pagination';
import '../styles/animate.css'
import '../styles/fontawesome.css';
import '../styles/themify-icons.css';
import '../styles/animate.css';
import '../styles/sidebar.css';
import '../styles/sass/style.scss';
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import AdminLayout from '../components/AdminLayout/AdminLayout'; // Adjust the path as necessary
import Head from "next/head";

function MyApp({ Component, pageProps }) {
    // Check if the current route is an admin route
    // console.log(Component.displayName)
    const isAdminRoute = Component.displayName === 'AddCategory' || Component.displayName === 'ListCategory' || Component.displayName === 'AddBlog' || Component.displayName === 'AllBlogs' || Component.displayName === 'AddService' || Component.displayName === 'AllServices' || Component.displayName === 'Dashboard'; // Add other admin components as needed
    
  return (
    <>
      {isAdminRoute ? (
        <AdminLayout>
          <Component {...pageProps} />
        </AdminLayout>
      ) : (
        <Component {...pageProps} />
      )}
    </>

  )
}

export default MyApp
