<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5; /* Light background for contrast */
        }
        .signin-frame {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px; /* Set a fixed width for the form */
        }
        .form-group input {
            padding: 15px;
            font-size: 18px;
            border-radius: 10px;
            width: 100%;
            border: 1px solid #ccc; /* Add border to input fields */
            transition: border 0.3s; /* Smooth transition for border change */
        }
        button[type="submit"] {
            padding: 15px;
            font-size: 20px;
            border-radius: 10px;
            background-color: rgb(255, 145, 0);
            color: white; /* Ensure text is readable */
            border: none; /* Remove default border */
            cursor: pointer; /* Change cursor to pointer */
            transition: background-color 0.3s; /* Smooth transition for background color */
        }
        button[type="submit"]:hover {
            background-color: rgb(255, 165, 0); /* Change background color on hover */
        }
        h1 {
            font-size: 36px;
            margin-bottom: 20px; /* Add margin below the title */
            text-align: center; /* Center the title */
        }
        p, a {
            font-size: 18px;
            text-align: center; /* Center align the text */
        }
        .error-input {
            border: 2px solid red;
        }
        .error-message {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <div class="signin-frame">
        <h1>Sign In</h1>
        <form id="signinForm" action="{{route('authenticate')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <b><span class="text-danger">{{ $errors->first('email') }}</span></b>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <b><span class="text-danger">{{ $errors->first('password') }}</span></b>
            </div>
            <button type="submit">Sign In</button>
        </form>
        <p>Don't have an account? <a href="signup.html">Sign up</a></p>
    </div>


</body>
</html>
