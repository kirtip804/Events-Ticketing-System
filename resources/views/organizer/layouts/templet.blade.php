<!DOCTYPE html>
<html>
@include('organizer.layouts.head')
@yield('page-css')
<body class="d-flex flex-column h-100">
<div class="d-flex h-100" id="wrapper">
	@include('organizer.layouts.sidebar')
	<div id="page-content-wrapper" class="w-100 d-flex flex-column">
		@include('organizer.layouts.header')
		<div class="container-fluid flex-fill">
            @yield('content')
        </div>
	</div>
</div>
<footer class="bg-light text-center py-3">
	<div class="container">
	    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
	</div>
</footer>
@include('organizer.layouts.foot')
@yield('page-script')
</body>
</html>