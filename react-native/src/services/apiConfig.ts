import { API_URL, API_TIMEOUT } from '../constants/env';

export const apiConfig = {
  baseURL: API_URL,
  timeout: API_TIMEOUT,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
};

// API endpoints
export const ENDPOINTS = {
  AUTH: {
    LOGIN: '/v1/user/login',
    REGISTER: '/v1/user/register',
    LOGOUT: '/v1/user/logout',
  },
  ORDERS: {
    LIST: '/v1/shipping-orders',
    CREATE: '/v1/shipping-orders'
  },
} as const;
