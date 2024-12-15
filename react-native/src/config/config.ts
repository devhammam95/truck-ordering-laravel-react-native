interface Config {
  API_URL: string;
  API_TIMEOUT: number;
}

interface Environment {
  development: Config;
  staging: Config;
  production: Config;
}

const config: Environment = {
  development: {
    API_URL: 'http://localhost:8005/api',
    API_TIMEOUT: 10000,
  },
  staging: {
    API_URL: 'https://staging-api.truckapp.com/api',
    API_TIMEOUT: 10000,
  },
  production: {
    API_URL: 'https://api.truckapp.com/api',
    API_TIMEOUT: 10000,
  },
};

// You can change this based on your environment
const currentEnvironment = __DEV__ ? 'development' : 'production';

export default config[currentEnvironment];
