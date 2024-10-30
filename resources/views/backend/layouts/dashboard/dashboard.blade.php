@extends('backend.layouts.include.master')

@section('content')
<body>
    <header class="header">
        <div class="logo">
            <span style="color: rgb(255, 145, 0);">SR</span>
            <span style="color: #2557a7;">Internships</span>
        </div>
        <nav class="nav-links">
            <a href="#" onclick="toggleCreateInternship()">Post Internships</a>
            <a href="#" class="active">Dashboard</a>
        </nav>
    </header>

    <section class="company-profile-container">
        <div class="company-info">
            <h1 class="company-name">{{ $company['company_name'] ?? 'Company Name' }}</h1>
            <address class="company-address">{{ $company['address'] ?? '123 Business St, Cityville, State' }}</address>
            <div class="company-email">{{ $company['email'] ?? 'contact@company.com' }}</div>
            <div class="company-phone">{{ $company['phone'] ?? '(555) 987-6543' }}</div>
            <div class="company-buttons">
                <button class="company-button" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
            </div>
        </div>
        <div class="logo-overlay">
            <img src="{{ $company['profile_photo'] ?? asset('avatars/SearchBackground.jpg') }}"
                 alt="Company Logo"
                 class="company-logo"
                 id="companyLogo">
        </div>
    </section>

    <section class="summary-card">
        <h2>Company Summary</h2>
        <div class="company-summary" id="summaryContent">
            {{ $company['summary'] ?? 'Your company summary will appear here. Edit your profile to add a summary.' }}
        </div>
    </section>
</body>
<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Company Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('company.profile.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name', $company->company_name ) }}" required>
                        @error('company_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $company->address) }}" required>
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $company->email) }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $company->phone) }}" required>
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="summary" class="form-label">Summary</label>
                        <textarea name="summary" id="summary" class="form-control">{{ old('summary', $company->summary) }}</textarea>
                        @error('summary')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" name="logo" id="logo" class="form-control">
                        @error('logo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<style>
    .company-profile-container {
        position: relative;
        text-align: center; /* Center the text for better overlay effect */
    }
    .company-info {
        position: relative;
        z-index: 1; /* Make sure the text is above the image */
        background: rgba(255, 255, 255, 0.8); /* Optional: add a background for readability */
        padding: 20px; /* Optional: some padding around the text */
        border-radius: 8px; /* Optional: rounded corners */
    }
    .logo-overlay {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        z-index: 0; /* Image behind the text */
        width: 100%; /* Adjust width to fit the container */
        height: 100%; /* Match the height of the container */
        overflow: hidden; /* Prevent overflow of the image */
    }
    .company-logo {
        width: 100%; /* Fill the container */
        height: auto; /* Maintain aspect ratio */
        max-height: 100%; /* Limit max height to prevent overflow */
        opacity: 0.5; /* Optional: set opacity for overlay effect */
    }
    .summary-card {
        background: #fff; /* White background for the summary card */
        border: 1px solid #ddd; /* Light gray border */
        border-radius: 8px; /* Rounded corners */
        padding: 20px; /* Padding for content */
        margin-top: 20px; /* Space between the profile and summary card */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
    }
</style>
@endsection
