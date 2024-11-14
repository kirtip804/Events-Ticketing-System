<!DOCTYPE html>
<html>
<head>
@include('attendees.layouts.head')
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm" style="width: 400px;">
            <div class="card-body text-center">
                <h3 class="card-title">{{ $message }}</h3>
                <a href="{{ route('sign-in') }}" class="btn btn-primary">Login Now</a>
            </div>
        </div>
    </div>
@include('attendees.layouts.foot')
</body>
</html>


