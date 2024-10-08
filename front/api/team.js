import axios from 'axios';

const API_URL = 'http://localhost:8000/api/team'; // Replace with your Laravel backend URL

export const fetchTeam = async () => {
    try {
        const response = await axios.get(API_URL, {
            headers: {
                'Content-Type': 'application/json',
            },
        });
        return {
            data: response.data.data, // Adjust based on your API response structure
            version: response.data.version, // Get the version from the response
        };
    } catch (error) {
        console.error('Error fetching team:', error);
        throw error; // Rethrow the error for further handling
    }
};