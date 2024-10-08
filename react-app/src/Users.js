import React, { useEffect, useState } from 'react';
import axios from 'axios';

const Users = () => {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    fetchUsers();
  }, []);

  const fetchUsers = async () => {
    try {
      const response = await axios.get('http://localhost:8000/users');
      setUsers(response.data);
      console.log('Kullanıcılar:', response.data);
    } catch (error) {
      console.error('Kullanıcı verileri çekilirken hata oluştu:', error);
    }
  };

  return (
    <div>
      <h2>Users</h2>
      <ul>
        {users.map((user) => (
          <li key={user.id}>
            {user.name} - {user.username}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default Users;
