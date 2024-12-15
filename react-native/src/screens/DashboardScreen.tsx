import React from 'react';
import { View, StyleSheet } from 'react-native';
import { Text, Button, Surface } from 'react-native-paper';
import { authAPI } from '../services/api';

const DashboardScreen = ({ navigation }) => {
  const handleLogout = async () => {
    try {
      await authAPI.logout();
      navigation.reset({
        index: 0,
        routes: [{ name: 'Login' }],
      });
    } catch (error) {
      console.error('Logout failed:', error);
    }
  };

  return (
    <View style={styles.container}>
      <Surface style={styles.content}>
        <Text style={styles.welcomeTitle}>Welcome to Truck Order</Text>
        <Text style={styles.welcomeMessage}>
          Your trusted platform for efficient truck delivery services
        </Text>
        <View style={styles.buttonContainer}>
          <Button
            mode="contained"
            onPress={() => navigation.navigate('TruckRequest')}
            style={styles.button}
          >
            New Shipping Order
          </Button>
          <Button
            mode="contained"
            onPress={() => navigation.navigate('Orders')}
            style={styles.button}
          >
            View Orders
          </Button>
          <Button
            mode="contained"git
            onPress={handleLogout}
            style={[styles.button, styles.logoutButton]}
            buttonColor="#ff4444"
          >
            Logout
          </Button>
        </View>
      </Surface>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
    padding: 16,
  },
  content: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 24,
    borderRadius: 12,
    elevation: 4,
  },
  welcomeTitle: {
    fontSize: 28,
    fontWeight: 'bold',
    marginBottom: 16,
    textAlign: 'center',
  },
  welcomeMessage: {
    fontSize: 16,
    textAlign: 'center',
    marginBottom: 32,
    color: '#666',
  },
  buttonContainer: {
    width: '100%',
    gap: 16,
  },
  button: {
    width: '100%',
  },
  logoutButton: {
    marginTop: 16,
  },
});

export default DashboardScreen;
