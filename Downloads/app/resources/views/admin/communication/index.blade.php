@extends('../layout/admin/' . $layout)

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
    @livewire('common.communication.chatlivewire', ['platform' => 'admin'])
@endsection
