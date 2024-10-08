import React, { useEffect, useState } from 'react';
import axios from 'axios';
import {
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Paper,
  IconButton,
} from '@mui/material';
import DeleteIcon from '@mui/icons-material/Delete';

const Dashboard = () => {
  const [posts, setPosts] = useState([]);

  // Verileri çekme işlemi
  useEffect(() => {
    fetchPosts();
  }, []);

  const fetchPosts = async () => {
    try {
      const response = await axios.get('http://localhost:8000/posts');
      setPosts(response.data);
      console.log('Gönderiler:', response.data);
    } catch (error) {
      console.error('Post verileri çekilirken hata oluştu:', error);
    }
  };

  const deletePost = async (id) => {
    try {
      await axios.delete(`http://localhost:8000/posts/${id}`);
      fetchPosts(); 
    } catch (error) {
      console.error('Post silinirken hata oluştu:', error);
    }
  };

  return (
    <div>
      <h2>Posts</h2>
      <TableContainer component={Paper}>
        <Table>
          <TableHead>
            <TableRow>
              <TableCell>Username</TableCell>
              <TableCell>Title</TableCell>
              <TableCell>Body</TableCell>
              <TableCell>Actions</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {posts.map((post) => (
              <TableRow key={post.id}>
                <TableCell>{post.username || 'Unknown'}</TableCell>
                <TableCell>{post.title}</TableCell>
                <TableCell>{post.body}</TableCell>
                <TableCell>
                  <IconButton
                    color="secondary"
                    onClick={() => deletePost(post.id)}
                  >
                    <DeleteIcon />
                  </IconButton>
                </TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
    </div>
  );
};

export default Dashboard;
