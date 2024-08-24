@extends('backend.layouts.include.master')
@section('content')
    <div class="container">
        <h5 class="chat-with-all">Chat with all</h5>
        <ul class="nav nav-underline message-tap">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">All messages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Unread</a>
            </li>
        </ul>
        <div class="chat-box-area">
            <div class="row">
                <div class="col-md-4">
                    <div class="chat-list">
                        <div class="search-container">
                            <input type="search" id="user-search" class="form-control search-input"
                                placeholder="Search users">
                            <i class="bi bi-search search-icon"></i>
                        </div>
                        <input id="userId" type="hidden" value="{{ auth()->user()->id }}">
                        @forelse ($connectedUsers as $user)
                            <a href="{{ route('messages.show', $user->user->id) }}">
                                <input type="hidden" id="receiver_id" name="receiver_id" value="{{ $user->user->id }}">
                                <div class="user-list">
                                    <div class="chat-item">
                                        <img src="{{ asset('/avatars/man.png') }}" alt="{{ $user->user->name }}"
                                            class="avatar">
                                        <h6>{{ $user->user->name }} </h6>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p class="text-white">No users found</p>
                        @endforelse
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="chat-box">
                        <div id="chat-messages">
                            @foreach ($messages as $message)
                                <div class="message {{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                                    {{ $message->content }}
                                    <span class="timestamp">{{ $message->created_at->format('h:i A') }}</span>
                                </div>
                            @endforeach
                        </div>
                        <form id="chat-input-form" class="chat-input-form" action="{{ route('messages.send') }}"
                            method="POST">
                            @csrf
                            <input type="text" id="chat-input" name="message" class="form-control"
                                placeholder="Type your message">
                            <div class="common-class d-flex align-items-center">
                                <i class="bi bi-camera image-icon" data-bs-target="#image-upload-modal"
                                    data-bs-toggle="modal"></i>
                                <button type="submit" class="send-button btn btn-primary">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Image Upload Modal -->
    <div class="modal fade" id="image-upload-modal" tabindex="-1" aria-labelledby="image-upload-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="image-upload-modalLabel">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="image-upload-form" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Choose an image</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const socket = io('http://192.168.10.14:3000');
        const form = document.getElementById('chat-input-form');
        const input = document.getElementById('chat-input');
        const messages = document.getElementById('chat-messages');
        const userId = document.getElementById('userId').value;
        const receiverInput = document.getElementById('receiver_id');

        socket.emit('user connected', userId);


        document.getElementById('image-upload-form').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);
            const receiverId = document.getElementById('receiver_id').value;
            formData.append('receiver_id', receiverId);
            fetch('{{ route('upload.image') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        socket.emit('imageUploaded', {
                            imagePath: data.imagePath,
                            receiver_id: receiverId
                        });
                        document.getElementById('image').value = '';
                        $('#image-upload-modal').modal('hide');
                    } else {
                        console.error(data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
        socket.on('newImage', function(data) {
            const messageElement = document.createElement('div');
            messageElement.classList.add('message', 'received');
            const img = document.createElement('img');
            img.src = data.imagePath;
            img.style.maxWidth = '100%';
            img.style.maxHeight = '200px';
            messageElement.appendChild(img);
            const messages = document.getElementById('chat-messages');
            messages.appendChild(messageElement);
            messages.scrollTop = messages.scrollHeight;
        });
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const message = input.value.trim();
            const receiver_id = receiverInput.value;
            if (message !== '') {
                $.ajax({
                    url: form.action,
                    type: 'POST',
                    data: {
                        _token: $('input[name=_token]').val(),
                        receiver_id: receiver_id,
                        message: message,
                    },
                    success: (response) => {
                        socket.emit('send message', {
                            message,
                            receiver_id
                        });
                        input.value = '';
                    },
                    error: (xhr, status, error) => {
                        console.error('Message could not be sent:', error);
                    }
                });
            }
        });
        socket.on('chat message', (message) => {
            const messageElement = document.createElement('div');
            messageElement.classList.add('message', 'received');
            messageElement.innerHTML =
                `${message}<span class="timestamp">${new Date().toLocaleTimeString()}</span>`;
            messages.appendChild(messageElement);
            messages.scrollTop = messages.scrollHeight;
        });
        $('.user-link').on('click', function(e) {
            e.preventDefault();
            const receiverId = $(this).data('receiver-id');
            receiverInput.value = receiverId;
        });
    </script>
@endsection
