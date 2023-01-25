@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Virtual Class</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'parentvirtualclasstoday',
        'name' => 'Virtual Class',
    ])
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Upcoming'])
@endsection


@section('subcontent')
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include(
            'parent.virtualclass.helper.parentvirtualclassmenu',
            ['active' => 'upcoming']
        )
    </div>
    <div class=" col-span-12 xl:col-span-12">
        <div class="p-2">
            <div class="grid grid-cols-12 gap-6 ">
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 box p-10">
                    <div class="mx-auto">
                        <div class="p-4 ">
                            @include('helper.datatable.norecordfound')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#parentvirtualclasstoday').addClass("side-menu--active");
    </script>
@endsection
