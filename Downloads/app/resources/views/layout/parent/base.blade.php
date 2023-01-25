<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="{{ asset('/image/logo/favicon.png') }}" rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Edfish">
    <meta name="keywords" content="Edfish">
    <meta name="author" content="Vineeth">

    @yield('head')

    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}">
    <!-- END: CSS Assets-->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    @livewireStyles
</head>
<!-- END: Head -->

@yield('body')
@include('sweetalert::alert')
@livewireScripts
@stack('scripts')
<script src=" //cdn.jsdelivr.net/npm/sweetalert2@11">
</script>
<x-livewire-alert::scripts />

</html>
