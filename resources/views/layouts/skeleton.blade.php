<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{ config('app.name') }}" name="keywords">
    <meta content="{{ config('app.name') }}" name="description">

    <!-- Favicon -->
    <link href="{{ asset('logo/favicon.ico') }}" rel="icon">

    @stack('style')
</head>

<body class="hold-transition @if (request()->is('cms/login*')) login-page @else sidebar-mini layout-fixed @endif">
    @yield('app')

    @stack('script')
</body>

</html>
