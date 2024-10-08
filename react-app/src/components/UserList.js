// src/components/UserList.js
import React, { useEffect, useState } from 'react';
import { Container, Paper, List, ListItem, ListItemText } from '@mui/material';
import { fetchUsers } from '../services/api';

const UserList = () => {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    loadUsers();
  }, []);

  const loadUsers = async () => {
    try {
      const response = await fetchUsers();
      setUsers(response.data);
    } catch (error) {
      console.error('Error fetching users:', error);
    }
  };

  return (
    <Container maxWidth="md">
      <Paper style={{ padding: '16px', marginTop: '16px' }}>
        <h2>Users</h2>
        <List>
          {users.map((user) => (
            <ListItem key={user.id}>
              <ListItemText primary={user.name} secondary={user.email} />
            </ListItem>
          ))}
        </List>
      </Paper>
    </Container>
  );
};

export default UserList;
