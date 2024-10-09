import axios from 'axios';

const API_URL = `${process.env.NEXT_PUBLIC_API_URL}/counters`; // Correctly concatenate the base URL with the endpoint
 // Replace with your Laravel backend URL

export const fetchCounters = async () => {
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
        console.error('Error fetching counters:', error);
        throw error; // Rethrow the error for further handling
    }
};