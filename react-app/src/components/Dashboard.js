// src/components/Dashboard.js
import React, { useEffect, useState } from 'react';
import { Container, Paper, Typography } from '@mui/material';
import PostTable from './PostTable';
import { fetchPosts, deletePost } from '../services/api';

const Dashboard = () => {
  const [posts, setPosts] = useState([]);

  useEffect(() => {
    loadPosts();
  }, []);

  const loadPosts = async () => {
    try {
      const response = await fetchPosts();
      setPosts(response.data);
    } catch (error) {
      console.error('Error fetching posts:', error);
    }
  };

  const handleDeletePost = async (id) => {
    try {
      await deletePost(id);
      loadPosts(); // Postu sildikten sonra verileri yeniden yükle
    } catch (error) {
      console.error('Error deleting post:', error);
    }
  };

  return (
    <Container maxWidth="lg">
      <Paper style={{ padding: '16px', marginTop: '16px' }}>
        <Typography variant="h4" gutterBottom>
          Posts
        </Typography>
        <PostTable posts={posts} onDelete={handleDeletePost} />
      </Paper>
    </Container>
  );
};

export default Dashboard;
