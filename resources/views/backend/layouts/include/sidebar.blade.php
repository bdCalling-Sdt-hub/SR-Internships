<style>
    body {
        font-family: 'Open Sans', sans-serif;
        background-color: #1E1E1E;
    }

    .sidebar {
        width: 300px;
        background: linear-gradient(135deg, #333434, #333434);
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        padding-top: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-nav .nav-item {
        width: 100%;
    }

    .sidebar-nav .nav-link {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        color: #fff;
        text-decoration: none;
        font-size: 1rem;
        transition: background 0.3s, color 0.3s;
    }

    .sidebar-nav .nav-link i {
        margin-right: 15px;
        font-size: 1.2rem;
    }

    .sidebar-nav .nav-link:hover {
        background: #6e2329;
        color: #fff;
    }

    .sidebar-nav .nav-link.active {
        background: #404141;
        color: #fff;
    }

    .sidebar-nav .nav-link span {
        flex-grow: 1;
    }

    .sidebar .sidebar-header {
        text-align: center;
        color: #fff;
        font-size: 1.5rem;
        margin-bottom: 30px;
    }

    .sidebar-footer {
        margin-top: auto;
        padding: 20px;
        text-align: center;
        color: #fff;
        background: rgba(0, 0, 0, 0.1);
    }

    .logo img {
        min-width: 94px;
        min-height: 80px;
        margin-top: 24px;
        margin-left: 78px;
    }
</style>

<aside id="sidebar" class="sidebar">
    <a href="{{ route('dashboard') }}">
        <h2 class="text-bold">SR Internships</h2>
        <div class="logo">
            {{-- <img src="{{ asset('avatars/logo.png') }}" alt=""> --}}
        </div>
    </a>
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item mt-5">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer"></i><span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('internships.index')}}">
                <i class="bi bi-list-ul"></i><span>Internship Listings</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('logout')}}">
                <i class="bi bi-box-arrow-left"></i><span>Logout</span>
            </a>
        </li>
    </ul>
    {{-- <div class="sidebar-footer">
            &copy; 2024
        </div> --}}
</aside>

</html>
