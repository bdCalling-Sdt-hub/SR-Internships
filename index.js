const express = require('express');
const { createServer } = require('http');
const axios = require('axios');

const app = express();
const server = createServer(app);
const API_BASE_URL = 'http://127.0.0.1:8000/api';

const io = require('socket.io')(server, {
    cors: {
        origin: "*"
    }
});

let connectedUsers = [];

app.get('/test', (req, res) => {
    res.send('');
});

// Handle socket connections
io.on('connection', (socket) => {
    console.log('A user connected:', socket.id);

    socket.on('user connected', async (userId) => {
        try {
            const response = await axios.post(`${API_BASE_URL}/connected-users`, {
                user_id: userId,
                socket_id: socket.id,
            });

            // Add the user to the connectedUsers list
            connectedUsers.push({ userId, socketId: socket.id });

            // Emit the updated user list to all clients
            io.emit('user list', connectedUsers);

            console.log('User saved to the database:', response.data);
        } catch (error) {
            console.error('Error saving user:', error);
        }
    });

    socket.on('disconnect', async () => {
        try {
            await axios.delete(`${API_BASE_URL}/connected-users/${socket.id}`);

            // Remove the user from the connectedUsers list
            connectedUsers = connectedUsers.filter(user => user.socketId !== socket.id);

            // Emit the updated user list to all clients
            io.emit('user list', connectedUsers);

            console.log('User removed from the database:', socket.id);
        } catch (error) {
            console.error('Error removing user:', error);
        }
    });

    socket.on('chatMessage', (data) => {
        io.emit('chatMessage', data);
        // console.log(data)
    });
});

server.listen(3000, "192.168.10.14", () => {
    console.log('server running at http://192.168.10.14:3000');
});
