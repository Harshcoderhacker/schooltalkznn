@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Students</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Students'])
@endsection

@section('subcontent')
    @livewire('admin.student.studentindexlivewire')
@endsection
