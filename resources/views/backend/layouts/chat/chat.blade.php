@extends('backend.layouts.include.master')
@section('content')
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            padding-top: 20px;
            background-color: #1E1E1E;
        }

        .container {
            max-width: 100%;
            margin: auto;
            background-color: #404141;
            border-radius: 7px;
            padding: 20px;
        }

        .chat-list {
            width: 100%;
            background-color: #333434;
            overflow-y: auto;
            padding: 10px;
            border-radius: 7px;
            height: 700px;
            margin-right: 12px;
        }

        /* Custom Scroll Bar */
        .chat-list::-webkit-scrollbar {
            width: 8px;
        }

        .chat-list::-webkit-scrollbar-track {
            background-color: #1E1E1E;
            border-radius: 7px;
        }

        .chat-list::-webkit-scrollbar-thumb {
            background-color: #00A2C1;
            border-radius: 7px;
        }

        .chat-list::-webkit-scrollbar-thumb:hover {
            background-color: #00A2C1;
        }

        .chat-item {
            background-color: #003944;
            padding: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            color: #fff;
            border-radius: 7px;
            margin-bottom: 10px;
        }

        .chat-item img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chat-item:hover {
            background-color: #555656;
        }

        .chat-box {
            width: 100%;
            display: flex;
            flex-direction: column;
            background-color: #fff;
            overflow: hidden;
        }

        #chat-messages {
            padding: 10px;
            overflow-y: auto;
            border-radius: 7px;
            margin-top: 12px;
            width: auto;
            height: 63vh;
            padding: 20px;
        }

        /* Custom Scroll Bar for chat-messages */
        #chat-messages::-webkit-scrollbar {
            width: 8px;
        }

        #chat-messages::-webkit-scrollbar-track {
            background-color: #404141;
            border-radius: 7px;
        }

        #chat-messages::-webkit-scrollbar-thumb {
            background-color: #00A2C1;
            border-radius: 7px;
        }

        #chat-messages::-webkit-scrollbar-thumb:hover {
            background-color: #007bff;
        }

        .chat-input-form {
            position: relative;
            display: flex;
            align-items: center;
            padding: 20px;
            border-radius: 7px;

        }

        .chat-input-form input {
            flex: 1;
            border-radius: 7px;
            padding: 12px;
        }

        .chat-input-form button {
            flex-shrink: 0;
        }

        .send-button {
            background: #DD1122;
            color: white;
            border: none;
            border-radius: 7px;
            padding: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;

        }

        .send-button:hover {
            /* background: #c8102e; */
        }

        .send-button i {
            color: #fff;
        }

        .image-icon {
            font-size: 18px;
            color: #fff;
            background-color: #00A2C1;
            padding: 5px;
            border-radius: 50%;
        }

        .chat-with-all {
            color: #fff;
            margin-top: -7px;
            padding-top: 16px;
            font-size: 20px;
            font-weight: bold;
        }



        .search-container {
            position: sticky;
            top: 0;
            z-index: 1;
            background-color: #303939;
            /* Match your theme */
            padding: 10px;
        }

        .search-container ::placeholder {
            padding-left: 25px;
        }

        .search-input {
            width: 100%;
            padding: 10px 20px;
            border-radius: 7px;
            font-size: 16px;
            border: 1px solid #ddd;
            padding-left: 40px;
        }

        .search-icon {
            position: absolute;
            top: 58%;
            left: 20px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #aaa;
        }

        /* Nav underline with red color */
        .nav-link {
            color: blue;
            border-bottom: 2px solid transparent;
        }

        .nav-link.active {
            font-weight: bold;
            color: blue;
            /* border-bottom: 2px solid red; */
        }

        .nav-link:hover {
            color: darkblue;
        }


        .chat-box {
            width: 100%;
            display: flex;
            flex-direction: column;
            background-color: #303939;
            border-radius: 7px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        /* .message.sent {
                        background-color: #F4B5BA;
                        color: #333;
                        margin-bottom: 15px;
                        padding: 15px;
                        border-radius: 7px 7px 0px 7px;
                        max-width: 75%;
                        font-size: 16px;
                        line-height: 1.4;
                        margin-left: auto;
                    }

                    .message.received {
                        background-color: #B0E2EC;
                        color: #333;
                        align-self: flex-start;
                        margin-bottom: 15px;
                        padding: 15px;
                        border-radius: 7px 7px 7px 0px;
                        max-width: 75%;
                        font-size: 16px;
                        line-height: 1.4;
                        margin-right: auto;
                    } */
        .message.sent {
            background-color: #F4B5BA;
            color: #333;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 7px 7px 0 7px;
            max-width: 75%;
        }

        .message.received {
            background-color: #D1F7C4;
            color: #333;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 7px 7px 7px 0;
            max-width: 75%;
        }

        .timestamp {
            display: block;
            font-size: 0.8rem;
            color: #888;
            text-align: right;
            margin-top: 5px;
        }

        .chat-input-form input::placeholder {
            color: #bbb;
        }

        .send-button {
            background: #DD1122;
            color: white;
            border: none;
            border-radius: 7px;
            padding: 10px 12px;
            margin-left: 10px;

        }

        .send-button i {
            transform: rotate(45deg);
        }

        .common-class {
            position: absolute;
            right: 28px;
            bottom: 25px;

        }

        .timestamp {
            display: block;
            font-size: 12px;
            color: #333;
            margin-top: 5px;
            text-align: start;
            /* Align the timestamp to the right */
        }

        .chat-list,
        #chat-messages {
            scroll-behavior: smooth;
        }

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }

            .col-md-4,
            .col-md-8 {
                width: 100%;
            }
        }
    </style>

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
                        <a href="{{ route('messages.show' , $user->user->id )}}">
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
                            <i class="bi bi-camera image-icon"></i>
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

    // Handle form submission
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const message = input.value.trim();
        const receiver_id = receiverInput.value;
        console.log(receiver_id)

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
                    input.value = ''; // Clear input field
                },
                error: (xhr, status, error) => {
                    console.error('Message could not be sent:', error);
                }
            });
        }
    });

    // Handle receiving messages
    socket.on('chat message', (message) => {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', 'received');
        messageElement.innerHTML = `${message}<span class="timestamp">${new Date().toLocaleTimeString()}</span>`;
        messages.appendChild(messageElement);
        messages.scrollTop = messages.scrollHeight; // Scroll to the bottom
    });

    // Handle user selection
    $('.user-link').on('click', function (e) {
        e.preventDefault();
        const receiverId = $(this).data('receiver-id');
        receiverInput.value = receiverId;
    });
</script>

@endsection
