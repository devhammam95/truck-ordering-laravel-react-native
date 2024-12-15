import React, { useState } from 'react';
import {
  ScrollView,
  StyleSheet,
  KeyboardAvoidingView,
  Platform,
  View,
  TouchableOpacity,
} from 'react-native';
import { TextInput, Button, Text, Surface, Snackbar, SegmentedButtons } from 'react-native-paper';
import DateTimePickerModal from 'react-native-modal-datetime-picker';
import { orderAPI } from '../services/api';
import axios from 'axios';

const TruckRequestScreen = ({ navigation }) => {
  const [location, setLocation] = useState('');
  const [size, setSize] = useState('');
  const [weight, setWeight] = useState('');
  const [deliverPickupType, setDeliverPickupType] = useState('delivery');
  const [dateTime, setDateTime] = useState(new Date());
  const [isDatePickerVisible, setDatePickerVisible] = useState(false);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [fieldErrors, setFieldErrors] = useState({});

  const showDatePicker = () => {
    setDatePickerVisible(true);
  };

  const hideDatePicker = () => {
    setDatePickerVisible(false);
  };

  const handleConfirm = (date) => {
    setDateTime(date);
    hideDatePicker();
  };

  const formatDateTime = (date) => {
    return date.toLocaleString('en-US', {
      year: 'numeric',
      month: 'short',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
    });
  };

  const formatValidationErrors = (errors) => {
    return Object.values(errors).flat().join('\n');
  };

  const handleSubmit = async () => {
    try {
      setLoading(true);
      setError('');
      setFieldErrors({});
      
      await orderAPI.createOrder({
        location,
        size,
        weight: parseFloat(weight),
        delivery_pickup_type: deliverPickupType,
        delivery_pickup_date_time: dateTime.toISOString(),
      });
      
      // Navigate to Orders screen after successful submission
      navigation.navigate('Orders');
    } catch (err) {
      if (axios.isAxiosError(err) && err.response?.status === 422) {
        const validationErrors = err.response.data.errors;
        setFieldErrors(validationErrors);
        setError(formatValidationErrors(validationErrors));
      } else {
        setError('Failed to submit order. Please try again.');
      }
    } finally {
      setLoading(false);
    }
  };

  return (
    <KeyboardAvoidingView
      behavior={Platform.OS === 'ios' ? 'padding' : 'height'}
      style={styles.container}
    >
      <ScrollView contentContainerStyle={styles.scrollContainer}>
        <Surface style={styles.surface}>
          <Text style={styles.title}>Request a Truck</Text>
          
          <SegmentedButtons
            value={deliverPickupType}
            onValueChange={setDeliverPickupType}
            buttons={[
              { value: 'delivery', label: 'Delivery' },
              { value: 'pickup', label: 'Pickup' },
            ]}
            style={styles.segmentedButtons}
          />

          <TouchableOpacity
            onPress={showDatePicker}
            style={styles.dateTimeButton}
          >
            <Text style={styles.dateTimeLabel}>
              {deliverPickupType === 'delivery' ? 'Delivery' : 'Pickup'} Date & Time
            </Text>
            <Text style={styles.dateTimeValue}>{formatDateTime(dateTime)}</Text>
          </TouchableOpacity>

          <DateTimePickerModal
            isVisible={isDatePickerVisible}
            mode="datetime"
            onConfirm={handleConfirm}
            onCancel={hideDatePicker}
            minimumDate={new Date()}
            date={dateTime}
          />

          <TextInput
            label="Location"
            value={location}
            onChangeText={setLocation}
            mode="outlined"
            style={styles.input}
            placeholder="Enter pickup location"
            disabled={loading}
            error={!!fieldErrors.location}
            helperText={fieldErrors.location?.[0]}
          />

          <TextInput
            label="Size (dimensions in meters)"
            value={size}
            onChangeText={setSize}
            mode="outlined"
            style={styles.input}
            placeholder="e.g., 2x3x4"
            disabled={loading}
            error={!!fieldErrors.size}
            helperText={fieldErrors.size?.[0]}
          />

          <TextInput
            label="Weight (kg)"
            value={weight}
            onChangeText={setWeight}
            mode="outlined"
            style={styles.input}
            keyboardType="numeric"
            placeholder="Enter weight in kg"
            disabled={loading}
            error={!!fieldErrors.weight}
            helperText={fieldErrors.weight?.[0]}
          />

          <Button
            mode="contained"
            onPress={handleSubmit}
            style={styles.button}
            loading={loading}
            disabled={loading || !location || !size || !weight}
          >
            Submit Request
          </Button>
        </Surface>
      </ScrollView>

      <Snackbar
        visible={!!error}
        onDismiss={() => setError('')}
        action={{
          label: 'Dismiss',
          onPress: () => setError(''),
        }}
        duration={4000}
        style={styles.snackbar}
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
  },
  scrollContainer: {
    flexGrow: 1,
    padding: 16,
  },
  surface: {
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
  segmentedButtons: {
    marginBottom: 16,
  },
  dateTimeButton: {
    borderWidth: 1,
    borderColor: '#6200ee',
    borderRadius: 4,
    padding: 16,
    marginBottom: 16,
  },
  dateTimeLabel: {
    color: '#666',
    fontSize: 12,
    marginBottom: 4,
  },
  dateTimeValue: {
    color: '#000',
    fontSize: 16,
  },
  snackbar: {
    position: 'absolute',
    bottom: 0,
    left: 0,
    right: 0,
  },
});

export default TruckRequestScreen;
