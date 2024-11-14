<!DOCTYPE html>
<html>
<head>
@include('attendees.layouts.head')
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100 bg-light">

    <div class="signup-form p-4 border rounded shadow-sm bg-white" style="max-width: 400px; width: 100%;">
        <h2 class="text-center mb-4">Create an Account</h2>
        <form id="signupForm" class="form-block" method="POST" action="{{ route('sign-up.submit') }}">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <!-- Phone Number -->
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="mobile" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile" required>
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" name="role">
                    <option value="">Select</option>
                    @foreach($roles as $key => $role)
                    <option value="{{ $key }}">{{ $role }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>

        <div class="text-center mt-3">
            <p>Already have an account? <a href="{{ route('sign-in') }}">Login here</a></p>
            <a href="{{ url('/') }}">Home</a>
        </div>
    </div>
</body>
@include('attendees.layouts.foot')
<script src="{{ asset('js/signup.js?cache=1.0.0') }}"></script>
</html>


