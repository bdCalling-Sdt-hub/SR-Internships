@extends('backend.layouts.include.master')
@section('content')
    <style>
        /* List Group Styling */
        .list-group {
            padding: 0;
            margin: 20px 0;
            background-color: transparent;
            /* Keep the group background transparent */
        }

        .list-group-item {
            display: flex;
            align-items: center;
            background-color: #34495e;
            /* Background color for the list items */
            border: none;
            /* Remove the default border */
            border-radius: 8px;
            margin-bottom: 10px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #3b5368;
            /* Hover effect for better interactivity */
        }

        /* User Item Styling */
        .user-item {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .user-avatar {
            width: 40px;
            /* Size of the avatar image */
            height: 40px;
            /* Size of the avatar image */
            border-radius: 50%;
            margin-right: 15px;
            /* Space between image and text */
        }

        .form-check-label {
            flex-grow: 1;
            /* Make the label take up remaining space */
        }

        .form-check-input {
            margin-left: auto;
            margin-right: 10px;
            /* Space between the radio button and the text */
            transform: scale(1.2);
            border-color: #ecf0f1;
            /* Match the radio button color to the theme */
        }

        .form-check-label h6 {
            margin: 0;
            color: #ecf0f1;
            /* Set the text color to white */
            font-size: 16px;
        }

        /* Empty State Styling */
        .text-white {
            color: #ecf0f1;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
        }

        .list-group-item.selected {
            background-color: #2c3e50;
            /* Change this to a highlight color */
        }
    </style>


    <div class="container">
        <div class="d-flex justify-content-between">
            <h5 class="chat-with-all">Chat with all</h5>
            <div class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Create Room</div>
        </div>
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
                                    @if (!empty($message->content) && empty($message->image))
                                        {{ $message->content }}
                                        <span class="timestamp">{{ $message->created_at->format('h:i A') }}</span>
                                    @elseif (!empty($message->image))
                                        <img height="200px" src="{{ asset('uploads/chat_images/' . $message->image) }}"
                                            alt="Image">
                                        <span class="timestamp">{{ $message->created_at->format('h:i A') }}</span>
                                    @endif
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
                            <input class="dropify" data-height="100" type="file" id="image" name="image"
                                accept="image/*">
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Upload</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <form id="group-form">
        @csrf
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">+Add to Group</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-user-list">
                            <div class="search-container">
                                <input type="search" id="modal-user-search" class="form-control search-input" placeholder="Search users">
                                <i class="bi bi-search search-icon"></i>
                            </div>
                            <input id="userId" type="hidden" value="{{ auth()->user()->id }}">
                            <ul class="list-group">
                                @forelse ($connectedUsers as $user)
                                    <li class="list-group-item">
                                        <div class="user-item">
                                            <input class="form-check-input me-2" type="checkbox" value="{{ $user->user->id }}" id="user_{{ $user->user->id }}">
                                            <img src="{{ asset('/avatars/man.png') }}" alt="{{ $user->user->name }}" class="user-avatar">
                                            <label class="form-check-label" for="user_{{ $user->user->id }}">
                                                <h6>{{ $user->user->name }}</h6>
                                            </label>
                                        </div>
                                    </li>
                                @empty
                                    <p class="text-white">No users found</p>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="button" id="submit-button" class="btn btn-primary">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <script>
 document.addEventListener('DOMContentLoaded', function() {
    const socket = io('http://192.168.10.14:3000'); // Ensure this is the correct address
    const form = document.getElementById('chat-input-form');
    const input = document.getElementById('chat-input');
    const messages = document.getElementById('chat-messages');
    const userId = document.getElementById('userId').value;
    const receiverInput = document.getElementById('receiver_id');
    const notification = document.getElementById('notification');

    socket.emit('user connected', userId);
    $('.dropify').dropify();

    $('#submit-button').on('click', function() {
        var selectedUsers = [];
        $('input[type="checkbox"]:checked').each(function() {
            selectedUsers.push($(this).val());
        });

        $.ajax({
            url: '{{ route('groups.store') }}',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                user_ids: selectedUsers
            },
            success: function(response) {
                socket.emit('groupCreated', {
                    groupMembers: response.groupMembers,
                    groupName: response.groupName
                });
                alert(response.status);
                $('#staticBackdrop').modal('hide');
            },
            error: function(xhr) {
                alert('Failed to create group. Please try again.');
            }
        });
    });

    socket.on('newGroup', function(newGroup) {
    console.log('New group data:', newGroup);

    const groupList = document.getElementById('group-list');
    if (!groupList) {
        console.error('Group list element not found');
        return;
    }

    const newGroupItem = document.createElement('li');
    newGroupItem.className = 'list-group-item';

    // Fallback for missing data
    const groupName = newGroup.groupName || 'Unknown Group';
    const groupMembers = (newGroup.groupMembers && newGroup.groupMembers.length > 0)
        ? newGroup.groupMembers.join(', ')
        : 'No members';

    newGroupItem.innerHTML = `
        <h5>${groupName}</h5>
        <p>Members: ${groupMembers}</p>
    `;

    groupList.appendChild(newGroupItem);
});


    document.getElementById('image-upload-form').addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);
        formData.append('receiver_id', receiverInput.value);

        fetch('{{ route('upload.image') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                socket.emit('imageUploaded', {
                    imagePath: data.imagePath,
                    receiver_id: receiverInput.value
                });
                document.getElementById('image').value = '';
                $('#image-upload-modal').modal('hide');
            } else {
                alert('Image upload failed. Please try again.');
            }
        })
        .catch(error => alert('An error occurred while uploading the image.'));
    });

    socket.on('newImage', function(data) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', 'received');
        const img = document.createElement('img');
        img.src = data.imagePath;
        img.style.maxWidth = '100%';
        img.style.maxHeight = '200px';
        messageElement.appendChild(img);
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
                success: () => {
                    socket.emit('send message', {
                        message,
                        receiver_id
                    });
                    input.value = '';
                },
                error: () => {
                    alert('Message could not be sent. Please try again.');
                }
            });
        }
    });

    socket.on('chat message', (message) => {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', 'received');
        messageElement.innerHTML = `${message}<span class="timestamp">${new Date().toLocaleTimeString()}</span>`;
        messages.appendChild(messageElement);
        messages.scrollTop = messages.scrollHeight;
    });

    $('.user-link').on('click', function(e) {
        e.preventDefault();
        const receiverId = $(this).data('receiver-id');
        receiverInput.value = receiverId;
    });
});

    </script>
@endsection
