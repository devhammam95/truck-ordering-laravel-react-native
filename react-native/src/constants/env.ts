import { Platform } from 'react-native';

export const ENV = {
  development: {
    API_URL: Platform.OS === 'android' ? 'http://10.0.2.2:8005/api' : 'http://localhost:8005/api',
    API_TIMEOUT: 10000,
  },
  staging: {
    API_URL: 'https://staging-api.example.com/api',
    API_TIMEOUT: 10000,
  },
  prod: {
    API_URL: 'https://api.example.com/api',
    API_TIMEOUT: 10000,
  },
} as const;

export type Environment = keyof typeof ENV;

// You can change this to 'staging' or 'prod' as needed
export const CURRENT_ENV: Environment = __DEV__ ? 'development' : 'prod';

export const getEnvironment = () => ENV[CURRENT_ENV];

// Export commonly used values
export const API_URL = getEnvironment().API_URL;
export const API_TIMEOUT = getEnvironment().API_TIMEOUT;
