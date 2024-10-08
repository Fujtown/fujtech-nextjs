import axios from 'axios';

const API_URL = `${process.env.NEXT_PUBLIC_API_BASE_URL}/api/blogs`;

export const fetchBlogs = async () => {
    try {
        const response = await axios.get(API_URL, {
            headers: {
                'Content-Type': 'application/json',
            },
        });
        return {
            data: response.data.data, // Adjust based on your API response structure
            version: response.data.version, // Get the version from the response
        }
    } catch (error) {
        console.error('Error fetching blogs:', error);
        throw error; // Rethrow the error for further handling
    }
};


// New function to fetch a single blog by slug
export const fetchBlogBySlug = async (slug) => {
    try {
        const response = await axios.get(`${API_URL}/${slug}`, {
            headers: {
                'Content-Type': 'application/json',
            },
        });
        return response.data; // Adjust based on your API response structure
    } catch (error) {
        console.error('Error fetching blog:', error);
        throw error; // Rethrow the error for further handling
    }
};