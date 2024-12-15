import React, { useState } from 'react';
import {
  View,
  StyleSheet,
  KeyboardAvoidingView,
  Platform,
  TouchableOpacity,
} from 'react-native';
import { TextInput, Button, Text, Surface, Snackbar } from 'react-native-paper';
import { authAPI } from '../services/api';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { CURRENT_ENV } from '../constants/env';
import axios from 'axios';

const LoginScreen = ({ navigation }) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [snackbarVisible, setSnackbarVisible] = useState(false);

  const handleLogin = async () => {
    try {
      setLoading(true);
      setError('');
      setSnackbarVisible(false);
      
      const response = await authAPI.login(email, password);
      
      await AsyncStorage.setItem('userToken', response.data.token);
      navigation.replace('Dashboard');
    } catch (err) {
      setSnackbarVisible(true);
      if (axios.isAxiosError(err)) {
        if (!err.response) {
          setError('Network error. Please check your internet connection and try again.');
        } else {
          // Handle API error response
          const errorMessage = err.response.data?.error || 'An unexpected error occurred. Please try again.';
          setError(errorMessage);
        }
      } else {
        setError('An unexpected error occurred. Please try again....');
      }
    } finally {
      setLoading(false);
    }
  };

  const onDismissSnackBar = () => {
    setSnackbarVisible(false);
    setError('');
  };

  return (
    <KeyboardAvoidingView
      behavior={Platform.OS === 'ios' ? 'padding' : 'height'}
      style={styles.container}
    >
      <Surface style={styles.surface}>
        <Text style={styles.title}>Login ({CURRENT_ENV})</Text>
        <TextInput
          label="Email"
          value={email}
          onChangeText={setEmail}
          mode="outlined"
          style={styles.input}
          keyboardType="email-address"
          autoCapitalize="none"
          disabled={loading}
        />
        <TextInput
          label="Password"
          value={password}
          onChangeText={setPassword}
          mode="outlined"
          style={styles.input}
          secureTextEntry
          disabled={loading}
        />
        <Button
          mode="contained"
          onPress={handleLogin}
          style={styles.button}
          loading={loading}
          disabled={loading || !email || !password}
        >
          Login
        </Button>
        <TouchableOpacity
          onPress={() => navigation.navigate('Register')}
          style={styles.registerLink}
          disabled={loading}
        >
          <Text>Don't have an account? Register here</Text>
        </TouchableOpacity>
      </Surface>

      <Snackbar
        visible={snackbarVisible}
        onDismiss={onDismissSnackBar}
        action={{
          label: 'Dismiss',
          onPress: onDismissSnackBar,
        }}
        style={styles.snackbar}
        duration={3000}
      >
        {error}
      </Snackbar>
    </KeyboardAvoidingView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
    justifyContent: 'center',
  },
  surface: {
    margin: 16,
    padding: 16,
    borderRadius: 8,
    elevation: 4,
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 24,
    textAlign: 'center',
  },
  input: {
    marginBottom: 16,
  },
  button: {
    marginTop: 8,
  },
  registerLink: {
    marginTop: 16,
    alignItems: 'center',
  },
  snackbar: {
    position: 'absolute',
    bottom: 0,
    left: 0,
    right: 0,
  },
});

export default LoginScreen;
