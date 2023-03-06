import axios from 'axios';

const API_BASE_URL = 'http://localhost';

export default {
  getUsers() {
    return axios.get(`${API_BASE_URL}`);
  },

	getUsersWeather() {
    return axios.get(`${API_BASE_URL}/userWeathers`);
  },

  getUserWeather(userId: number) {
    return axios.get(`${API_BASE_URL}/users/${userId}/weather`);
  }
}
