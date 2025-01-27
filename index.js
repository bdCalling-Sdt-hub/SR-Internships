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
            // Save the connected user to the database
            const response = await axios.post(`${API_BASE_URL}/connected-users`, {
                user_id: userId,
                socket_id: socket.id,
            });

            // Add the user to the connectedUsers list
            connectedUsers = connectedUsers.filter(user => user.userId !== userId); // Remove previous connection if exists
            connectedUsers.push({ userId, socketId: socket.id });

            // Emit the updated user list to all clients
            io.emit('update users', connectedUsers);

            console.log('User saved to the database:', response.data);
        } catch (error) {
            console.error('Error saving user:', error);
        }
    });

    // Handle 'send message' event
    socket.on("send message", (data) => {
        const { message, receiver_id } = data;

        // Find the receiver's socket ID
        const receiver = connectedUsers.find(user => user.userId == receiver_id);
        if (receiver) {
            // Send the message to the receiver
            io.to(receiver.socketId).emit('chat message', message);
        }

        // Optionally: send the message back to the sender's chatbox
        socket.emit('chat message', message);
    });
    socket.on('imageUploaded', data => {
        io.emit('newImage', data);
    });
    socket.on('creategroup', (data) => {
        // Emit the newRoom event to all clients
        io.emit('newgroup', data);
    });

    socket.on('disconnect', () => {
        console.log('Client disconnected:', socket.id);

        // Remove the user from the connectedUsers list
        connectedUsers = connectedUsers.filter(user => user.socketId !== socket.id);

        // Emit the updated user list to all clients
        io.emit('update users', connectedUsers);
    });
});

server.listen(3000, "192.168.10.14", () => {
    console.log('Server running at http://192.168.10.14:3000');
});
