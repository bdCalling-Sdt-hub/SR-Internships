<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Admin Login</h2>
            <form action="{{ route('admin.authenticate') }}" method="POST">
                @csrf
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder=" Enter Your Email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}


<style>
    /* Apply a full-height background image */
body {
    margin: 0;
    padding: 0;
    height: 100vh;
    background: url('background-image.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
}

/* Center the login form on the page */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Slightly darken the background */
}

/* Style the login form */
.login-form {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
}

/* Style form elements */
.login-form h2 {
    margin: 0 0 20px;
    font-size: 24px;
}

.login-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.login-form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    
    border-radius: 4px;
    box-sizing: border-box;
}

.login-form button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 4px;
    background-color: #007BFF;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
}

.login-form button:hover {
    background-color: #0056b3;
}

</style>
</html>
