@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Communication</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Communication',
    ])
@endsection
@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Chat</h2>
    </div>
    @livewire('common.communication.chatlivewire', ['platform' => 'staff'])
@endsection

@section('script')
    <script>
        $('#staffcommunication').addClass("side-menu--active");
    </script>
@endsection
