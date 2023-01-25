@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminsettings',
        'name' => 'Settings',
    ])
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Stickers'])
@endsection

@section('subcontent')
    @livewire('admin.settings.feed.feedsticker.feedstickerindexlivewire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'feedstickerid'])
    <script type="text/javascript">
        window.addEventListener('resetfileinput', event => {
            const file =
                document.querySelector('.file');
            file.value = '';
        })
    </script>
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
