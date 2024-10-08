import React from 'react';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';
import { Button, Container, Box } from '@mui/material';
import Dashboard from './Dashboard';
import Users from './Users';

function App() {
  return (
    <Router>
      <Container maxWidth="lg">
        <Box display="flex" justifyContent="center" gap={2} padding={2}>
          <Button component={Link} to="/" variant="contained" color="primary">
            Dashboard
          </Button>
          <Button component={Link} to="/users" variant="contained" color="secondary">
            Users
          </Button>
        </Box>
        <Routes>
          <Route path="/" element={<Dashboard />} />
          <Route path="/users" element={<Users />} />
        </Routes>
      </Container>
    </Router>
  );
}

export default App;
