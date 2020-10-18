<!DOCTYPE html>
<html lang="en">
@include('includes.frontend.head')
<body>
@include('includes.frontend.header')
@yield('content')
@include('includes.frontend.footer')
</body>
@include('includes.frontend.script')
@yield('script-2')
@yield('script-1')
</html>