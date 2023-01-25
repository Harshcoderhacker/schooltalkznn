@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Homework</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Homework'])
@endsection

@section('subcontent')
    @livewire('aparent.homework.aparenthomeworkindexlivewire')
@endsection

@section('script')
    <script>
        $('#parenthomework').addClass("side-menu--active");
    </script>
@endsection
