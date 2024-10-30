<style>
    body {
        font-family: 'Open Sans', sans-serif;
        background-color: #f8f9fa;
    }

    .header {
        background: linear-gradient(135deg, #333434, #333434);
        color: #fff;
        padding: 15px 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header .logo {
        display: flex;
        align-items: center;
    }

    .header .logo img {
        border-radius: 50%;
        margin-right: 15px;
    }

    .header .logo span {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .header .toggle-sidebar-btn {
        font-size: 1.5rem;
        cursor: pointer;
        margin-left: 20px;
        color: #fff;
    }

    .header-nav {
        margin-left: auto;
    }

    .header-nav .nav-item {
        position: relative;
    }

    .header-nav .nav-link {
        color: #fff;
        padding: 0 15px;
        display: flex;
        align-items: center;
    }

    .header-nav .nav-link:hover,
    .header-nav .nav-link:focus {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 4px;
    }

    .header-nav .dropdown-menu {
        background: #fff;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header-nav .dropdown-menu .dropdown-item {
        color: #333;
    }

    .header-nav .dropdown-menu .dropdown-item:hover,
    .header-nav .dropdown-menu .dropdown-item:focus {
        background: rgba(0, 0, 0, 0.05);
    }

    .header-nav .dropdown-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
        padding: 10px 15px;
    }

    .header-nav .dropdown-header h6 {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
    }

    .header-nav .dropdown-header span {
        font-size: 0.875rem;
        color: #777;
    }

    .nav-profile img{
        width: 39.33px;
        height: 40px;
        border-radius: 50%;
        margin-right: 20px;
        border: 1px solid #555655;
    }
.bell-icon {
    position: relative;
    cursor: pointer;
    background-color: #555655;
    border-radius: 50%;
    width: 39.33px;
    height: 40px;
    margin-right: 40px;
}

.bell-icon i {
    font-size: 24px;
    color: #fff;
    padding: 8px;
}
.bell-icon::after {
    content: '1';
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: red;
    color: white;
    font-size: 12px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;

}

</style>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3 d-flex">
                    <div class="bell-icon">
                        <i class="bi bi-bell"></i>
                    </div>
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                    data-bs-toggle="dropdown">
                        <img src="{{ auth()->user()->image ? asset('path/to/user/image') : asset('/avatars/man.png') }}" alt="Avatar">
                        <span
                            class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->full_name ?? 'no user' }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ auth()->user()->email ?? '' }}</h6>
                            <span>{{ auth()->user()->full_name ?? '' }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
</body>

</html>
