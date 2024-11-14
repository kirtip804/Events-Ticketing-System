<!DOCTYPE html>
<html>
<head>
@include('attendees.layouts.head')
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100 bg-light">

    <div class="signup-form p-4 border rounded shadow-sm bg-white" style="max-width: 400px; width: 100%;">
        <h2 class="text-center mb-4">Sign in to your account.</h2>
        <form id="signinForm" class="form-block" method="POST" action="{{ route('sign-in.submit') }}">
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Sign In</button>
        </form>
        <div class="text-center mt-3">
            <p>Create an Account? <a href="{{ route('sign-up') }}">Sign Up here</a></p>
            <a href="{{ url('/') }}">Home</a>
        </div>
    </div>
</body>
@include('attendees.layouts.foot')
<script src="{{ asset('js/signin.js?cache=1.0.0') }}"></script>
</body>
</html>


