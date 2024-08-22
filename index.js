const express = require('express');
const { createServer } = require('http');

const app = express();
const server = createServer(app);

const io = require('socket.io')(server, {
    cors: {
        origin: "*"
    }
});

app.get('/test', (req, res) => {
    res.send('');
});

let connectedUsers = [];

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
});
