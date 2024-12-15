import axios from 'axios';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { apiConfig, ENDPOINTS } from './apiConfig';

// Create axios instance with default config
const api = axios.create(apiConfig);

// Request interceptor for adding auth token
api.interceptors.request.use(
  async (config) => {
    console.log('🚀 API Request:', {
      url: config.url,
      method: config.method,
      data: config.data,
      headers: config.headers,
    });
    
    const token = await AsyncStorage.getItem('userToken');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    console.error('❌ Request Error:', error);
    return Promise.reject(error);
  }
);

// Response interceptor for handling errors
api.interceptors.response.use(
  (response) => {
    console.log('✅ API Response:', {
      url: response.config.url,
      status: response.status,
      data: response.data,
    });
    return response;
  },
  async (error) => {
    console.error('❌ Response Error:', {
      url: error.config?.url,
      status: error.response?.status,
      data: error.response?.data,
      message: error.message,
    });
    
    if (error.response?.status === 401) {
      await AsyncStorage.removeItem('userToken');
    }
    return Promise.reject(error);
  }
);

// API endpoints
export const authAPI = {
  login: async (email: string, password: string) => {
    console.log('📝 Login Attempt:', { email });
    try {
      const response = await api.post(ENDPOINTS.AUTH.LOGIN, { email, password });
      console.log('✅ Login Success');
      return response;
    } catch (error) {
      console.error('❌ Login Failed:', error);
      throw error;
    }
  },
  register: async (userData: any) => {
    console.log('📝 Register Attempt:', { ...userData, password: '****' });
    try {
      const response = await api.post(ENDPOINTS.AUTH.REGISTER, userData);
      console.log('✅ Register Success');
      return response;
    } catch (error) {
      console.error('❌ Register Failed:', error);
      throw error;
    }
  },
  logout: async () => {
    try {
      const response = await api.post('/v1/user/logout');
      await AsyncStorage.removeItem('userToken');
      return response.data;
    } catch (error) {
      throw error;
    }
  },
};

export const orderAPI = {
  createOrder: async (orderData: any) => {
    console.log('📝 Create Order:', orderData);
    try {
      const response = await api.post(ENDPOINTS.ORDERS.CREATE, orderData);
      console.log('✅ Order Created:', response.data);
      return response;
    } catch (error) {
      console.error('❌ Create Order Failed:', error);
      throw error;
    }
  },
  getOrders: async (page: number = 1, per_page: number = 10) => {
    console.log('📝 Fetching Orders:', { page, per_page });
    try {
      const response = await api.get(ENDPOINTS.ORDERS.LIST, { params: { page, per_page } });
      console.log('✅ Orders Fetched:', {
        count: response.data?.length || 0,
        page,
        per_page,
      });
      return response;
    } catch (error) {
      console.error('❌ Fetch Orders Failed:', error);
      throw error;
    }
  },
};

export default api;
