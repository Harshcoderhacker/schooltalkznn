@extends('../layout/admin/base')

@section('body')

    <body class="login">
        @yield('content')

        <!-- BEGIN: JS Assets-->
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->

        @yield('script')

    </body>
@endsection
