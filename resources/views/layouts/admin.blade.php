<!DOCTYPE html>
<html lang="en" class="{{ request()->routeIs('admin.login') ? 'form-screen' : '' }}">
<head>
    <title>Admin Panel - @yield('title')</title>
    @vite('resources/css/admin.css')
    <!-- Tailwind is included -->
  {{-- <link rel="stylesheet" href="css/main.css?v=1652870200386"> --}}
  <!-- CKEditor 5 Classic build from CDN -->
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/styles.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
</head>
<body>
    {{-- @include('partials.admin.nav') --}}
    <main>
        @yield('content')
    </main>
    {{-- @include('partials.admin.footer') --}}
    <!-- Scripts below are for demo only -->
    @vite('resources/js/admin.js')
    {{-- <script type="text/javascript" src="js/main.min.js?v=1652870200386"></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
</body>
</html>