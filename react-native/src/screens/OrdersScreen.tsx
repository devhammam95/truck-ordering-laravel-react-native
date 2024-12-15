import React, { useState, useEffect } from 'react';
import { View, StyleSheet, ActivityIndicator } from 'react-native';
import { DataTable, Text, Surface, Button, Snackbar } from 'react-native-paper';
import { orderAPI } from '../services/api';

const itemsPerPage = 5;

const OrdersScreen = ({ navigation }) => {
  const [orders, setOrders] = useState([]);
  const [page, setPage] = useState(0);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [totalOrders, setTotalOrders] = useState(0);

  const fetchOrders = async () => {
    try {
      setLoading(true);
      setError('');
      const response = await orderAPI.getOrders(page + 1, itemsPerPage);
      setOrders(response.data.orders.data);
      setTotalOrders(response.data.orders.total);
    } catch (err) {
      setError('Failed to fetch orders. Please try again.');
      console.error('Error fetching orders:', err);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchOrders();
  }, [page]);

  const getStatusColor = (status) => {
    switch (status.toLowerCase()) {
      case 'pending':
        return '#FFA500';
      case 'in progress':
        return '#4169E1';
      case 'completed':
        return '#32CD32';
      default:
        return '#000000';
    }
  };

  if (loading && orders.length === 0) {
    return (
      <View style={[styles.container, styles.centerContent]}>
        <ActivityIndicator size="large" color="#6200ee" />
      </View>
    );
  }

  return (
    <View style={styles.container}>
      <Surface style={styles.surface}>
        <View style={styles.header}>
          <Text style={styles.title}>My Orders</Text>
          <Button 
            mode="contained" 
            onPress={() => navigation.navigate('TruckRequest')}
            style={styles.newOrderButton}
          >
            New Order
          </Button>
        </View>

        <DataTable>
          <DataTable.Header>
            <DataTable.Title>ID</DataTable.Title>
            <DataTable.Title>Status</DataTable.Title>
            <DataTable.Title>Delivery / Pickup type</DataTable.Title>
            <DataTable.Title>Delivery / Pickup DateTime</DataTable.Title>
            <DataTable.Title>Location</DataTable.Title>
            <DataTable.Title>Size</DataTable.Title>
            <DataTable.Title numeric>Weight (kg)</DataTable.Title>
          </DataTable.Header>

          {orders.map((order) => (
            <DataTable.Row key={order.id}>
              <DataTable.Cell>{order.id}</DataTable.Cell>
              <DataTable.Cell>
                <Text style={{ color: getStatusColor(order.status) }}>
                  {order.status}
                </Text>
              </DataTable.Cell>
              <DataTable.Cell>{order.delivery_pickup_type}</DataTable.Cell>
              <DataTable.Cell>{order.delivery_pickup_date_time}</DataTable.Cell>
              <DataTable.Cell>{order.location}</DataTable.Cell>
              <DataTable.Cell>{order.size}</DataTable.Cell>
              <DataTable.Cell numeric>{order.weight}</DataTable.Cell>
            </DataTable.Row>
          ))}

          <DataTable.Pagination
            page={page}
            numberOfPages={Math.ceil(totalOrders / itemsPerPage)}
            onPageChange={setPage}
            label={`${page * itemsPerPage + 1}-${Math.min((page + 1) * itemsPerPage, totalOrders)} of ${totalOrders}`}
            showFastPaginationControls
            numberOfItemsPerPage={itemsPerPage}
          />
        </DataTable>
      </Surface>

      <Snackbar
        visible={!!error}
        onDismiss={() => setError('')}
        action={{
          label: 'Retry',
          onPress: fetchOrders,
        }}
      >
        {error}
      </Snackbar>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
  },
  surface: {
    flex: 1,
    margin: 16,
    padding: 16,
    elevation: 4,
    borderRadius: 8,
  },
  header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 16,
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
  },
  newOrderButton: {
    marginLeft: 16,
  },
  centerContent: {
    justifyContent: 'center',
    alignItems: 'center',
  },
});

export default OrdersScreen;
