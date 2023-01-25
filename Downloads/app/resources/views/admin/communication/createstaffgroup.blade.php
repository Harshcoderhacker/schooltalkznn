@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Communication</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'admincommuication','name' => 'Communication'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Create Staff Group'])
@endsection

@section('subcontent')
    <div class="intro-y box rounded-xl py-3 sm:py-3 mt-4">
        <div class="mx-auto w-full sm:w-3/5">
            <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    <div class="intro-x col-span-12 mx-auto mb-3">
                        <h1 class="text-theme-1 text-2xl font-semibold">Create Staff Group</h1>
                    </div>
                    <div class="intro-x col-span-12">
                        <label for="input-wizard-2" class="form-label font-semibold">Group Name</label>
                        <input id="input-wizard-2" type="text" class="form-control">
                    </div>
                    <div class="intro-x col-span-12 sm:col-span-6">
                        <label for="input-wizard-3" class="form-label font-semibold">Department</label>
                        <input id="input-wizard-3" type="text" class="form-control">
                    </div>
                    <div class="intro-x col-span-12 sm:col-span-6">
                        <label for="input-wizard-3" class="form-label font-semibold">Designation</label>
                        <input id="input-wizard-3" type="text" class="form-control">
                    </div>
                    <div class="intro-x col-span-12 mx-auto mt-5 mb-5">
                        <a href="{{ route('admincommuication') }}" class="btn btn-primary w-auto ml-2">Create Group</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#admincommuication').addClass("side-menu--active");
    </script>
@endsection
