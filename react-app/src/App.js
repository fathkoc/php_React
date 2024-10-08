import React from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import Dashboard from './components/Dashboard';
import UserList from './components/UserList';
import { Container, Button } from '@mui/material';

function App() {
  return (
    <Router>
      <Container>
        <nav style={{ marginBottom: '16px', textAlign: 'center' }}>
          <Button variant="contained" color="primary" href="/">
            Dashboard
          </Button>
          <Button variant="contained" color="secondary" href="/users" style={{ marginLeft: '8px' }}>
            Users
          </Button>
        </nav>
        <Routes>
          {/* Eğer URL belirtilmezse veya sadece '/' olursa Dashboard'a yönlendirme */}
          <Route path="/" element={<Dashboard />} />
          <Route path="/users" element={<UserList />} />
          {/* Herhangi başka bir URL'de de Dashboard'u göster */}
          <Route path="*" element={<Navigate to="/" />} />
        </Routes>
      </Container>
    </Router>
  );
}

export default App;
